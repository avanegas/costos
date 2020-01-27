<template>
    <div class="row">
        <div class="col-md">
            <div class="col-md">
                <div class="row m-0 mt-2">
                    <h5 class="col-2 p-0"><i class="fa fa-address-book" aria-hidden="true"></i> Servicios</h5>
                    <div class="form-group col-10 m-0 mt-2 mb-0 p-0">
                        <router-link to="/users"        class="btn btn-secondary btn-sm mr-1 float-right">Proveedores</router-link>
                        <router-link to="/permissions"  class="btn btn-secondary btn-sm mr-1 float-right">Profesionales</router-link>
                        <router-link to="/roles"        class="btn btn-secondary btn-sm mr-1 float-right">Maestros/Obreros</router-link>
                        <router-link to="/roles"        class="btn btn-secondary btn-sm mr-1 float-right">Ingenieros</router-link>
                        <router-link to="/users"        class="btn btn-secondary btn-sm mr-1 float-right">Especialistas</router-link>
                        <router-link to="/users"        class="btn btn-secondary btn-sm mr-1 float-right">Arquitectos</router-link>
                    </div>
                </div>
            </div>
            <div class="form-group row m-0 mt-2 mb-2">
                <h5 class="col-7"><i class="fas fa-home"></i> Arquitectura <small style="color:rgb(51,115,255);">&nbsp.&nbsp.&nbsp&nbspEstudio, Diseño, Construcción, Fiscalización, otros.</small></h5>
                <div class="col-4 p-0">
                    <input
                        type="search"
                        class="form-control mr-sm-2 mb-2 mb-sm-0"
                        placeholder="Search..."
                        autocomplete="off"
                        v-model="searchQuery">
                </div>
                <div class="col-1">
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
