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
            <tr @click="putData(entry)" v-for="(entry, i) in filteredData">
                <td v-for="(key, index) in columns">
                    <template v-if = "index === 0">
                        <template v-if= "lista === 'equipos'">
                            {{ filteredData[i].grupo_equipo_id }}  {{ filteredData[i].grupo_equipo.name }}
                        </template>
                        <template v-if= "lista === 'materials'">
                            {{ filteredData[i].grupo_material_id }}  {{ filteredData[i].grupo_material.name }}
                        </template>
                        <template v-if= "lista === 'obreros'">
                            {{ filteredData[i].grupo_obrero_id }}  {{ filteredData[i].grupo_obrero.name }}
                        </template>
                        <template v-if= "lista === 'transportes'">
                            {{ filteredData[i].zona_id }}  {{ filteredData[i].zona.name }}
                        </template>

                        <template v-if= "lista === 'precios'">
                            {{ filteredData[i].grupo_precio_id }}  {{ filteredData[i].grupo_precio.name }}
                        </template>
                        <template v-if= "lista === 'proyectos'">
                            {{ filteredData[i].user_id }}  {{ filteredData[i].user.name }}
                        </template>

                        <template v-if= "lista === 'users'">
                            {{ filteredData[i].id }}
                        </template>
                        <template v-if= "lista === 'roles'">
                            {{ filteredData[i].id }}
                        </template>
                        <template v-if= "lista === 'permissions'">
                            {{ filteredData[i].id }}
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
                sortOrders: sortOrders
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
                if (str.substring(0,4)==="crea") { str="fecha"}
                if (str.substring(0,4)==="gran") { str="costo"}

                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            sortBy: function (key) {
                this.sortKey = key
                this.sortOrders[key] = this.sortOrders[key] * -1
            },
            putData: function(entry) {
                console.log(entry.id, this.lista, entry.name);
            }
        }
    };
</script>

<style lang="scss">

// COPIADO DE :::>>>>>>  https://jsfiddle.net/xkkbfL3L/8519/
//                       https://vuejs.org/v2/examples/grid-component.html

body {
/*  font-family: Helvetica Neue, Arial, sans-serif;
  font-size: 14px;
  color: #444;*/
}

table {
/*  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;*/
}

th {
    background-color: #42b983;
    /* color: rgba(255,255,255,0.66);*/
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

td {
  /*background-color: #f9f9f9;*/
}

th, td {
    min-width: 120px;
    /*padding: 5px 10px;    */
}

th.active {
    color: #fff;
}

th.active .arrow {
    opacity: 1;
}

.arrow {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 0;
    margin-left: 4px;
    padding-right: 0px;
    opacity: 0.66;
}

.arrow.asc {
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-bottom: 8px solid #fff;
}

.arrow.dsc {
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 8px solid #fff;
}
</style>