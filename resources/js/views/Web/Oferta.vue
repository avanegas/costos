<template>
	<div class="row">
		<div class="col-md-12">
			<div class="row action-panel">
				<div class="col-md-12">
					<div class="btn-group pull-right">
						<a id="list" class="btn btn-default btn-sm" role="button">
							<i class="fas fa-th-list"></i> List
						</a>
						<a id="grid" class="btn btn-default btn-sm" role="button">
							<i class="fas fa-th"></i> Grid
						</a>
					</div>
				</div>
			</div>
			<div class="is-flex">
				<div class="col-md-4 item" v-for="oferta in ofertas" :key="oferta.id">
					<div class="thumbnail">
						<img :src="`images/${oferta.file}`" v-if="oferta.file" alt class="hvr-grow thumbnail-image">
						<div class="caption margin-left-sm">
							<h4 class="pull-right">$ {{ oferta.precio }}</h4>
							<h4 class="">
									<a href="#">{{ oferta.name }}</a>
							</h4>
							<p class="truncate">{{ oferta.descripcion }} ...</p>
						</div>
						<div class="ratings margin-left-sm">
							<span>{{ oferta.stock }}, {{ oferta.unidad }} left in stock</span>
							<p class="pull-right">
								<button class="btn btn-success">Add to car</button>
							</p>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				ofertas: []
			}
		},
		created() {
			get(`/api/oferta`)
			.then((res) => {
				this.ofertas = res.data.ofertas
			})
		}
	}
</script>
