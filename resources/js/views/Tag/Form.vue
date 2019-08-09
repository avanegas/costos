<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row mb-3 mt-3">
				<div class="form-group col-10">
					<h5>{{action}} Etiqueta</h5>
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
					    <label>Name</label>
					    <input type="text" class="form-control" v-model="form.name">
					    <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
					</div>
					<div class="form-group">
						<label>Slug</label>
						<input type="text" class="form-control input-sm" name="slug" :value="slug">
						<small class="error-control" v-if="error.errors.slug">{{error.errors.slug[0]}}</small>
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
				initializeURL: `/api/tags/create`,
				storeURL: `/api/tags`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/tags/${this.$route.params.id}/edit`
				this.storeURL = `/api/tags/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				})
		},
		computed: {
			slug: function() {
				this.form.slug = this.sanitizeName(this.form.name);
				return this.form.slug;
			}
		},
		methods: {
			sanitizeName: function(title) {
				let slug = "";
				if (title!== undefined){
					// Change to lower case
					let titleLower = title.toLowerCase();
					// Letter "e"
					slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
					// Letter "a"
					slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
					// Letter "o"
					slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
					// Letter "u"
					slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
					// Letter "d"
					slug = slug.replace(/đ/gi, 'd');
					// Trim the last whitespace
					slug = slug.replace(/\s*$/g, '');
					// Change whitespace to "-"
					slug = slug.replace(/\s+/g, '-');
				}
				return slug;
			},
			save() {
				this.isProcessing = true
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/tags`)
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
				del(`/api/tags/${this.$route.params.id}`).then((res) => {
					Flash.setSuccess('Ha eliminado correctamente la etiqueta!')
					this.$router.back()
				});
      		}
		}
	}
</script>
