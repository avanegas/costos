<template>
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-title">
                    <router-link to="/equipos/create" title="Equipo nuevo" class="w-50 text-muted">
                        Equipos
                    </router-link>
                    <input
                        type="search"
                        name="search"
                        placeholder="Search..."
                        class="w-50 float-right">
                </div>
                <div class="card">
                    <div class="card-block">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Grupo</th>
                                <th>Descripción</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Tarifa</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="equipo in searchEquipos" :key="equipo.id" @click="detailsPage(equipo)">
                                <td class="w-1">{{equipo.grupo_equipo.name}}</td>
                                <td class="w-6">{{equipo.name}}</td>
                                <td class="w-6">{{equipo.marca}}</td>
                                <td class="w-3">{{equipo.tipo}}</td>
                                <td class="w-3">{{equipo.tarifa | formatMoney}}</td>
                                <td class="w-3">{{equipo.created_at}}</td>
                                <td class="w-3">Proveedor</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import { get } from '../../../helpers/api'
    export default {
        data() {
            return {
                equipos: [],
                search:''
            }
        },
        created() {
            get(`/api/equipos`)
                .then((res) => {
                    this.equipos = res.data.equipos
                })
        },
        methods: {
            detailsPage(equipo) {
                this.$router.push(`/equipos/${equipo.id}/edit`)
            }
        },
        computed: {
            searchEquipos() {
                return this.equipos.filter( (equipo) => {
                    return `${equipo.grupo_equipo.name} ${equipo.name} ${equipo.marca} ${equipo.tipo}`
                    .toLowerCase().includes(this.search.toLowerCase());
                });
            }
        }
    }
</script>