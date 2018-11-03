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
				<div class="col-md-4 item" v-for="post in posts">
					<div class="thumbnail">
						<img :src="`images/${post.file}`" v-if="post.file" alt class="grow thumbnail-image">
						<div class="caption margin-left-sm">
							<h4 class="pull-right">$ 1240,00</h4>
							<h4 class="">
									<a href="#">{{ post.name }}</a>
							</h4>
							<p class="truncate">La nueva tecnologia a su alcanze con 3.0GHz Dual-core Haswell Intel Core i5 Turbo Boost up to 3.2 GHz, 3MB L3 cache 8GB (two 4GB SO-DIMMs ...</p>
						</div>
						<div class="ratings margin-left-sm">
							<span>10 left in stock</span>
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
				posts: []
			}
		},
		created() {
			get(`/api/posts`)
			.then((res) => {
				this.posts = res.data.posts
			})
		}
	}
</script>
