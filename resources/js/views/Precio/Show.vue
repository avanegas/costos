<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row mb-3 mt-3">
                <div class="form-group col-10">
                    <p><strong>AUTOR: </strong>{{precio.user.name}}</p>
                </div>
                <div v-if="authState.api_token && authState.user_id === precio.user_id">
                    <router-link to="/precios" class="btn btn-secondary btn-sm"> Back</router-link>
                    <router-link :to="`/precios/${precio.id}/edit`" class="btn btn-primary btn-sm"> Edit</router-link>
                    <button type="button" class="btn btn-danger btn-sm" @click="remove" :disabled="isRemoving"> Delete</button>
                </div>
            </div>

            <div class="card">
                <div class="card-block">
                    <h5 class="text-center">ANALISIS  DE  PRECIO  UNITARIO</h5>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>GRUPO:</th>
                                <td colspan="4">{{precio.grupo_precio.name}}</td>
                                <th>FECHA:</th>
                                <td >{{precio.updated_at}}</td>
                            </tr>
                            <tr>
                                <th>RUBRO:</th>
                                <td colspan="4">{{precio.name}}</td>
                                <th>UNIDAD:</th>
                                <td >{{precio.unidad}}</td>
                            </tr>
                            <tr>
                                <th>ESPECIFICACION:</th>
                                <td colspan="6">{{precio.detalle}}</td>
                            </tr>
                            <tr>
                                <td colspan="7">EQUIPOS</td>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Tarifa</th>
                                <th>Costo Hora</th>
                                <th>Rendimiento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="equipo in precio.equipos">
                                <td>{{equipo.equipo_id}}</td>
                                <td>{{equipo.name}}</td>
                                <td>{{equipo.cantidad}}</td>
                                <td>{{equipo.tarifa}}</td>
                                <td>{{(equipo.cantidad*equipo.tarifa).toFixed(5) }}</td>
                                <td>{{equipo.rendimiento}}</td>
                                <td>{{ (equipo.cantidad * equipo.tarifa*equipo.rendimiento).toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">MANO DE OBRA</td>
                                <td> Subtotal</td>
                                <td>{{ subTotalEquipos.toFixed(5) }}</td>
                            </tr>
                            <!-- FIN EQUIPO -->
                            <tr>
                                <th>&nbsp;</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Jornal Hora</th>
                                <th>Costo Hora</th>
                                <th>Rendimiento</th>
                                <th>Total</th>
                            </tr>

                            <tr v-for="obrero in precio.obreros">
                                <td>{{obrero.obrero_id}}</td>
                                <td>{{obrero.name}}</td>
                                <td>{{obrero.cantidad}}</td>
                                <td>{{obrero.jornalhora}}</td>
                                <td>{{ (obrero.cantidad*obrero.jornalhora).toFixed(5) }}</td>
                                <td>{{obrero.rendimiento}}</td>
                                <td>{{ (obrero.cantidad * obrero.jornalhora*obrero.rendimiento).toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">MATERIALES</td>
                                <td> Subtotal</td>
                                <td>{{ subTotalObreros.toFixed(5) }}</td>
                            </tr>
                            <!-- FIN OBRERO -->
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="2">Descripcion</th>
                                <th>unidad</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </tr>

                            <tr v-for="material in precio.materials">
                                <td>{{material.material_id}}</td>
                                <td colspan="2">{{material.name}}</td>
                                <td>{{material.unidad}}</td>
                                <td>{{material.cantidad}}</td>
                                <td>{{material.precio}}</td>
                                <td>{{ (material.cantidad * material.precio).toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">TRANSPORTES</td>
                                <td> Subtotal</td>
                                <td>{{ subTotalMaterials.toFixed(5) }}</td>
                            </tr>
                            <!-- FIN MATERIAL -->
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="2">Descripcion</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Tarifa</th>
                                <th>Total</th>
                            </tr>

                            <tr v-for="transporte in precio.transportes">
                                <td>{{transporte.transporte_id}}</td>
                                <td colspan="2">{{transporte.name}}</td>
                                <td>{{transporte.unidad}}</td>
                                <td>{{transporte.cantidad}}</td>
                                <td>{{transporte.tarifa}}</td>
                                <td>{{ (transporte.cantidad * transporte.tarifa).toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                                <td> Subtotal</td>
                                <td>{{ subTotalTransportes.toFixed(5) }}</td>
                            </tr>
                            <!-- FIN TRANSPORTE -->
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">TOTAL DE COSTO DIRECTO</td>
                                <td>{{ directo.toFixed(5) }}</td>
                            </tr>

                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="2">INDIRECTOS Y UTILIDADES %</td>
                                <td>{{ indirectos }}%</td>
                                <td>{{ indirecto.toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="2">OTROS INDIRECTOS %</td>
                                <td>{{otros}}%</td>
                                <td>{{ otro.toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">COSTO TOTAL DEL RUBRO</td>
                                <td>{{ total.toFixed(5) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                                <td colspan="3">VALOR OFERTADO</td>
                                <td>{{ ofertado.toFixed(5) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Auth from '../../store/auth'
    import Flash from '../../helpers/flash'
    import { get, del } from '../../helpers/api'
    export default {
        data() {
            return {
                authState: Auth.state,
                isRemoving: false,
                indirectos: 18,
                otros: 0,
                precio: {
                    user: {},
                    grupo_precio: {},
                    equipos: [],
                    obreros: [],
                    materials:[],
                    transportes:[]
                }
            }
        },
        created() {
            get(`/api/precios/${this.$route.params.id}`)
                .then((res) => {
                    this.precio = res.data.precio
                })
        },
        methods: {
            remove() {
                this.isRemoving = false
                del(`/api/precios/${this.$route.params.id}`)
                    .then((res) => {
                        if(res.data.deleted) {
                            Flash.setSuccess('You have successfully deleted precio!')
                            this.$router.push('/')
                        }
                    })
            }
        },
        computed: {
            subTotalEquipos: function() {
                return this.precio.equipos.reduce(function(carry, equipo) {
                    return carry + (parseFloat(equipo.cantidad) * parseFloat(equipo.tarifa)*parseFloat(equipo.rendimiento));
                }, 0);
            },
            subTotalObreros: function() {
                return this.precio.obreros.reduce(function(carry, obrero) {
                    return carry + (parseFloat(obrero.cantidad) * parseFloat(obrero.jornalhora)*parseFloat(obrero.rendimiento));
                }, 0);
            },
            subTotalMaterials: function() {
                return this.precio.materials.reduce(function(carry, material) {
                    return carry + (parseFloat(material.cantidad) * parseFloat(material.precio));
                }, 0);
            },
            subTotalTransportes: function() {
                return this.precio.transportes.reduce(function(carry, transporte) {
                    return carry + (parseFloat(transporte.cantidad) * parseFloat(transporte.tarifa));
                }, 0);
            },
            directo: function(){
                return  this.precio.directo = this.subTotalEquipos + this.subTotalObreros + this.subTotalMaterials + this.subTotalTransportes;
            },
            indirecto: function(){
                return  this.precio.indirecto = this.directo*this.indirectos/100;
            },
            otro: function(){
                return  this.directo*this.otros/100;
            },
            total: function(){
                return  this.directo + this.indirecto + this.otro;
            },
            ofertado: function(){
                return  this.directo + this.indirecto + this.otro;
            }
        }
    }
</script>
