<template>
	<div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="form-group col-10">
                    <h5>{{action}} Oferta</h5>
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
                                <label>Oferta</label>
                                <input type="text" class="form-control" v-model="form.name">
                                <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
                            </div>
                            <div class="form-group">
                                <label>Unidad</label>
                                <input type="text" class="form-control" v-model="form.unidad">
                                <small class="error-control" v-if="error.errors.unidad">{{error.errors.unidad[0]}}</small>
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control" v-model="form.precio">
                                <small class="error-control" v-if="error.errors.precio">{{error.errors.precio[0]}}</small>
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="text" class="form-control" v-model="form.stock">
                                <small class="error-control" v-if="error.errors.stock">{{error.errors.stock[0]}}</small>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control form-description" v-model="form.descripcion"></textarea>
                                <small class="error-control" v-if="error.errors.descripcion">{{error.errors.descripcion[0]}}</small>
                            </div>
                            <div class="form-group">
                                <p>Estado de la oferta</p>
                                <input type="radio" id="DRAFT" value="DRAFT" v-model="form.status">
                                <label for="DRAFT">DRAFT</label>
                                <input type="radio" id="PUBLISHED" value="PUBLISHED" v-model="form.status">
                                <label for="PUBLISHED">PUBLISHED</label>
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
	import { get, post, del } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import ImageUpload from '../../components/ImageUpload.vue'
	export default {
		components: {
			ImageUpload
		},
		data() {
			return {
                authState: Auth.state,
				form: {},
				error: {
                    errors:{}
                },
				isProcessing: false,
				initializeURL: `/api/ofertas/create`,
				storeURL: `/api/ofertas`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/ofertas/${this.$route.params.id}/edit`
				this.storeURL = `/api/ofertas/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
			.then((res) => {
				Vue.set(this.$data, 'form', res.data.form)
			})
		},
		methods: {
			save() {
                this.isProcessing = true;
                this.form.user_id = this.authState.user_id;
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				.then((res) => {
					if(res.data.saved) {
						Flash.setSuccess(res.data.message)
						this.$router.push(`/ofertas/${res.data.id}`)
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
                del(`/api/ofertas/${this.$route.params.id}`).then((res) => {
                    Flash.setSuccess('Ha eliminado correctamente la Oferta!')
                    this.$router.back()
                });
			}
		}
	}
</script>
