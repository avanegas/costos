<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row">
                <div class="form-group col-10">
                    <h5>{{action}} Precio</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-primary btn-sm" @click="save" :disabled="isProcessing"> Save</button>
                    <button type="button" class="btn btn-secondary btn-sm" @click="$router.back()" :disabled="isProcessing"> Cancel</button>
                </div>
            </div> 

            <div class="card" >
                <div class="card-block">
                    <h5 class="text-center">ANALISIS  DE  PRECIO  UNITARIO</h5>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>GRUPO:</th>
                                <td colspan="4">
                                    <select name="" id="" class="form-control" v-model="form.grupo_precio_id">
                                        <option disabled value="">Seleccione</option>
                                        <option v-for="gp in grupo_precios" :value="gp.id" :selected="form.grupo_precio_id == gp.id ? true : false">{{ gp.name }}</option>
                                    </select>
                                </td>
                                <th>FECHA:</th>
                                <td >{{form.updated_at}}</td>
                            </tr>
                            <tr>
                                <th>RUBRO:</th>
                                <td colspan="4"><input type="text" class="form-control" v-model="form.name"><small class="error-control" v-if="error.name">{{error.name[0]}}</small></td>
                                <th>UNIDAD:</th>
                                <td ><input type="text" class="form-control" v-model="form.unidad"><small class="error-control" v-if="error.unidad">{{error.unidad[0]}}</small></td>
                            </tr>
                            <tr>
                                <th>ESPECIFICACION:</th>
                                <td colspan="6"><input type="text" class="form-control" v-model="form.detalle"><small class="error-control" v-if="error.detalle">{{error.detalle[0]}}</small></td>
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
                            <tr v-for="(equipo, index) in form.equipos">
                                <td @click="abrirModal(lista='equipos',indice=equipo.equipo_id)"><input type="text" class="form-control" v-model="equipo.equipo_id" :class="[error[`equipos.${index}.equipo_id`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="equipo.name" :class="[error[`equipos.${index}.name`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="equipo.cantidad" :class="[error[`equipos.${index}.cantidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="equipo.tarifa" :class="[error[`equipos.${index}.tarifa`] ? 'error-bg' : '']"></td>
                                <td>{{(equipo.cantidad*equipo.tarifa).toFixed(5)}}</td>
                                <td><input type="text" class="form-control" v-model="equipo.rendimiento" :class="[error[`equipos.${index}.rendimiento`] ? 'error-bg' : '']"></td>
                                <td>{{(equipo.cantidad * equipo.tarifa*equipo.rendimiento).toFixed(5)}}</td>
                            </tr>
                            <tr v-for="number in (5-form.equipos.length)" v-if="(5-form.equipos.length) > 0">
                                <td @click="abrirModal(lista='equipos',indice=0)"><input type="text" class="form-control" value="Ingrese Equipo"></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
                                <td><input type="text" class="form-control" ></td>
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

                            <tr v-for="(obrero, index) in form.obreros">
                                <td @click="abrirModal(lista='obreros')"><input type="text" class="form-control" v-model="obrero.obrero_id" :class="[error[`obreros.${index}.obrero_id`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="obrero.name" :class="[error[`obreros.${index}.name`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="obrero.cantidad" :class="[error[`obreros.${index}.cantidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="obrero.jornalhora" :class="[error[`obreros.${index}.jornalhora`] ? 'error-bg' : '']"></td>
                                <td>{{(obrero.cantidad*obrero.jornalhora).toFixed(5)}}</td>
                                <td><input type="text" class="form-control" v-model="obrero.rendimiento" :class="[error[`obreros.${index}.rendimiento`] ? 'error-bg' : '']"></td>
                                <td>{{(obrero.cantidad * obrero.jornalhora*obrero.rendimiento).toFixed(5)}}</td>
                            </tr>
                            <tr v-for="number in (7-form.obreros.length)" v-if="(7-form.obreros.length) > 0">
                                <td @click="abrirModal(lista='obreros')">Ingrese Obrero</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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

                            <tr v-for="(material, index) in form.materials">
                                <td @click="abrirModal(lista='materials')"><input type="text" class="form-control" v-model="material.material_id" :class="[error[`materials.${index}.material_id`] ? 'error-bg' : '']"></td>
                                <td colspan="2"><input type="text" class="form-control" v-model="material.name" :class="[error[`materials.${index}.name`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="material.unidad" :class="[error[`materials.${index}.unidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="material.cantidad" :class="[error[`materials.${index}.cantidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="material.precio" :class="[error[`materials.${index}.precio`] ? 'error-bg' : '']"></td>
                                <td>{{(material.cantidad * material.precio).toFixed(5)}}</td>
                            </tr>
                            <tr v-for="number in (7-form.materials.length)" v-if="(7-form.materials.length) > 0">
                                <td @click="abrirModal(lista='materials')">Ingrese Material</td>
                                <td colspan="2"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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

                            <tr v-for="(transporte, index) in form.transportes">
                                <td @click="abrirModal(lista='transportes')"><input type="text" class="form-control" v-model="transporte.transporte_id" :class="[error[`transportes.${index}.transporte_id`] ? 'error-bg' : '']"></td>
                                <td colspan="2"><input type="text" class="form-control" v-model="transporte.name" :class="[error[`transportes.${index}.name`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="transporte.unidad" :class="[error[`transportes.${index}.unidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="transporte.cantidad" :class="[error[`transportes.${index}.cantidad`] ? 'error-bg' : '']"></td>
                                <td><input type="text" class="form-control" v-model="transporte.tarifa" :class="[error[`transportes.${index}.tarifa`] ? 'error-bg' : '']"></td>
                                <td>{{(transporte.cantidad * transporte.tarifa).toFixed(5)}}</td>
                            </tr>
                            <tr v-for="number in (4-form.transportes.length)" v-if="(4-form.transportes.length) > 0">
                                <td @click="abrirModal(lista='transportes')">Ingrese Transporte</td>
                                <td colspan="2"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
                                <td v-model="otros">{{ otros }}%</td>
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

            <!-- Inicio de Modal -->
            <transition name="modal" v-if="showModal">
                <div class="modal__mask">
                    <div class="modal__wrapper">
                        <div class="modal__container"  @scroll="handleScroll">

                            <div class="modal__cerrar modal__header">
                                <a style="color: red" @click="cerrarModal">Cerrar  <strong>X</strong></a>
                            </div>

                            <div class="modal__header">
                                <slot  name="header">
                                    <button class="btn btn-warning btn-block"><strong>Borrar datos en esta linea. .  .?</strong></button>
                                </slot>
                            </div>

                            <div class="modal__body">
                                <slot name="body">
                                    <div class="row">
                                        <h5 class="col-6" style="text-transform: uppercase;">{{ this.lista }}</h5>
                                        <div class="col-6">
                                            <input
                                                type="search"
                                                class="form-control mr-sm-2 mb-2 mb-sm-0"
                                                name="query"
                                                placeholder="Search..."
                                                v-model="searchQuery">
                                        </div>
                                    </div>
                                    <lista-search
                                        :data="gridData"
                                        :columns="gridColumns"
                                        :filter-key="searchQuery"
                                        :lista="lista"
                                        :isAutorized="isAutorized"
                                        :entry="arrayItem"
                                        @agrega="agregaItem">
                                    </lista-search>
                                </slot>
                            </div>

                            <div class="modal__footer">
                                <slot name="footer">
                                    << 1.2.3.4..>>
                                </slot>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </transition>
            <!-- Fin de Modal -->
        </div>    
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import Flash from '../../helpers/flash'
    import { get, post } from '../../helpers/api'
    import { toMulipartedForm } from '../../helpers/form'
    import ListaSearch from '../../components/ListaSearch.vue'
    export default {
        components: {
            ListaSearch
        },
        data() {
            return {
                form: {
                    equipos: [],
                    obreros: [],
                    materials:[],
                    transportes:[]
                },
                error: {},
                grupo_precios:[],
                indirectos: 18,
                otros: 0,
                lista: null,
                showModal: false,
                isProcessing: false,
                initializeURL: `/api/precios/create`,
                storeURL: `/api/precios`,
                action: 'Create',
                arrayItem:{},
                scrollPosition: 0,
                searchQuery:'',
                gridData: [],
                gridColumns:[],
                isAutorized: true,
                indice:0,
            }
        },
        created() {
            if(this.$route.meta.mode === 'edit') {
                this.initializeURL = `/api/precios/${this.$route.params.id}/edit`
                this.storeURL = `/api/precios/${this.$route.params.id}?_method=PUT`
                this.action = 'Update'
            }
            get(this.initializeURL)
                .then((res) => {
                    let me = this;
                    //console.log(res);
                    Vue.set(me.$data, 'form', res.data.form);
                    Vue.set(me.$data, 'grupo_precios', res.data.grupo_precios);
                })
        },
        computed: {
            subTotalEquipos: function() {
                return this.form.equipos.reduce(function(carry, equipo) {
                    return carry + (parseFloat(equipo.cantidad) * parseFloat(equipo.tarifa)*parseFloat(equipo.rendimiento));
                }, 0);
            },
            subTotalObreros: function() {
                return this.form.obreros.reduce(function(carry, obrero) {
                    return carry + (parseFloat(obrero.cantidad) * parseFloat(obrero.jornalhora)*parseFloat(obrero.rendimiento));
                }, 0);
            },
            subTotalMaterials: function() {
                return this.form.materials.reduce(function(carry, material) {
                    return carry + (parseFloat(material.cantidad) * parseFloat(material.precio));
                }, 0);
            },
            subTotalTransportes: function() {
                return this.form.transportes.reduce(function(carry, transporte) {
                    return carry + (parseFloat(transporte.cantidad) * parseFloat(transporte.tarifa));
                }, 0);
            },
            directo: function(){
                return  this.form.directo = parseFloat(this.subTotalEquipos) + parseFloat(this.subTotalObreros) + parseFloat(this.subTotalMaterials) + parseFloat(this.subTotalTransportes);
            },
            indirecto: function(){
                return  this.form.indirecto = parseFloat(this.directo*this.indirectos/100);
            },
            otro: function(){
                return  parseFloat(this.directo*this.otros/100);
            },
            total: function(){
                return  parseFloat(this.directo) + parseFloat(this.indirecto) + parseFloat(this.otro);
            },
            ofertado: function(){
                return parseFloat(this.directo) + parseFloat(this.indirecto) + parseFloat(this.otro);
            }
        },
        methods: {
            save() {
                const form = toMulipartedForm(this.form, this.$route.meta.mode)
                post(this.storeURL, form)
                    .then((res) => {
                        if(res.data.saved) {
                            Flash.setSuccess(res.data.message)
                            this.$router.push(`/precios/${res.data.id}`)
                        }
                        this.isProcessing = false
                    })
                    .catch((err) => {
                        if(err.response.status === 422) {
                            this.error = err.response.data
                        }
                        this.isProcessing = false
                    })
            },
            abrirModal(lista){
                switch(lista) {
                    case "equipos":
                    {
                        this.gridColumns = ['grupo_equipo_id','name', 'tarifa']
                        get(`/api/${this.lista} `)
                        .then((res) => {
                            //console.log(res);
                            this.gridData = res.data.equipos
                        })        
                        break;
                    }

                    case "obreros":
                    {
                        this.gridColumns = ['grupo_obrero_id','name', 'jornalhora']
                        get(`/api/${this.lista} `)
                        .then((res) => {
                            //console.log(res);
                            this.gridData = res.data.obreros
                        })
                        break;
                    }

                    case "materials":
                    {
                        this.gridColumns = ['grupo_material_id','name', 'precio']
                        get(`/api/${this.lista} `)
                        .then((res) => {
                            //console.log(res);
                            this.gridData = res.data.materials
                        })
                        break;
                    }

                    case "transportes":
                    {
                        this.gridColumns = ['zona_id','name', 'tarifa']
                        get(`/api/${this.lista} `)
                        .then((res) => {
                            //console.log(res);
                            this.gridData = res.data.transportes
                        })
                        break;
                    }
                }
                this.showModal = true;
            },
            cerrarModal(){
                this.showModal = false;
                this.gridColumns=[];
                this.gridData=[];
            },
            handleScroll: function (e) {
                var currentScrollPosition = e.srcElement.scrollTop;
                if (currentScrollPosition > this.scrollPosition) {
                    console.log("Scrolling down");
                }
                this.scrollPosition = currentScrollPosition;
            },
            agregaItem(arrayItem){
                switch(this.lista) {

                    case "equipos":
                    {
                        console.log(arrayItem.id, this.indice, this.lista, this.form.equipos.length);                        
                        if( (5-this.form.equipos.length) > 0){
                            if(this.indice !== 0){
                                //this.equipo.precio_id = this.form.precio_id;
                                this.equipo.equipo_id = arrayItem.id;
                                this.equipo.name = arrayItem.name;
                                this.equipo.cantidad = 0;
                                this.equipo.tarifa = arrayItem.tarifa;
                                this.equipo.rendimiento = 0;
                                this.equipo.total = 0;

                            } else {
                                this.form.equipos.push({
                                precio_id:this.form.precio_id,
                                equipo_id:arrayItem.id,
                                name:arrayItem.name,
                                cantidad:0,
                                tarifa:arrayItem.tarifa,
                                rendimiento:0,
                                total:0
                                });                                
                            }
                        }
                        this.arrayItem={};
                        break;
                    }

                    case "obreros":
                    {
                        //console.log(arrayItem.name, this.form.id, this.lista);
                        this.form.obreros.push({
                            obrero_id:arrayItem.id,
                            precio_id:this.form.id,
                            name:arrayItem.name,
                            jornalhora:arrayItem.jornalhora,
                            cantidad:0,
                            rendimiento:0,
                            total:0
                        });
                        this.arrayItem={};
                        break;
                    }

                    case "materials":
                    {
                        console.log(arrayItem.name, this.form.id, this.lista);
                        this.form.materials.push({
                            material_id:arrayItem.id,
                            precio_id:this.form.id,
                            name:arrayItem.name,
                            unidad:arrayItem.unidad,
                            precio:arrayItem.precio,
                            cantidad:0,
                            total:0
                        });
                        this.arrayItem={};
                        break;
                    }

                    case "transportes":
                    {
                        console.log(arrayItem.name, this.form.id, this.lista);
                        this.form.transportes.push({
                            transporte_id:arrayItem.id,
                            precio_id:this.form.id,
                            name:arrayItem.name,
                            unidad:arrayItem.unidad,
                            tarifa:arrayItem.tarifa,
                            cantidad:0,
                            total:0
                        });
                        this.arrayItem={};
                        break;
                    }
                }
            }
        }
    }
</script>
