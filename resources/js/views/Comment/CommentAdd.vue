<template>
    <div>
        <div class="card-body">
            <button class="btn btn-outline-secondary float-right" v-if="authState.api_token && comentar" @click="comenta">Quiero comentar</button>
            <button class="btn btn-outline-secondary float-right" v-else-if="authState.api_token && !comentar" @click="comenta">Mejor No!</button>
            <h5>Comentarios: <strong> {{numero}}</strong></h5>
            <p v-if="!authState.api_token"><small> PARA COMENTAR ES NECESARIO REGISTRARSE</small></p>
        </div>
        <div class="input-group mt-4" v-if="!comentar">							
            <textarea class="form-control" rows="3" aria-label="With textarea" placeholder="Escriba su comentario"  v-model="form.body"></textarea>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="btn" @click="newComment()">Publicar</button>
            </div>							
        </div>     
    </div>
</template>
<script>
	import Vue from 'vue'
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
    import { get, post, del } from '../../helpers/api'
    import { toMulipartedForm } from '../../helpers/form'
    
    export default {
        components: {
			Auth
        },
        props: ['numero', 'user_id', 'post_id'],
        data() {
            return {
                authState: Auth.state,
                isProcessing: false,
                comentar: true,
                form:{},
                storeURL: `/api/comments`,
				action: 'Create'
            }
        },
        methods: {
			newComment() {
                this.isProcessing = true
                this.form.user_id = this.authState.user_id
                this.form.post_id = this.post_id
                const form = toMulipartedForm(this.form, this.$route.meta.mode)
                this.form.body = ""
				post(this.storeURL, form)
				    .then((res) => {
                        console.log('voy a emitir')
                        this.$emit('new', form)
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				        }
				        this.isProcessing = false
				    })
			},
			comenta() {
				if (this.comentar) {
					this.comentar = false;
				} else {
					this.comentar = true;
				}
			}
		}
    }
</script>