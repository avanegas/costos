<template>
    <div class="container">
        <header>
            <h2>Menu</h2>
            <a href="#" class="stuts">INFOASISTENCIA <span>Costos</span></a>
        </header>
        <nav class="menu navbar navbar-expand-lg navbar-dark bg-dark">
            <router-link class="navbar-brand" to="/">-Apuntes-</router-link>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Datos</a>
                    <nav class="submenu">
                        <router-link class="nav-link" to="/equipo" >Equipos</router-link>
                        <router-link class="nav-link" to="/material">Materiales</router-link>
                        <router-link class="nav-link" to="/obrero">Obreros</router-link>
                        <router-link class="nav-link" to="/transporte">Transportes</router-link>
                        <router-link class="nav-link" to="/general">Generales</router-link>
                        <router-link class="nav-link" to="/indirecto">Indirectos</router-link>
                        <router-link class="nav-link" to="/indice">Indices</router-link>
                    </nav>
                </li>
                <li  class="nav-item"><router-link class="nav-link" to="/precios">Precios</router-link></li>
                <li  class="nav-item"><router-link class="nav-link" to="/proyectos">Proyectos</router-link></li>
                <li  class="nav-item"><router-link class="nav-link" to="/oferta">Ofertas</router-link></li>
                <li  class="nav-item"><router-link class="nav-link" to="/servicio">Servicios</router-link></li>
            </ul>
            <ul class="navbar-nav justify-content-right">
                <li class="nav-item" v-if="auth">
                    <a href="#">Grupos</a>
                    <nav class="submenu">
                        <router-link class="nav-link" to="/categories" >Categorias</router-link>
                        <router-link class="nav-link" to="/tags">Etiquetas</router-link>
                        <router-link class="nav-link" to="/grupo_equipos" >GEquipos</router-link>
                        <router-link class="nav-link" to="/grupo_materials">GMateriales</router-link>
                        <router-link class="nav-link" to="/grupo_obreros">GObreros</router-link>
                        <router-link class="nav-link" to="/grupo_precios">GPrecios</router-link>
                        <router-link class="nav-link" to="/zonas">Zonas</router-link>
                    </nav>
                </li>
                <li class="nav-item" v-if="auth">
                    <a class="nav-link" href="#">Entradas</a>
                    <nav class="submenu">
                        <router-link class="nav-link" :to="`/posts/${authState.user_id}`" >Artículos</router-link>
                        <router-link class="nav-link" :to="`/ofertas/${authState.user_id}`" >Ofertas</router-link>
                        <router-link class="nav-link" to="/servicios" >Servicios</router-link>
                    </nav>
                <li class="nav-item" v-if="guest"><router-link class="nav-link" to="/login">INICIAR</router-link></li>
                <li class="nav-item" v-if="guest"><router-link class="nav-link" to="/register">REGISTRO</router-link></li>
                <li class="nav-item" v-if="auth">
                    <a class="nav-link" href="#">{{ authState.user_id }}</a>
                    <nav class="submenu">
                        <router-link class="nav-link" to="/users" v-if="auth" >Administrar</router-link>
                        <router-link class="nav-link" to="/profiles" v-if="auth" >Perfil</router-link>
                        <a class="nav-link" href="#" @click.stop="logout" v-if="auth">SALIR</a>
                    </nav>
                </li>
            </ul>
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
