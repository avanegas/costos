<template>
    <div class="row">
        <div class="col-md">
            <div class="form-group row mb-3 mt-3">
                <div class="form-group col-9">
                    <h5>{{action}} Role</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" @click="save" :disabled="isProcessing">Save</button>
                    <template v-if="action == 'Update'">
                        <button type="button" class="btn btn-danger" @click.prevent="remove(form)" :disabled="isProcessing">Eliminar</button>
                    </template>
                    <button type="button" class="btn btn-secondary" @click="$router.back()" :disabled="isProcessing">Cancel</button>
                </div>
            </div>
            <div class="card">
                <div class="card card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name">
                        <small class="error-control" v-if="error.errors.name">{{error.errors.name[0]}}</small>
                    </div>
                    <div class="form-group">
                        <label>Asignar permisos</label>
                        <v-select multiple label="name" :options="permissions" v-model="form.permissions">
                        </v-select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue'
    import Flash from '../../../helpers/flash'
    import { get, post, del, byMethod } from '../../../helpers/api'
    import { toMulipartedForm } from '../../../helpers/form'
    export default {
        data() {
            return {
                permissions:[],
                form: {
                    permissions:[]
                },
                error: {
                    errors:{}
                },
                isProcessing: false,
                initializeURL: `/api/roles/create`,
                storeURL: `/api/roles`,
                action: 'Create'
            }
        },
        created() {
            if(this.$route.meta.mode === 'edit') {
                this.initializeURL = `/api/roles/${this.$route.params.id}/edit`
                this.storeURL = `/api/roles/${this.$route.params.id}?_method=PUT`
                this.action = 'Update'
            }
            get(this.initializeURL)
                .then((res) => {
                    Vue.set(this.$data, 'form', res.data.form)
                }),
                get(`/api/permissions`)
                    .then((res) => {
                        this.permissions = res.data.permissions
                    })
        },
        methods: {
            save() {
                this.isProcessing = true
                const form = toMulipartedForm(this.form, this.$route.meta.mode)
                post(this.storeURL, form)
                    .then((res) => {
                        if(res.data.saved) {
                            Flash.setSuccess(res.data.message)
                            //this.$router.push(`/users/${res.data.id}`)
                            this.$router.back()
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
            remove() {
                del(`/api/roles/${this.$route.params.id}`).then((res) => {
                    Flash.setSuccess('Ha eliminado correctamente el rol!')
                    this.$router.back()
                });
            }
        }
    }
</script>
