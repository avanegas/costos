<template>
	<div class="container">
	    <div class="row">
	        <div class="col-md">
	            
	            <div class="card">
					<div class="card-header">
			            <router-link :to="`/category/${post.category.slug}`"  title="Selección por categoría" class="card-title">
			               	CATEGORIA: {{ post.category.name }}
			           	</router-link>
			        </div>

			        <div class="card-body">  		
			           	<img :src="`/images/${post.file}`" v-if="post.file" class="card-img-top">
			           	<p class="card-title text-uppercase text-center">{{post.name}}</p>
			           	<p class="card-text text-justify">{{ post.body }}</p>

						<p class="card-title">ETIQUETAS: 
						<span v-for="tag in post.tags">
							<router-link :to="`/tag/${tag.slug}`" title="Selección por etiqueta"  class="alert-link">
								{{ tag.name }}, 
							</router-link>
						</span>
			            </p>
			        </div>

					<!-- Blog Coments -->
			        <div class="card-footer">
			        	
			        	<div>
			        		<button class="btn btn-outline-secondary float-right">Quiero comentar</button>
			        		<h5>Comentarios: <strong> {{post.comments.length}}</strong></h5>
			        		
			        	</div>
						<div class="input-group mt-4" v-if="comentar">
							
								<textarea class="form-control" rows="3" aria-label="With textarea" placeholder="Escriba su comentario"  v-model="comment.body"></textarea>
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button">Publicar</button>
								</div>
							
						</div>
						<!--
			         	<ul class="card-body" v-for="comment in post.comments">
			         		<li class="list-group-item">
					         	<a class="pull-left" href="#">
									<img src="/img/persona1.jpg" width="64" height="64" alt="" class="d-flex align-self-start mr-3">
								</a>
		        				<p class="card-title">{{comment.user.name}} escribio el {{comment.created_at}}</p>
		        				<p class="card-text">{{comment.body}}</p>

								<div class="botones text-right">
	                                <a href="#">Responder</a>
	                                <a href="#">Editar</a>
	                                <a href="#">Borrar</a>
	                            </div>

		        			</li>
		        		</ul>
					</div>
					-->

					<!-- Comments form 
					<div class="well">-->
						<!-- <h4>Comentar</h4>
						<h5 class="card-title">Comentarios: <strong> {{post.comments.length}}</strong></h5>
						<form role="form" @submit.prevent="addComment">
							<div class="form-group">
								<textarea class="form-control" rows="3" v-model="comment.body"></textarea>
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div> -->
					<hr>

					<!-- Post Comments -->
					<!-- Comments -->
					<div class="media" v-for="comment in post.comments">
						<a class="pull-left" href="#">
							<img src="/img/persona1.jpg" width="64" height="64" alt="" class="d-flex align-self-start mr-3">
						</a>
						<div class="media-body">
							<h5 class="media-heading">{{comment.user.name}}
								<small>escribio el {{comment.created_at}}</small>
							</h5>

							{{comment.body}}

							<div class="botones text-right">
                                <a href="#">Responder</a>
                                <a href="#">Editar</a>
                                <a href="#">Borrar</a>
                            </div>
						</div>
					</div>
</div>

				</div>

	        </div>
	    </div>
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get, post, del } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'

	export default {
		data() {
			return {
				authState: Auth.state,
				comentar: true,
				comments: [],
				comment:{
					body:''
				},
				post: {
					comments: {},
					user: {},
					category: {},
					tags:{}	
				}
			}
		},
		created() {
			get(`/api/post/${this.$route.params.slug}`)
			.then((res) => {
				this.post = res.data.post
			})
		},
		methods: {
		addComment() {
			this.$http.post('api/comments',this.comment).then((response) => {
				this.comments.push(this.comment)
				this.comments.body = ''
			}, (response) => {
				//error callback
			});
		}			
		}

	}
</script>