<template>
	<div class="row">
		<div class="col-md">
			<div class="form-group row">
				<div class="form-group col-10">
					<h5>{{action}} Articulo</h5>
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
					<div class="image-show">
						<div class="card-body">
							<image-upload v-model="form.file"></image-upload>
							<small class="error-control" v-if="error.file">{{error.errors.file[0]}}</small>
						</div>
					</div>
					<div class="card">
						<div class="card-body">

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
								<small class="error-control" v-if="error.name">{{error.errors.name[0]}}</small>
							</div>
							<div class="form-group">
								<label>Resumen</label>
								<input type="text" class="form-control" v-model="form.excerpt">
								<small class="error-control" v-if="error.excerpt">{{error.errors.excerpt[0]}}</small>
							</div>
							<div class="form-group">
								<label>Contenido</label>
								<textarea class="form-control form-description" v-model="form.body"></textarea>
								<small class="error-control" v-if="error.bodyt">{{error.errors.bodyt[0]}}</small>
							</div>			
							<div class="form-group">
								<p>Estado del artículo</p>
								<input type="radio" id="DRAFT" value="DRAFT" v-model="form.status">
								<label for="DRAFT">DRAFT</label>
								<input type="radio" id="PUBLISHED" value="PUBLISHED" v-model="form.status">
								<label for="PUBLISHED">PUBLISHED</label>
							</div>
							<div class="form-group">
								<p>Seleccione las etiquétas de categoría específica</p>
								
								<div class="form-check form-check-inline" v-for = "tag in tags" :paso="true">

									<template v-for = "t in form.tags">
										<template v-if="tag.id == t.id">
											<input class="form-check-input" type="checkbox" id="t.name" :checked="true" :v-model="select" :paso="false"/>
										</template>
									</template>
									<template v-if = "paso">
										<input class="form-check-input" type="checkbox" id="tag.name" :checked="false" :v-model="select"/>
									</template>	

									<!--										
									<input
									type = "checkbox"
									:id = "tag.id"
									:value = "tag.id"
									:v-model = "form.tags"
									checked = "select">
									-->
									<label class="form-check-label" for = "tag.name">{{ tag.name }}</label>,
								</div>
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
	import Auth from '../../store/auth'
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
				authState: Auth.state,
				select: false,
				paso: true,
				categories: [],
				tags:[],
				form: {
					tags: []
				},
				error: {
					errors:{}
				},
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
			}),
			get(`/api/tags`)
			.then((res) => {
				this.tags = res.data.tags
			})
		},
		methods: {
			save() {
				this.isProcessing = true
				this.form.user_id = this.authState.user_id;
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
