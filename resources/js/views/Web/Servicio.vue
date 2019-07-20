<template>
    <div class="row">
        <div class="col-md">
            <h5><i class="fa fa-address-book" aria-hidden="true"></i> Servicios
                <router-link to="/users" class="btn btn-secondary btn-sm float-right">Arquitectos</router-link>
                <router-link to="/users" class="btn btn-secondary btn-sm float-right">Especialistas</router-link>
                <router-link to="/roles" class="btn btn-secondary btn-sm float-right">Ingenieros</router-link>
                <router-link to="/roles" class="btn btn-secondary btn-sm float-right">Maestros/Obreros</router-link>
                <router-link to="/permissions" class="btn btn-secondary btn-sm float-right">Profesionales</router-link>
                <router-link to="/users" class="btn btn-secondary btn-sm float-right">Proveedores</router-link>

            </h5>
            <hr>
            <div class="form-group row">
                <h5 class="col-7"><i class="fa fa-users"></i> Usuarios</h5>
                <div class="form-group col-4">
                    <input
                        type="search"
                        class="form-control mr-sm-2 mb-2 mb-sm-0"
                        placeholder="Search..."
                        autocomplete="off"
                        v-model="searchQuery">
                </div>
                <div>
                    <router-link to="/users/create" class="btn btn-primary"> Nuevo</router-link>
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
    import { get } from '../../helpers/api'
    import ListaSearch from '../../components/ListaSearch.vue'
    export default {
        components: {
            ListaSearch
        },
        data() {
            return {
                searchQuery:'',
                gridData: [],
                gridColumns:['roles', 'name', 'email', 'updated_at'],
                lista:'users',
                isAutorized: false
            }
        },
        created() {
            get(`../api/users`)
                .then((res) => {
                    //console.log(res);
                    this.gridData = res.data.users
                })
        }
    }
</script>
