<template>
    <div class="row">
        <div class="col-md">
			<div class="form-group row">
				<div class="form-group col-9">
					<h3>{{action}} User</h3>
				</div>
				<div>
					<button type="button" class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
	        		<template v-if="action == 'Update'">
	            		<button type="button" class="btn btn-danger" @click.prevent="remove(form)" :disabled="isProcessing">Eliminar</button>
	        		</template>
					<button type="button" class="btn btn-secondary" @click="$router.back()" :disabled="isProcessing">Cancel</button>
				</div>
			</div>

			<div class="card">
				<div class="card card-body">

					<div class="form-group">
					    <label>Name</label>
					    <input type="text" class="form-control" v-model="form.name">
					    <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
					</div>
					<div class="form-group">
					    <label >Email</label>
					    <input type="email" class="form-control" v-model="form.email">
					    <small class="error-control" v-if="error.errors.email">{{error.errors.email[0]}}</small>
					</div>
<!---->
					<div class="form-group">
						<label>Asignar Rol</label>
						<select class="form-control" id="role_id" name="role_id" :v-model="form.role_id">
							<option disabled value="">seleccione</option>
							<option v-for="r in roles" :key="r.id">{{ r.name }}</option>
						</select>
						<small class="error-control" v-if="error.errors.role_id">{{error.errors.role_id[0]}}</small>
					</div>
					
					<div class="form-group">
						<label>Asignar role</label>
	                    <div class="checkboxes offset-md-1" v-for = "role in roles" :key="role.id">
	                		<input class="form-check-input" 
								type = "checkbox"
	                			:id = "role.name"
	                			value = "role"
								unchecked-value = "activated"
	                			v-model = "form.roles"/>
	                		<label :for = "role.name">{{ role.name }}</label>,
	                    </div>
                	</div>

					<div class="form-group">
					    <label>Password</label>
					    <input type="password" class="form-control" v-model="form.password">
					    <small class="error-control" v-if="error.errors.password">{{error.errors.password[0]}}</small>
					</div>
					<div class="form-group">
					    <label>Confirme Password</label>
					    <input type="password" step="any" class="form-control" v-model="form.password_confirmation">
					    <small class="error-control" v-if="error.errors.password_confirmation">{{error.errors.password_confirmation[0]}}</small>
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
				roles:[],
				form: {
					roles:[]
				},
				error: {
					errors:{}
				},
				isProcessing: false,
				initializeURL: `/api/users/create`,
				storeURL: `/api/users`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/users/${this.$route.params.id}/edit`
				this.storeURL = `/api/users/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				}),
			get(`/api/roles`)
				.then((res) => {
					this.roles = res.data.roles
				})
		},
		methods: {
			save() {
				this.isProcessing = true
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				console.log(form);			
				post(this.storeURL, form)
				    .then((res) => {

				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/users`)
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
				del(`/api/users/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente el user!')
					this.$router.back()
				});
      		},
			activated: function(role){
				console.log(this.form.roles[0].id, role.id)
				console.log(_.findIndex(this.form.roles, function(r) {
					return r.id == role.id;})>= 0)

			  	return _.findIndex(this.form.roles, function(r) {
				  	return r.id == role.id;})>= 0;
			}
		}
	}
</script>
