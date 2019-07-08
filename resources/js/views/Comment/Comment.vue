<template>
    <div class="card-body media" >
        <div class="foto">
            <a class="pull-left" href="#">
                <img src="/images/persona1.jpg" width="64" height="64" alt="" class="d-flex align-self-start mr-3 imagen">
            </a>
        </div>
        <div class="media-body">
            <h6 class="media-heading">{{comment.user.name}} <small>escribio el {{comment.created_at}}</small></h6>
            {{ comment.body}}
            
            <div class="btn-group pull-right">
                <a id="like" class="btn btn-default btn-sm" role="button">
                    <i class="fas fa-thumbs-up"> 4</i> 
                </a>
                <a id="bad" class="btn btn-default btn-sm" role="button">
                    <i class="fas fa-thumbs-down"> 1</i>
                </a>
                <a id="write" class="btn btn-default btn-sm" role="button">
                    <i class="far fa-comment"></i> Responder
                </a>
                <a id="edit" class="btn btn-default btn-sm" role="button">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a id="trash" class="btn btn-default btn-sm" role="button">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['comment'],
        data() {
            return {
                comments:{}
            }
        }
    }
</script>
