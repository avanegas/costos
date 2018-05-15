@extends('layouts.app')

@section('title', '| Crear')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h5 class="card-title">
                    <i class="fa fa-key"></i> Crear categoría
                </h5>
                <div class="card-block">
                    {!! Form::open(['route' => 'categories.store']) !!}
                        
                        @include('admin.categories.partials.form')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
