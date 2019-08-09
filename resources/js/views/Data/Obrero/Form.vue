<template>
	<div class="row">
		<div class="col-md">
            <div class="form-group row mb-3 mt-3">
                <div class="form-group col-10">
                    <h5>{{action}} Obrero</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-sm" @click="save" :disabled="isProcessing">Save</button>
                    <template v-if="action == 'Update'">
                        <button type="button" class="btn btn-danger btn-sm" @click.prevent="remove(form)" :disabled="isProcessing">Eliminar</button>
                    </template>
                    <button type="button" class="btn btn-secondary btn-sm" @click="$router.back()" :disabled="isProcessing">Cancel</button>
                </div>
            </div>

            <div class="card">
                <div class="card card-body">
                    <div class="form-group">
                        <label>Grupo de obrero</label>
                        <select :id="form.grupo_obrero_id" :name="form.grupo_obrero_id" class="form-control" v-model="form.grupo_obrero_id">
                            <option disabled value="">Seleccione</option>
                            <option v-for="g in grupo_obreros" :value="g.id" selected = " form.grupo_obrero_id == g.id ? true : false ">{{ g.name }}</option>
                        </select>
                        <small class="error-control" v-if="error.errors.grupo_obrero_id">{{error.errors.grupo_obrero_id[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name">
                        <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Jornal hora</label>
                        <input type="number" step="any" class="form-control" v-model="form.jornalhora">
                        <small class="error-control" v-if="error.errors.jornalhora">{{error.errors.jornalhora[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Factor</label>
                        <input type="number" step="any" class="form-control" v-model="form.factor">
                        <small class="error-control" v-if="error.errors.factor">{{error.errors.factor[0]}}</small>
                    </div>
                </div>
		    </div>
        </div>
    </div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../../helpers/flash'
	import { get, post, del } from '../../../helpers/api'
	import { toMulipartedForm } from '../../../helpers/form'
	import ImageUpload from '../../../components/ImageUpload.vue'

	export default {
		components: {
			ImageUpload
		},
		data() {
			return {
				grupo_obreros:[],
				form: {},
				error: {
				    errors:{}
                },
				isProcessing: false,
				initializeURL: `/api/obreros/create`,
				storeURL: `/api/obreros`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/obreros/${this.$route.params.id}/edit`
				this.storeURL = `/api/obreros/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				}),
			get(`/api/grupo_obreros`)
				.then((res) => {
					this.grupo_obreros = res.data.grupo_obreros
				})
		},
		methods: {
			save() {
                this.isProcessing = true
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/obrero`)
				        }
				        this.isProcessing = false
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				        }
				        this.isProcessing = false
				    })
			  },
			remove() {
				del(`/api/obreros/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente el obrero!')
					this.$router.back()
				});
      		}
		}
	}
</script>
