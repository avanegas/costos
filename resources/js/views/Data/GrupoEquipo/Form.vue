<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row mb-3 mt-3">
				<div class="form-group col-10">
					<h5>{{action}} Grupo de equipos</h5>
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
						<label for="zona_id">Zona</label>
						<select id="zona_id" name="zona_id" class="form-control" v-model="form.zona_id">
							<option disabled value="">Seleccione</option>
							<option v-for="z in zonas" :value="z.id" selected = " form.zona_id == z.id ? true : false ">{{ z.name }}</option>
						</select>
                        <small class="error-control" v-if="error.errors.zona_id">{{error.errors.zona_id[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Name</label>
					    <input type="text" class="form-control" v-model="form.name">
					    <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Descripcion</label>
					    <textarea name="descriptio" class="form-control" rows="10" v-model="form.description"></textarea>
					    <small class="error-control" v-if="error.errors.description">{{error.errors.description[0]}}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Auth from '../../../store/auth'
	import Flash from '../../../helpers/flash'
	import { get, post, del } from '../../../helpers/api'
	import { toMulipartedForm } from '../../../helpers/form'

	export default {
		data() {
			return {
				authState: Auth.state,
				zonas: [],
				form: {},
				error: {
					errors:{}
				},
				isProcessing: false,
				initializeURL: `/api/grupo_equipos/create`,
				storeURL: `/api/grupo_equipos`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/grupo_equipos/${this.$route.params.id}/edit`
				this.storeURL = `/api/grupo_equipos/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				}),
			get(`/api/zonas`)
				.then((res) => {
					this.zonas = res.data.zonas
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
				            this.$router.push(`/grupo_equipos`)
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
				del(`/api/grupo_equipos/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente el Grupo de Equipos!')
					this.$router.back()
				});
      		}
		}
	}
</script>
