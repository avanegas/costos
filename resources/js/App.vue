<template>
    <div class="container">
        <header>
            <h2>Menu</h2>
            <a href="#" class="stuts">INFOASISTENCIA <span>Costos</span></a>
        </header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Apuntes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Datos</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <router-link class="dropdown-item" to="/equipo" >Equipos</router-link>
                            <router-link class="dropdown-item" to="/material">Materiales</router-link>
                            <router-link class="dropdown-item" to="/obrero">Obreros</router-link>
                            <router-link class="dropdown-item" to="/transporte">Transportes</router-link>
                            <router-link class="dropdown-item" to="/general">Generales</router-link>
                            <router-link class="dropdown-item" to="/indirecto">Indirectos</router-link>
                            <router-link class="dropdown-item" to="/indice">Indices</router-link>
                        </div>
                    </li>
                    <li  class="nav-item"><router-link class="nav-link" to="/precios">Precios</router-link></li>
                    <li  class="nav-item"><router-link class="nav-link" to="/proyectos">Proyectos</router-link></li>
                    <li  class="nav-item"><router-link class="nav-link" to="/oferta">Ofertas</router-link></li>
                    <li  class="nav-item"><router-link class="nav-link" to="/servicio">Servicios</router-link></li>
                </ul>

                <ul class="navbar-nav justify-content-right">
                    <li class="nav-item dropdown" v-if="auth">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Grupos</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <router-link class="dropdown-item" to="/categories" >Categorías</router-link>
                            <router-link class="dropdown-item" to="/tags">Etiquetas</router-link>
                            <router-link class="dropdown-item" to="/grupo_equipos" >Grupo Equipos</router-link>
                            <router-link class="dropdown-item" to="/grupo_materials">Grupo Materiales</router-link>
                            <router-link class="dropdown-item" to="/grupo_obreros">Grupo Obreros</router-link>
                            <router-link class="dropdown-item" to="/grupo_precios">Grupo Precios</router-link>
                            <router-link class="dropdown-item" to="/zonas">Zonas</router-link>
                        </div>
                    </li>
                    <li class="nav-item dropdown" v-if="auth">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Entradas</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown03">
                            <router-link class="dropdown-item" :to="`/posts/${authState.user_id}`" >Artículos</router-link>
                            <router-link class="dropdown-item" :to="`/ofertas/${authState.user_id}`" >Ofertas</router-link>
                            <router-link class="dropdown-item" to="/servicios" >Servicios</router-link>
                        </div>
                    </li>
                    <li class="nav-item" v-if="guest">
                        <router-link class="nav-link" to="/login">INICIAR</router-link>
                    </li>
                    <li class="nav-item" v-if="guest">
                        <router-link class="nav-link" to="/register">REGISTRO</router-link>
                    </li>
                    <li class="nav-item dropdown" v-if="auth">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ authState.user_id }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <router-link class="dropdown-item" to="/users" v-if="auth" >Administrar</router-link>
                            <router-link class="dropdown-item" :to="`/profiles/${authState.user_id}`" v-if="auth" >Perfil</router-link>
                            <a class="dropdown-item" href="#" @click.stop="logout" v-if="auth">SALIR</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="alert alert-danger" role="alert" v-if="flash.error">
            {{flash.error}}
        </div>
        <div class="alert alert-success" role="alert" v-if="flash.success">
            {{flash.success}}
        </div>
        <router-view></router-view>
    </div>
</template>
<script type="text/javascript">
    import Auth from './store/auth'
    import Flash from './helpers/flash'
    import { post, interceptors } from './helpers/api'
    export default {
        created() {
            // global error http handler
            interceptors((err) => {
                if(err.response.status === 401) {
                    Auth.remove()
                    this.$router.push('/login')
                }
                if(err.response.status === 500) {
                    Flash.setError(err.response.statusText)
                }
                if(err.response.status === 404) {
                    this.$router.push('/not-found')
                }
            })
            Auth.initialize()
        },
        data() {
            return {
                authState: Auth.state,
                flash: Flash.state
            }
        },
        computed: {
            auth() {
                if(this.authState.api_token) {
                    return true
                }
                return false
            },
            guest() {
                return !this.auth
            }
        },
        methods: {
            getlogin(){
            },
            logout() {
                post('/api/logout')
                    .then((res) => {
                        if(res.data.done) {
                            // remove token
                            Auth.remove()
                            Flash.setSuccess('Ha terminado su sesión correctamente. Gracias y suerte!')
                            this.$router.push('/')
                        }
                    })
            }
        }
    }
</script>
