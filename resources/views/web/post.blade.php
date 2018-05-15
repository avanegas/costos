@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
            
                <div class="card-block">
                    <h6 class="card-subtitle">CATEGORIA:</h6>
                    <a href="{{ route('category', $post->category->slug) }}">
                        {{ $post->category->name }}
                    </a>

                    <h6 class="card-subtitle">ETIQUETAS:</h6>
                    @foreach($post->tags as $tag)
                    <a href="{{ route('tag', $tag->slug) }}">
                        {{ $tag->name }}
                    </a>
                    @endforeach
                </div>

                <div class="card-block">
                    @if($post->file)
                        <img src="{{ $post->file }}" class="card-img-top">
                    @endif
                    <hr>
                    <h4 class="card-title">{{ $post->name }}</h4>
                    {!! $post->body !!}
                </div>

                <hr>
                <div class="float-left"><< VER ANTERIOR.</div>
                <div class="float-right">.VER SIGUIENTE >></div><br>
                <hr>

                <div class="card-block">
                    <h5><span>{{$comments->count()}} {{ str_plural('comentario', $comments->count()) }}</span></h5>
                    @forelse ($comments as $comment)
                        <div class="media">
                            <img src="../img/persona1.jpg" width="64" height="64" alt="" class="d-flex align-self-start mr-3">
                            <div class="media-body">
                                <p class="nombre"> {{ $comment->user->name }},   <span> {{$comment->created_at}}</span></p>
                                <p class="comentario"> {{ $comment->body }}</p>
                                <div class="botones text-right">
                                    <a href="#">Responder</a>
                                    <a href="#">Editar</a>
                                    <a href="#">Borrar</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Este articulo NO tiene comentarios....?</p>
                    @endforelse
                    <div class="col-md">
                        @if (Auth::check())
                            <!--include('includes.errors')-->
                            {{ Form::open(['route' => ['comments.store'], 'method' => 'POST'], ['class'=>'form-comentarios']) }}
                                <div class="form-group">
                                    {{ Form::label('body', 'Nota :') }}
                                    <p><em> Los comentarios son supervisados y <b>no</b> admiten palabras descomedidas, nos permitimos recordarle la posibilidad de ser eliminado permanentemente de nuestro sistema. Agradecemos su valioso comentario, aporte que sabremos apreciar en alto grado. Por favor, sea prudente.</em></p>
                                    {{ Form::textarea('body', null, ['class' => 'form-control', 'placeholder'=>'Comentario', 'rows' => '4']) }}
                                </div>

                                {{ Form::hidden('post_id', $post->id) }}
                                {{ Form::submit('Enviar', ['class' => 'btn btn-success']) }}
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection