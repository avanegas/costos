{{ Form::hidden('user_id', auth()->user()->id) }}

<div class="form-group">
	{{ Form::label('category_id', 'Categorías') }}
	{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
</div> 
<div class="form-group">
    {{ Form::label('name', 'Titulo del articulo') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
    {{ Form::label('slug', 'URL amigable') }}
    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
    {{ Form::label('image', 'Imagen') }}
	
	<div class="card" >
	    @if(isset($post->file))
	        <img src="{{ $post->file }}" class="card-img-top">
	    @endif
        {{ Form::file('image') }}
    </div>

</div>
<div class="form-group">
	{{ Form::label('slug', 'Estado') }}
    <div>
        <label>
            {{ Form::radio('status', 'PUBLISHED') }} Publicado
        </label>
        <label>
            {{ Form::radio('status', 'DRAFT') }} Borrador
        </label>
    </div>
</div>
<div class="form-group">
	{{ Form::label('tags', 'Etiquetas') }}
	<div>
	@foreach($tags as $tag)
		<label>
			{{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}
		</label>
	@endforeach
	</div>
</div>
<div class="form-group">
    {{ Form::label('excerpt', 'Resumen') }}
    {{ Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => '2']) }}
</div>
<div class="form-group">
    {{ Form::label('body', 'Descripción') }}
    {{ Form::textarea('body', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
    <a href="{{ URL::previous() }}" class="btn btn-sm btn-secondary float-right"> Regresar</a>
</div>

@section('scripts')
	<script src="{{ asset('vendor/stringToSlug/jquery.stringToSlug.min.js') }}"></script>
	<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
	<script>
		$(document).ready(function(){
		    $("#name, #slug").stringToSlug({
		        callback: function(text){
		            $('#slug').val(text);
		        }
		    });

		    CKEDITOR.config.height = 400;
			CKEDITOR.config.width  = 'auto';

			CKEDITOR.replace('body');
		});
	</script>
@endsection