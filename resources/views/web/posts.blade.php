@extends('layouts.app')

@section('title', '| Articulos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="row form-group">
                	<h3 class="col-md-8">Articulos</h3>
                    <div class="col-md-4">
                        <input type="text" id="search-input" class="form-control mr-sm-2 mb-2 mb-sm-0"  placeholder="Search..." autocomplete="off">
                    </div>
                </div>
            	@foreach($posts as $post)
                <div class="row form-group">
                    <div class="card-title"><dt>{{ $post->name }}</dt></div>

                    <div class="card-block">
                        @if($post->file)
                            <img src="{{ $post->file }}" class="card-img-top">
                        @endif
                        
                        {{ $post->excerpt }}
                        <cite class="float-right"> Comentarios 2
                        <a href="{{ route('post', $post->slug) }}"> ... . Leer más</a>
                        </cite>
                   </div>
                </div>
                @endforeach

                {{ $posts->render() }}
                
            </div>
        </div>
    </div>
@endsection
