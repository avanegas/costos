<template>
	<div class="row">
		<div class="col-md">
			<div class="form-group row">
				<div class="form-group col-9">
					<h3>{{action}} Articulo</h3>
				</div>
				<div>
					<button type="button" class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
	        		<template v-if="action == 'Update'">
	            		<button type="button" class="btn btn-danger" @click.prevent="remove(form)" :disabled="isProcessing">Eliminar</button>
	        		</template>
					<button type="button" class="btn" @click="$router.back()" :disabled="isProcessing">Cancel</button>
				</div>
			</div>
			<div class="card">
				<div class="card card-body">
					<div class="image-show">
						<div class="recipe__box">
							<image-upload v-model="form.image"></image-upload>
							<small class="error-control" v-if="error.image">{{error.image[0]}}</small>
						</div>
					</div>
					<div class="recipe-details">
						<div class="recipe__box">
							<div class="form-group">
								<label for="category_id">Categoría</label>
								<select id="category_id" name="category_id" class="form-control" v-model="form.category_id">
									<option disabled value="">seleccione</option>
									<option v-for="c in categories" :value="c.id" selected = " form.category_id == c.id ? true : false ">{{ c.name }}</option>
								</select>
							</div>
							<div class="form-group">
								<label>Titulo</label>
								<input type="text" class="form-control" v-model="form.name">
								<small class="error-control" v-if="error.name">{{error.name[0]}}</small>
							</div>
							<div class="form-group">
								<label>Slug</label>
								<input type="text" class="form-control" v-model="form.slug">
								<small class="error-control" v-if="error.slug">{{error.slug[0]}}</small>
							</div>
							<div class="form-group">
								<label>Resumen</label>
								<input type="text" class="form-control" v-model="form.excerpt">
								<small class="error-control" v-if="error.excerpt">{{error.excerpt[0]}}</small>
							</div>
							<div class="form-group">
								<label>Contenido</label>
								<textarea class="form-control form-description" v-model="form.bodyt"></textarea>
								<small class="error-control" v-if="error.bodyt">{{error.bodyt[0]}}</small>
							</div>
							<p>Estado del articulo</p>							
							<div class="form-group">
								<input type="radio" name="draft" v-model="form.status" Checked>
								<label for="draft">Draft</label>

								<input type="radio" name="publicado" v-model="form.status">
								<label for="publicado">Publicado</label>
							</div>
							<div class="form-group">
								<label>Etiquetas de categorización específica</label>
								<input type="text" class="form-control" v-model="form.tags">
								<small class="error-control" v-if="error.tags">{{error.tags[0]}}</small>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>		
	</div>

</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import ImageUpload from '../../components/ImageUpload.vue'

	export default {
		components: {
			ImageUpload
		},
		data() {
			return {
				categories:[],
				form: {},
				error: {},
				isProcessing: false,
				initializeURL: `/api/posts/create`,
				storeURL: `/api/posts`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/posts/${this.$route.params.id}/edit`
				this.storeURL = `/api/posts/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
			.then((res) => {
				Vue.set(this.$data, 'form', res.data.form)
			}),
			get(`/api/categories`)
			.then((res) => {
				this.categories = res.data.categories
			})
		},
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				.then((res) => {
					if(res.data.saved) {
						Flash.setSuccess(res.data.message)
						this.$router.push(`/posts/${res.data.id}`)
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
				alert('borrar');
			}
		}
	}
</script>
