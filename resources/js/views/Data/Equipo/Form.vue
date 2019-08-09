<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row mb-3 mt-3">
				<div class="form-group col-10">
					<h5>{{action}} Equipo</h5>
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
						<label>Grupo de equipo</label>
						<select :id="form.grupo_equipo_id" :name="form.grupo_equipo_id" class="form-control" v-model="form.grupo_equipo_id">
							<option disabled value="">Seleccione</option>
							<option v-for="ge in grupo_equipos" :key = "ge.id" :value = "ge.id">{{ ge.name }}</option>
						</select>
						<small class="error-control" v-if="error.errors.grupo_equipo_id">{{error.errors.grupo_equipo_id[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Name</label>
					    <input type="text" class="form-control" v-model="form.name">
					    <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Marca</label>
					    <input type="text" class="form-control" v-model="form.marca">
					    <small class="error-control" v-if="error.errors.marca">{{error.errors.marca[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Tipo</label>
					    <input type="text" class="form-control" v-model="form.tipo">
					    <small class="error-control" v-if="error.errors.tipo">{{error.errors.tipo[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Tarifa</label>
					    <input type="number" step="any" class="form-control" v-model="form.tarifa">
					    <small class="error-control" v-if="error.errors.tarifa">{{error.errors.tarifa[0]}}</small>
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
				grupo_equipos:[],
				form: {},
				error: {
					errors:{}
				},
				isProcessing: false,
				initializeURL: `/api/equipos/create`,
				storeURL: `/api/equipos`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/equipos/${this.$route.params.id}/edit`
				this.storeURL = `/api/equipos/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				}),
			get(`/api/grupo_equipos`)
				.then((res) => {
					this.grupo_equipos = res.data.grupo_equipos
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
				            this.$router.push(`/equipo`)
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
				del(`/api/equipos/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente el equipo!')
					this.$router.back()
				});
      		}
		}
	}
</script>
