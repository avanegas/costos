<template>
	<div class="row" v-if="show">
		<div class="col-md">
			<div class="form-group row">
				<div class="col-9">
					<p><strong>AUTOR: </strong>{{proyecto.user.name}}</p>
				</div>
				<div v-if="authState.api_token && authState.user_id === proyecto.user_id" class="col-3">
					<router-link to="/proyectos" class="btn btn-secondary">Back</router-link>
					<router-link :to="`/proyectos/${proyecto.id}/edit`" class="btn btn-primary">Edit</router-link>
					<button type="button" class="btn btn-danger" @click="deleteItem">Delete</button>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<div class="form-group row">
						<div class="col-8">
							<label>PROYECTO</label>
							<h6>{{proyecto.name}}</h6>
						</div>
						<div class="col-3">
							<label>UBICACION</label>
							<p>{{proyecto.ubicacion}}</p>
						</div>
						<div class="col-1">
							<label>DISTANCIA</label>
							<p>{{proyecto.distancia}}</p>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-8">
							<label>CONTRATANTE</label>
							<p>{{proyecto.contratante}}</p>
						</div>
						<div class="col-2">
							<label>PRESENTACION</label>
							<p>{{proyecto.entrega}}</p>
						</div>
						<div class="col-1">
							<label>FORMATO</label>
							<p>{{proyecto.formato}}</p>
						</div>
						<div class="col-1">
							<label>DECIMAL</label>
							<p>{{proyecto.precision}}</p>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-4">
							<label>OFERENTE</label>
							<p>{{proyecto.oferente}}</p>
						</div>
						<div class="col-4">
							<label>REPRESENTANTE</label>
							<p>{{proyecto.representante}}</p>
						</div>
	                    <div class="col-2">
	                        <label>REFERENCIAL</label>
	                        <p>{{proyecto.referencial}}</p>
	                    </div>
						<div class="col-1">
							<label>INDIRECTO</label>
							<p>{{proyecto.indirecto}}</p>
						</div>
						<div class="col-1">
							<label>IVA</label>
							<p>{{proyecto.descuento}}</p>
						</div>
					</div>
					
					<h5 class="text-center">TABLA DE DESCRIPCION DE RUBROS, UNIDADES, CANTIDADES Y PRECIOS</h5>
					<table class="table table-bordered table-striped table-sm">
						<thead>
							<tr>
								<th>Id</th>
								<th>Rubro Nº</th>
								<th>Descripcion</th>
								<th>Unidad</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="rubro in proyecto.rubros" :key="rubro.id">
								<td>{{rubro.precio_id}}</td>
								<td>{{rubro.orden}}</td>
								<td>{{rubro.rubro}}</td>
								<td>{{rubro.unidad}}</td>
								<td>{{rubro.cantidad}}</td>
								<td>{{rubro.precio}}</td>
								<td>{{rubro.cantidad * rubro.precio}}</td>
							</tr>
						</tbody>

						<tfoot>
							<tr>
								<td colspan="5"></td>
								<td> Subtotal</td>
								<td>{{ proyecto.sub_total }}</td>
							</tr>
							<tr>
								<td colspan="5"></td>
								<td>IVA %</td>
								<td>{{ proyecto.descuento }}</td>
							</tr>
							<tr>
								<td colspan="5"></td>
								<td>Total</td>
								<td>{{ proyecto.gran_total }}</td>
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
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get, byMethod } from '../../helpers/api'

	export default {
		data() {
			return {
			    show: false,
				authState: Auth.state,
				proyecto: {
					rubros: [],
                    user: {}
				}
			}
		},
        beforeRouteEnter(to, from, next) {
            get(`/api/proyectos/${to.params.id}`)
                .then((res) => {
                	console.log(res);
                    next(vm => vm.setData(res))
                })
        },
        beforeRouteUpdate(to, from, next) {
            this.show = false
            get(`/api/proyectos/${to.params.id}`)
                .then((res) => {
                	console.log(res);
                    this.setData(res)
                    next()
                })
        },
        methods: {
            setData(res) {
                Vue.set(this.$data, 'proyecto', res.data.proyecto)
                this.show = true
                this.$bar.finish()
            },
            deleteItem() {
                byMethod('delete', `/api/proyectos/${this.proyecto.id}`)
                    .then((res) => {
                        if(res.data.deleted) {
                            this.$router.push('/proyectos')
                        }
                    })
            }
        }
	}
</script>