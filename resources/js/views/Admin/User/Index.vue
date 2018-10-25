<template>
	<div class="container">
		<div class="row">
			<div class="col-md">
                <div class="form-group row border">
                    <div class="col-md-8">
	                   <h3><i class="fa fa-lock-open"></i> Administración </h3>
                    </div>
                    <div class="form-group col-md-4">
                        <router-link to="/users" class="btn btn-secondary btn-sm">Usuarios</router-link>&nbsp
                        <router-link to="/roles" class="btn btn-secondary btn-sm">Roles</router-link>&nbsp
                        <router-link to="/permissions" class="btn btn-secondary btn-sm">Permisos</router-link>
                    </div>
                </div>
	            
	            <div class="form-group row">
                    <div class="form-group col-md-6">
	                   <h3><i class="fa fa-users"></i> Usuarios</h3>
                    </div>
	                <div class="form-group col-md-4">
                        <input
                            type="text"
                            class="form-control mr-sm-2 mb-2 mb-sm-0"
                            placeholder="Search..."
                            autocomplete="off"
                            v-model="searchQuery">
                    </div>
                    <div class="form-group col-md-2">
                        <a href="#" class="btn btn-primary btn-sm"> Nuevo</a>
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
                gridColumns:['id', 'roles', 'name', 'email', 'updated_at'],
                lista:'users',
                isAutorized: false
            }
        },
        created() {
            get(`../api/users`)
                .then((res) => {
                    this.gridData = res.data.users
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
