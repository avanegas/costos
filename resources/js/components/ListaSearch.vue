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
                            {{ filteredData[i].grupo_equipo.name}}
                        </template>
                        <template v-else-if= "lista === 'grupo_equipos'">
                            {{ filteredData[i].zona.name }}
                        </template>
                        <template v-else-if= "lista === 'grupo_materials'">
                            {{ filteredData[i].zona.name }}
                        </template>
                        <template v-else-if= "lista === 'materials'">
                            {{ filteredData[i].grupo_material.name }}
                        </template>
                        <template v-else-if= "lista === 'grupo_obreros'">
                            {{ filteredData[i].zona.name }}
                        </template>
                        <template v-else-if= "lista === 'obreros'">
                            {{ filteredData[i].grupo_obrero.name }}
                        </template>

                        <template v-else-if= "lista === 'transportes'">
                            {{ filteredData[i].zona.name }}
                        </template>
                        <template v-else-if= "lista === 'grupo_precios'">
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
                        <template v-else-if= "lista === 'ofertas'">
                            {{ filteredData[i].name }}
                        </template>
                        <template v-else-if= "lista === 'categories'">
                            {{ filteredData[i].name }}
                        </template>
                        <template v-else-if= "lista === 'tags'">
                            {{ filteredData[i].name }}
                        </template>
                        <template v-else-if= "lista === 'zonas'">
                            {{ filteredData[i].name }}
                        </template>
                        <template v-else>
                            {{ filteredData[i].id }}
                        </template>
                    </template>

                    <template v-else-if = "index === 1">
                        <template v-if= "lista === 'users'">
                            {{ filteredData[i].name }}
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
                        <template v-else-if= "lista === 'ofertas'">
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
    import Auth from '../store/auth'
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
                authState: Auth.state,
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

                if ( this.authState.api_token && this.authState.user_id === 1 ) {

                    switch (this.lista) {
                        case "posts":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "ofertas":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "tags":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "categories":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "grupo_equipos":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "equipos":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "grupo_materials":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "materials":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "grupo_obreros":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "obreros":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "transportes":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "grupo_precios":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "users":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "roles":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "permissions":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        case "zonas":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}/edit`);
                            break;
                        }
                        default:
                        {
                            if(this.isAutorized){
                                console.log('agrega',entry);
                                this.$emit("agrega", entry);
                            }
                            else{
                                console.log('else-default',entry)
                                this.$router.push(`/${this.lista}/${entry['id']}`);
                            }
                        }
                    }
                }
                else {
                    switch (this.lista) {
                        case "precios":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}`);
                            break;
                        }
                        case "proyectos":
                        {
                            this.$router.push(`/${this.lista}/${entry['id']}`);
                            break;
                        }
                    }
                }



            }
        }
    };
</script>
