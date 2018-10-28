<template>
    <div class="row">
        <div class="col-md" >
            <div class="form-group row">
                <h3 class="col-7">Equipos</h3>
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
            <!-- Inicio del modal -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text='tituloModal'></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Grupo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idgrupo">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grupo in arrayGrupo" :key="grupo.id" :value="grupo.id" v-text="grupo.nombre"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Código</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" placeholder="Código de barras">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" placeholder="Nombre de artículo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio Venta</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Stock</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" placeholder="">
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" placeholder="Ingrese descripción">
                                    </div>
                                </div>
                                <div v-show="errorEquipo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEquipo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarEquipo()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarEquipo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal-->
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
                gridColumns:['grupo_equipo_id', 'name', 'marca', 'tipo', 'tarifa', 'updated_at'],
                lista:'equipos',
                isAutorized: false,
                arrayGrupo:[],
                modal:0,
                tituloModal:'',
                errorEquipo:0,
                errorMostrarMsjEquipo:'',
                idgrupo:0,
                tipoAccion:0
            }
        },
        created() {
            get(`/api/equipo`)
                .then((res) => {
                    this.gridData = res.data.equipos
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