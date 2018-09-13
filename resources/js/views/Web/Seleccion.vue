<template>
	<div class="container">
		<div class="row">
			<div class="col-md">
				<div class="card">
					<div class="card-header">
		            	<router-link to="/posts/create"  title="Articulo nuevo" class="w-50 text-muted">
		                	Apuntes, detalles y teoría de la construcción.
		            	</router-link>
		            	<input type="search" name="search" placeholder="Search" class="w-50 float-right">
					</div>
				</div>
				<div class="card" v-for="post in posts">
					<div class="card-header">
						<p>Tema creado por, {{post.user.name}}, el día<em> {{post.created_at}}.</em></p>
					</div>	
					<div class="card-body">
						<img :src="`../images/${post.file}`" v-if="post.file" class="card-img-top">
						<p class="card-title">CATEGORIA: {{post.category.name}}</p>
						<p class="text-uppercase text-center">{{post.name}}</p>
						<p class="card-text text-justify">{{post.excerpt}}
							<router-link :to="`/post/${post.slug}`" class="alert-link">Leer mas</router-link>
						</p>
					</div>
					<div class="card-footer">
						<p class="float-right">comentarios:  {{post.comments.length}}</p>
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
				posts: []
			}
		},
		created() {
			get(`/api/category/${this.$route.params.slug}`)
			.then((res) => {
				this.posts = res.data.posts
			})
		}
	}
</script>