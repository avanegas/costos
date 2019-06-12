<template>
    <div class="row">
        <div class="col-md" >                
            <div class="form-group row">
                <h5 class="col-7">Ofertas</h5>
                <div class="col-4 form-group">
                    <input
                        type="search"
                        class="form-control mr-sm-2 mb-2 mb-sm-0"
                        placeholder="Search..."
                        autocomplete="off"
                        v-model="searchQuery">
                </div>
                 <div v-if="authState.api_token && authState.user_id === 1">
                    <router-link to="/ofertas/create" class="btn btn-primary"> Nuevo</router-link>
                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <lista-search
                        :data="gridData"
                        :columns="gridColumns"
                        :filter-key="searchQuery"
                        :lista="lista"
                        :isAutorized="isAutorized">
                    </lista-search>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import { get } from '../../helpers/api'
    import ListaSearch from '../../components/ListaSearch.vue'
    export default {
        components: {
            ListaSearch
        },
        data() {
            return {
                authState: Auth.state,
                searchQuery:'',
                gridData: [],
                gridColumns:['name', 'status', 'file', 'updated_at'],
                lista:'ofertas',
                isAutorized: false
            }
        },
        created() {
            get(`/api/ofertas/${this.$route.params.id}`)
                .then((res) => {
                    this.gridData = res.data.ofertas
                })
        }
    }
</script>
