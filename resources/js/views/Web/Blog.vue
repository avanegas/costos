<template>
	<div class="row">
		<div class="col-md">

            <div class="form-group row">
                <h5 class="col-7"> Apuntes, detalles y teoría de la construcción.</h5>
                <div class="form-group col-4">
                    <input
                        type="text"
                        class="form-control mr-sm-2 mb-2 mb-sm-0"
                        placeholder="Search..."
                        autocomplete="off"
                        v-model="searchQuery">
                </div>
            </div>

			<div class="card mb-3 mt-3" v-for="post in posts" :key="post.id">
				<div class="card-header">
					<p>Tema creado por, {{post.user.name}}, el día<em> {{post.created_at}}.</em></p>
				</div>	
				<div class="card-body">
					<img :src="`images/${post.file}`" v-if="post.file" class="card-img-top">
					<p class="card-title">CATEGORIA: {{post.category.name}}</p>
					<p class="text-uppercase text-center">{{post.name}}</p>
					<p class="card-text text-justify">{{post.excerpt}}
						<router-link :to="`/post/${post.slug}`" class="alert-link">Leer mas</router-link>
					</p>
				</div>
				<div class="card-footer">
					<p class="float-right">comentarios: {{post.comments.length}}</p>
				</div>
			</div>
			<infinite-loading @infinite="infiniteHandler"></infinite-loading>
		</div>
	</div>
</template>
<script type="text/javascript">
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
                searchQuery:'',
				posts: [],
				page:0
			}
		},
		created() {
			get(`/api/blog`)
			.then((res) => {
				this.posts = res.data.posts
			})
		},
		methods:{
			infiniteHandler($state) {

			}
		}
	}
</script>