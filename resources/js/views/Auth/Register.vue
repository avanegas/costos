<template>      
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default mt-5">
                <div class="card-header">Deseo <b>REGISTRARME</b>, soy <i><small>decente</small></i> <b>:)</b></div>
                <div class="card-body">
                    <form class="form" @submit.prevent="register">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="form.name">
                                <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-6">    
                                <input id="email" type="email" class="form-control" v-model="form.email">
                                <small class="error-control" v-if="error.errors.email">{{error.errors.email[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="form.password">
                                <small class="error-control" v-if="error.errors.password">{{error.errors.password[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" v-model="form.password_confirmation">
                                <small class="error-control" v-if="error.errors.password_confirmation">{{error.errors.password_confirmation[0]}}</small>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button :disabled="isProcessing" class="btn btn-primary">Registrarse</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Flash from '../../helpers/flash'
    import { post } from '../../helpers/api'
    export default {
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                error: {
                    errors:{}
                },
                isProcessing: false
            }
        },
        methods: {
            register() {
                this.isProcessing = true
                this.error = {}
                post('api/register', this.form)
                    .then((res) => {
                        if(res.data.registered) {
                            Flash.setSuccess('Yeaa! Se ha registrado correctamente.')
                            this.$router.push('/login')
                        }
                        this.isProcessing = false
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.error = err.response.data
                        }
                        this.isProcessing = false
                    })
            }
        }
    }
</script>
