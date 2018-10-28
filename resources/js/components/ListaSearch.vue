<template>
    <table class="table">
        <thead>
        <tr>
            <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{ active: sortKey == key }">
                {{ key | capitalize }}
                <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
                </span>
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="(entry, i) in filteredData" :entry="entry" @click="agrega(entry)">
                <td v-for="(key, index) in columns">
                    <template v-if = "index === 0">
                        <template v-if= "lista === 'equipos'">
                            {{ filteredData[i].grupo_equipo.name }}
                        </template>
                        <template v-else-if= "lista === 'materials'">
                            {{ filteredData[i].grupo_material.name }}
                        </template>
                        <template v-else-if= "lista === 'obreros'">
                            {{ filteredData[i].grupo_obrero.name }}
                        </template>
                        <template v-else-if= "lista === 'transportes'">
                            {{ filteredData[i].zona.name }}
                        </template>

                        <template v-else-if= "lista === 'precios'">
                            {{ filteredData[i].grupo_precio.name }}
                        </template>
                        <template v-else-if= "lista === 'proyectos'">
                            {{ filteredData[i].user.name }}
                        </template>

                        <template v-else-if= "lista === 'users'">
                            <span v-for="role in filteredData[i].roles">
                                {{ role.name }},
                            </span>                            
                        </template>

                        <template v-else-if= "lista === 'roles'">
                            {{ filteredData[i].name }}                          
                        </template>

                        <template v-else-if= "lista === 'permissions'">
                            {{ filteredData[i].name }}
                        </template>

                        <template v-else-if= "lista === 'posts'">
                            {{ filteredData[i].name }}
                        </template>

                        <template v-else-if= "lista === 'categories'">
                            {{ filteredData[i].name }}
                        </template>

                        <template v-else-if= "lista === 'tags'">
                            {{ filteredData[i].name }}
                        </template>

                        <template v-else>
                            {{ filteredData[i].id }}
                        </template>
                    </template>


                    <template v-else-if = "index === 1">
                        <template v-if= "lista === 'users'">
                            <span v-for="role in filteredData[i].roles">
                                {{ role.name }},
                            </span>
                        </template>

                        <template v-else-if= "lista === 'roles'">
                            <span v-for="permission in filteredData[i].permissions">
                                {{ permission.name }},
                            </span>
                        </template>

                        <template v-else>
                            {{entry[key]}}
                        </template>
                    </template>


                    <template v-else-if = "index === 2">

                        <template v-if= "lista === 'posts'">
                            <span >
                                <img :src="`../images/${filteredData[i].file}`" width="75px" class="img-thumbnail">
                            </span>
                        </template>

                        <template v-else>
                            {{entry[key]}}
                        </template>
                    </template>


                    <template v-else>
                        {{entry[key]}}
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script type="text/javascript">
    export default {
        props: {
            data: Array,
            columns: Array,
            filterKey: String,
            lista: String,
            isAutorized: Boolean
        },
        data: function () {
            var lista = lista
            var isAutorized = isAutorized
            var sortOrders = {}
            this.columns.forEach(function (key) {
                sortOrders[key] = 1
            })
            return {
                sortKey: '',
                sortOrders: sortOrders,
                id:0,
                name:0,
            }
        },
        computed: {
            filteredData: function () {
                var sortKey = this.sortKey
                var filterKey = this.filterKey && this.filterKey.toLowerCase()
                var order = this.sortOrders[sortKey] || 1
                var data = this.data
                if (filterKey) {
                    data = data.filter(function (row) {
                        return Object.keys(row).some(function (key) {
                            return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                        })
                    })
                }
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey]
                        b = b[sortKey]
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }
                return data
            }
        },
        filters: {
            capitalize: function (str) {
                
                if (str.substring(0,4)==="user") { str="autor"}
                if (str.substring(0,4)==="zona") { str="zona"}
                if (str.substring(0,4)==="grup") { str="grupo"}
                if (str.substring(0,4)==="upda") { str="fecha"}
                if (str.substring(0,4)==="gran") { str="costo"}

                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            sortBy: function (key) {
                this.sortKey = key
                this.sortOrders[key] = this.sortOrders[key] * -1
            },
            agrega(entry) {

                if(this.isAutorized){
                    console.log(entry)
                    this.$emit("agrega", entry);
                }
                else{
                    this.$router.push(`/${this.lista}/${entry['id']}`)
                }
                
            }
        }
    };
</script>
