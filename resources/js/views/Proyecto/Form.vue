<template>
	<div class="row">	
		<div class="col-md">
			<div class="form-group row">
				<div class="form-group col-9">
					<h5>{{action}} Proyecto</h5>
				</div>
				<div class="form-group col-3">
					<button type="button" class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
					<button type="button" class="btn btn-secondary" @click="$router.back()" :disabled="isProcessing">Cancel</button>
				</div>

			</div>
			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<div class="form-group col-8">
						    <label>PROYECTO</label>
						    <input type="text" class="form-control" v-model="form.name">
						    <small class="error-control" v-if="error.name">{{error.name[0]}}</small>
						</div>
						<div class="form-group col-3">
						    <label>UBICACION</label>
						    <input type="text" class="form-control" v-model="form.ubicacion">
						    <small class="error-control" v-if="error.ubicacion">{{error.ubicacion[0]}}</small>
						</div>
						<div class="form-group col-1">
						    <label>DISTANCIA</label>
						    <input type="text" class="form-control" v-model="form.distancia">
						    <small class="error-control" v-if="error.distancia">{{error.distancia[0]}}</small>
						</div>
					</div>
					<div class="form-group row">
						<div class="form-group col-8">
						    <label>CONTRATANTE</label>
						    <input type="text" class="form-control" v-model="form.contratante">
						    <small class="error-control" v-if="error.contratante">{{error.contratante[0]}}</small>
						</div>
						<div class="form-group col-2">
						    <label>FECHA</label>
						    <input type="date" class="form-control" v-model="form.entrega">
						    <small class="error-control" v-if="error.entrega">{{error.entrega[0]}}</small>
						</div>
						<div class="form-group col-1">
						    <label>FORMA</label>
						    <input type="text" class="form-control" v-model="form.formato">
						    <small class="error-control" v-if="error.formato">{{error.formato[0]}}</small>
						</div>
						<div class="form-group col-1">
						    <label>DECIMAL</label>
						    <input type="text" class="form-control" v-model="form.precision">
						    <small class="error-control" v-if="error.precision">{{error.precision[0]}}</small>
						</div>
					</div>
					<div class="form-group row">
						<div class="form-group col-4">
						    <label>OFERENTE</label>
						    <input type="text" class="form-control" v-model="form.oferente">
						    <small class="error-control" v-if="error.oferente">{{error.oferente[0]}}</small>
						</div>
						<div class="form-group col-4">
						    <label>REPRESENTANTE</label>
						    <input type="text" class="form-control" v-model="form.representante">
						    <small class="error-control" v-if="error.representante">{{error.representante[0]}}</small>
						</div>
						<div class="form-group col-2">
						    <label>REFERENCIAL</label>
						    <input type="text" class="form-control" v-model="form.referencial">
						    <small class="error-control" v-if="error.referencial">{{error.referencial[0]}}</small>
						</div>
	                    <div class="form-group col-1">
	                        <label>INDIRECTO</label>
	                        <input type="text" class="form-control" v-model="form.indirecto">
	                        <small class="error-control" v-if="error.indirecto">{{error.indirecto[0]}}</small>
	                    </div>
	                    <div class="form-group col-1">
	                        <label>IVA</label>
	                        <input type="text" class="form-control" v-model="form.descuento">
	                        <small class="error-control" v-if="error.descuento">{{error.descuento[0]}}</small>
	                    </div>
					</div>
					<h5 class="text-center">TABLA DE DESCRIPCION DE RUBROS, UNIDADES, CANTIDADES Y PRECIOS</h5>
					<table class="table table-bordered table-striped table-sm">
						<thead>
							<tr>
								<th>Select</th>
								<th>Id</th>
								<th>Rubro Nº</th>
								<th>Descripcion</th>
								<th>Unidad</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Total</th>
								<th width="40px">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item, index) in form.rubros">

								<td>
									<typeahead :url="precioURL" :initialize="item.precio_id" @input="onPrecio(index, $event)" />

                                    <small class="error-control" v-if="error[`rubros.${index}.precio_id`]">
                                        {{error[`rubros.${index}.precio_id`]}}
                                    </small>
								</td>
								<td>
									<input
										type="text"
										class="form-control"
										v-model="item.precio_id"
										:class="[error[`rubros.${index}.precio_id`] ? 'error__bg' : '']">
								</td>
								<td><input type="text" class="form-control" v-model="item.orden" :class="[error[`rubros.${index}.orden`] ? 'error__bg' : '']"></td>
								<td><input type="text" class="form-control" v-model="item.rubro" :class="[error[`rubros.${index}.rubro`] ? 'error__bg' : '']"></td>
								<td><input type="text" class="form-control" v-model="item.unidad" :class="[error[`rubros.${index}.unidad`] ? 'error__bg' : '']"></td>
								<td><input type="text" class="form-control right" v-model="item.cantidad" :class="[error[`rubros.${index}.cantidad`] ? 'error__bg' : '']"></td>
								<td><input type="text" class="form-control right" v-model="item.precio" :class="[error[`rubros.${index}.precio`] ? 'error__bg' : '']"></td>
								<td>{{item.cantidad * item.precio}}</td>
								<td>
									<button @click="remove('rubros', index)" class="btn btn-danger">&times;</button>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="6"><button class="btn btn-success" @click="addRubro">Add Rubro</button></td>
								<td>SubTotal</td>
								<td>{{ sub_total }}</td>
							</tr>
							<tr>
								<td colspan="6"></td>
								<td>IVA %</td>
								<td>
									<input type="text" class="form-control right" v-model="form.descuento">
									<small class="error-control" v-if="error.descuento">{{error.descuento[0]}}</small>
								</td>
							</tr>
							<tr>
								<td colspan="6"></td>
								<td>Total</td>
								<td>{{ gran_total }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post, byMethod } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
    import {Typeahead } from '../../components/typeahead'

    function initialize(to) {
        let urls = {
            'create': `/api/proyectos/create`,
            'edit': `/api/proyectos/${to.params.id}/edit`
        }

        return (urls[to.meta.mode] || urls['create'])
    }
	export default {
		components: {
			Typeahead
		},
		data() {
			return {
				form: {
					rubros: []
				},
				error: {},
				isProcessing: false,

                resource:'/proyectos',
                method:'POST',
                title:'Create',

				initializeURL: `/api/proyectos/create`,
				storeURL: `/api/proyectos`,
				action: 'Create',
				precioURL: '/api/listaprecios'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/proyectos/${this.$route.params.id}/edit`
				this.storeURL = `/api/proyectos/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
				})
		},
		computed: {
		    sub_total: function() {
		      return this.form.rubros.reduce(function(carry, rubro) {
		        return carry + (parseFloat(rubro.cantidad) * parseFloat(rubro.precio));
		      }, 0);
		    },
		    gran_total: function() {
		      return this.sub_total - parseFloat(this.form.descuento);
		    }
		  },
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/proyectos/${res.data.id}`)
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
			onPrecio(index, e) {
                const precio = e.target.value

                Vue.set(this.form.rubros[index], 'precio_id', precio)
                Vue.set(this.form.rubros[index], 'precio_id', precio.id)

                Vue.set(this.form.rubros[index], 'rubro', precio.name)
                Vue.set(this.form.rubros[index], 'unidad', precio.unidad)
                Vue.set(this.form.rubros[index], 'precio', precio.directo)

			},
			addRubro() {
				this.form.rubros.push({
					precio_id: '',
					orden: '',
					rubro: '',
					unidad: '',
					cantidad: '',
					precio: '',
					total: ''
				})
			},
			remove(type, index) {
				if(this.form[type].length > 1) {
					this.form[type].splice(index, 1)
				}
			}
		}
	}
</script>