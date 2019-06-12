<template>
    <div class="row">
        <div class="col-md" >            
            <div class="form-group row">
            	<h5 class="col-7">Transportes</h5>
                <div class="col-4 form-group">
                    <input
                    	type="search"
                    	class="form-control mr-sm-2 mb-2 mb-sm-0"
                    	placeholder="Search..."
                    	autocomplete="off"
                    	v-model="searchQuery">
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
                gridColumns:['zona_id', 'name', 'unidad', 'tipo', 'tarifa', 'updated_at'],
                lista:'transportes',
                isAutorized: false
            }
        },
        created() {
            get(`/api/transporte`)
                .then((res) => {
                    this.gridData = res.data.transportes
                })
        }
    }
</script>