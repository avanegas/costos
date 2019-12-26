<template>
    <div class="row">
        <div class="col-md">
            <div class="card mb-3 mt-3">
                <div class="card-header">
                    <h5>{{profile.user.name}}&#039;s<span style="color:rgb(51,115,255);">&nbspPerfil</span></h5>
                </div>
                <div class="card-body">
                    <img :src="`/images/${profile.avatar}`" v-if="profile.avatar" class="user-avatar">
                    <dl class="user-info">
                        <div class="title">
                            <h5>{{profile.user.name}}</h5>
                        </div>
                        <dd>{{profile.bio}}</dd>
                        <hr>

                        <p><i class="fa fa-briefcase info"></i>{{profile.tipo}}</p>
                        <p><i class="fa fa-home info"></i>{{profile.location}}</p>
                        <p><i class="fa fa-envelope info"></i>{{profile.user.email}}</p>
                        <p><i class="fa fa-phone info"></i>{{profile.phone}}</p>

                        <p><i class="fa fa-asterisk info"></i>Habilidades</p>

                        <p>Software</p>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width:80%">80%</div>
                        </div>

                        <p>Programación</p>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width:80%">80%</div>
                        </div>

                        <p>Construcción</p>
                        <div class="skill-bar">
                            <div class="progress-bar" style="width:80%">80%</div>
                        </div>

                        <p><i class="fab fa-twitter info"></i><a href="`https://twitter.com/${profile.}`" class="twitter-link" target="_blank">{{profile.twitter_username}}</a></p>
                        <p><i class="fab fa-github info"></i><a href="https://github.com/${profile.github_username}" class="github-link" target="_blank">{{profile.github_username}}</a></p>
                    </dl>
                    <router-link :to="`/profiles/${authState.user_id}/edit`" title="Editar Perfil" class="btn btn-small btn-info btn-block">
                        <i class="fa fa-fw fa-cog" aria-hidden="true"></i>Editar Perfil
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Auth from '../../store/auth'
    import { get } from '../../helpers/api'
    export default {
        components: {
            Auth
        },
        data() {
            return {
                authState: Auth.state,
                profile: {
                    user:{}
                }
            }
        },
        created() {
            get(`/api/profiles/${this.$route.params.id}`)
                .then((res) => {
                    this.profile = res.data.profile
                })
        }
    }
</script>
