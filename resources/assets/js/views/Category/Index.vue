<template>
    <div class="container">
        <div class="row">
            <div class="col-md" >
                
                <div class="form-group row">
                    <h3 class="col-7">Categorías de apuntes</h3>
                    <div class="col-4 form-group">
                        <input
                            type="text"
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
                scrollPosition: 0,
                searchQuery:'',
                gridData: [],
                gridColumns:['id', 'name', 'slug', 'body', 'updated_at'],
                lista:'categories',
                isAutorized: false
            }
        },
        created() {
            get(`/api/categories`)
                .then((res) => {
                    this.gridData = res.data.categories
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