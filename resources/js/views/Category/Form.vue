<template>
    <div class="row">
        <div class="col-md">
			<div class="form-group row">
				<div class="form-group col-9">
					<h3>{{action}} Category</h3>
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
					    <label>Slug</label>
					    <input type="text" class="form-control" v-model="form.slug">
					    <small class="error-control" v-if="error.errors.slug">{{error.errors.slug[0]}}</small>
					</div>
					<div class="form-group">
					    <label>body</label>
					    <input type="text" class="form-control" v-model="form.body">
					    <small class="error-control" v-if="error.errors.body">{{error.errors.body[0]}}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post, del } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
		
	export default {
		data() {
			return {
				form: {},
				error: {
					errors:{}
				},
				isProcessing: false,
				initializeURL: `/api/categories/create`,
				storeURL: `/api/categories`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/categories/${this.$route.params.id}/edit`
				this.storeURL = `/api/categories/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
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
				            this.$router.push(`/categories`)
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
				del(`/api/categories/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente el category!')
					this.$router.back()
				});
      		}
		}
	}
</script>