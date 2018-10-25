<template>
	<div class="container">
		<div class="row">
			<div class="col-md">

	            <h3><i class="fas fa-lock-open"></i> Administración
                    <router-link to="/users" class="btn btn-sm btn-secondary float-right">Usuarios</router-link>
                    <router-link to="/roles" class="btn btn-sm btn-secondary float-right">Roles</router-link>
                    <router-link to="/permissions" class="btn btn-sm btn-secondary float-right">Permisos</router-link>
	            </h3>

	            <hr>
	            
	            <div class="form-group row">
	                <h3 class="col-7"><i class="fa fa-users"></i> Roles</h3>
	                <div class="col-4 form-group">
                        <input
                            type="text"
                            class="form-control mr-sm-2 mb-2 mb-sm-0"
                            placeholder="Search..."
                            autocomplete="off"
                            v-model="searchQuery">
                    </div>
                    <a href="#" class="btn btn-sm btn-primary"> Nuevo</a>
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
    </div>
</template>
<script type="text/javascript">
    import { get } from '../../../helpers/api'
    import ListaSearch from '../../../components/ListaSearch.vue'
    export default {
        components: {
            ListaSearch
        },
        data() {
            return {
                scrollPosition: 0,
                searchQuery:'',
                gridData: [],
                gridColumns:['id', 'name', 'permissions'],
                lista:'roles',
                isAutorized: false
            }
        },
        created() {
            get(`../api/roles`)
                .then((res) => {
                    this.gridData = res.data.roles
                })
        },
        methods: {
            handleScroll: function (e) {
                var currentScrollPosition = e.srcElement.scrollTop;
                if (currentScrollPosition > this.scrollPosition) {
                    console.log("Scrolling down");
                }
                this.scrollPosition = currentScrollPosition;
            }
        }
    }
</script>