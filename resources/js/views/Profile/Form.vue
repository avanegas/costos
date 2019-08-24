<template>
    <div class="row">
        <div class="col-12 mb-3 mt-3">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-sm-4 col-md-3">

                                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                    <span>Administración</span>
                                    <a class="d-flex align-items-center text-muted" href="#">
                                        <span data-feather="plus-circle"></span>
                                    </a>
                                </h6>
                                <ul class="nav flex-column mb-2">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">
                                            <span data-feather="file-text"></span>
                                            Profile Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <span data-feather="file-text"></span>
                                            Acount Settings
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <span data-feather="file-text"></span>
                                            Account Administration
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane fade edit-profile-tab active show">
                                        <div class="row mb-1">
                                            <div class="col-sm-12">
                                                <div class="card-body">

                                                    <div class="border" >
                                                        <img :src="`/images/${form.avatar}`" alt="avatar" class="user-avatar" v-if="form.avatar_status === 1">
                                                        <img :src="`/images/persona1.jpg`" alt="avatar" class="user-avatar" v-else>
                                                        <div class="dz-default dz-message">
                                                            <span class="mb-2">Arrastre y suelte los archivos a subir aqui.</span>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-sm-12 btn-group">
                                                            <div class="col-6 col-xs-6 right-btn-container">
                                                                <label class="btn btn-primary btn-block" for="0">
                                                                    <input type="radio" id="0" value="0" v-model="form.avatar_status" > Use Gravatar
                                                                </label>
                                                            </div>
                                                            <div class="col-6 col-xs-6 left-btn-container">
                                                                <label class="btn btn-primary btn-block" for="1">
                                                                    <input type="radio" id="1" value="1" v-model="form.avatar_status"> Use My Image
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="form-group">
                                                            <p class="font-weight-bold">Status</p>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="public" value="PUBLIC" v-model="form.status">
                                                                <label class="form-check-label" for="public"> PUBLICO</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="private" value="PRIVATE" v-model="form.status">
                                                                <label class="form-check-label" for="private"> PRIVADO </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Actividad</label>
                                                            <input type="text" class="form-control" v-model="form.tipo">
                                                            <small class="error-control" v-if="error.errors.tipo">{{error.errors.tipo[0]}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold" for="experiencia">Experiencia</label>
                                                            <textarea class="form-control" id="experiencia" rows="8" v-model="form.bio"></textarea>
                                                            <small class="error-control" v-if="error.errors.bio">{{error.errors.bio[0]}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Teléfonos</label>
                                                            <input type="text" class="form-control" v-model="form.phone">
                                                            <small class="error-control" v-if="error.errors.phone">{{error.errors.phone[0]}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Twitter Username</label>
                                                            <input type="text" class="form-control" v-model="form.twitter_username">
                                                            <small class="error-control" v-if="error.errors.twitter_username">{{error.errors.twitter_username[0]}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Github Username</label>
                                                            <input type="text" class="form-control" v-model="form.github_username">
                                                            <small class="error-control" v-if="error.errors.github_username">{{error.errors.github_username[0]}}</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Location</label>
                                                            <input type="text" class="form-control" v-model="form.location">
                                                            <small class="error-control" v-if="error.errors.location">{{error.errors.location[0]}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    import { get, post, del, byMethod } from '../../helpers/api'
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
                initializeURL: `/api/profiles/create`,
                storeURL: `/api/profiles`,
                action: 'Create'
            }
        },
        created() {
            if(this.$route.meta.mode === 'edit') {
                this.initializeURL = `/api/profiles/${this.$route.params.id}/edit`
                this.storeURL = `/api/profiles/${this.$route.params.id}?_method=PUT`
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
                const form = toMulipartedForm(this.form, this.$route.meta.mode);
                post(this.storeURL, form)
                    .then((res) => {
                        if(res.data.saved) {
                            Flash.setSuccess(res.data.message)
                            this.$router.push(`/profiles/${res.data.id}`)
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
                del(`/api/profiles/${this.$route.params.id}`).then((res) => {
                    Flash.setSuccess('Ha eliminado correctamente el Perfil!')
                    this.$router.back()
                });
            }
        }
    }
</script>
<style lang="scss">
    .user-avatar {
        width: 80px;
        height:80px;
        margin: 2em auto;
        display:block;
        border-radius: 50%;
    }
    .dropzone.dz-clickable.dz-message {
        cursor: pointer;
    }
    .dz-message {
        padding: 0;
        text-align: center;
    }
    message.dz-default {
        margin: 0 2em;
    }
    @media(min-width: 320px) {
        .col-xs-6.right-btn-container {
            border-radius: 3px 0 0 3px;
            padding-right: 0;
        }
        .col-xs-6.left-btn-container {
            border-radius: 0 3px 3px 0;
            padding-left: 0;
        }
    }
</style>
