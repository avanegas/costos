<template>
    <div class="row">
        <div class="col-md">
            <div class="card mb-3 mt-3">
				<div class="card-header">
		            <router-link :to="`/category/${post.category.slug}`" title="Selección por categoría" class="card-title">
		               	CATEGORIA: {{ post.category.name }}
		           	</router-link>
		        </div>
		        <div class="card-body">
		           	<img :src="`/images/${post.file}`" v-if="post.file" class="card-img-top">
		           	<p class="card-title text-uppercase text-center">{{post.name}}</p>
		           	<p class="card-text text-justify">{{ post.body }}</p>

					<p class="card-title">ETIQUETAS:
					<span v-for="tag in post.tags" :key="tag.id">
						<router-link :to="`/tag/${tag.slug}`" title="Selección por etiqueta"  class="alert-link">
							{{ tag.name }},
						</router-link>
					</span>
		            </p>
		        </div>

				<div class="card-body">
					<comment-add
						:numero  = "post.comments.length"
						:post_id = "post.id"
						:user_id = "authState.user_id"
						@new="addComment">
					</comment-add>
					<comment
						v-for="comment in post.comments"
						:key="comment.id"
						:comment="comment">
					</comment>
				</div>
			</div>
        </div>
    </div>
</template>
<script>
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get, post, del } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import CommentAdd  from '../Comment/CommentAdd.vue'
	import Comment from '../Comment/Comment.vue'
	export default {
		components: {
			Auth,
            CommentAdd,
            Comment
        },
		data() {
			return {
				authState: Auth.state,
				form: {},
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
	    methods:{
            addComment(form) {
                this.post.comments.push(this.form)
			}
        }
	}
</script>
