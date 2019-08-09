<template>
    <div class="row">
        <div class="col-md">
            <div class="card mb-3 mt-3">
                <div class="card-header">
                    {{profile.user.name}}&#039;s Perfil
                </div>
                <div class="card-body">
                    <img :src="`/images/${profile.avatar}`" v-if="profile.avatar" class="user-avatar">
                    <dl class="user-info">
                        <dt> Name</dt>
                        <dd>{{profile.user.name}}</dd>
                        <dt> Actividad</dt>
                        <dd>{{profile.tipo}}</dd>
                        <dt> Location</dt>
                        <dd>{{profile.location}}</dd>
                        <dt> E-mail Address</dt>
                        <dd>{{profile.user.email}}</dd>
                        <dt> Phone</dt>
                        <dd>{{profile.phone}}</dd>
                        <dt> Biografía</dt>
                        <dd>{{profile.bio}}</dd>
                        <dt> Twitter Username</dt>
                        <dd><a href="https://twitter.com/@_avanegas" class="twitter-link" target="_blank">@_avanegas</a></dd>
                        <dt> Github Username</dt>
                        <dd><a href="https://github.com/avanegas" class="github-link" target="_blank">avanegas</a></dd>
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
