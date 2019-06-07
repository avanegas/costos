<template>
	<div class="image-preview" v-if="file">
		<img :src="file">
		<button class="btn btn-danger image-close" @click="close">
			&times;
		</button>
	</div>
</template>
<script type="text/javascript">
	export default {
		props: {
			preview: {
			    type: [String, File],
			    default: null
			}
		},
		data() {
			return {
				file: null
			}
		},
		created() {
			this.setPreview()
		},
		watch: {
			'preview': 'setPreview'
		},
		methods: {
			setPreview() {
				if(this.preview instanceof File ) {
					const fileReader = new FileReader()
					fileReader.onload = (event) => {
					  this.file = event.target.result
					}
					fileReader.readAsDataURL(this.preview)
				} else if (typeof this.preview === 'string') {
					this.file = `/images/${this.preview}`
				} else {
					this.file = null
				}
			},
			close() {
				this.$emit('close')
			}
		}
	}
</script>