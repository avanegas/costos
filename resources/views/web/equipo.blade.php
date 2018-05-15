@extends('layouts.app')

@section('title', '| Equipos')

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md" >
                <div class="form-group row">
                	<h3 class="col-7">Equipos</h3>
                    <div class="col-4 form-group">
                        <input type="text" id="search-input" class="form-control mr-sm-2 mb-2 mb-sm-0"  placeholder="Search..." autocomplete="off">
                    </div>
                </div>

				<div class="card">
					<div class="card-block">
			            <table class="table table-striped table-hover">
			                <thead>
			                    <tr>
			                        <th>Grupo</th>
			                        <th>Descripción</th>
			                        <th>Marca</th>
			                        <th>Tipo</th>
			                        <th>Tarifa</th>
			                        <th>Fecha</th>
			                        <th>Proveedor</th>
			                    </tr>
			                </thead>
			                <tbody>
			                	@foreach($equipos as $equipo)
			                    <tr>
			                        <td>{{$equipo->grupo_equipo->name}}</td>
			                        <td>{{$equipo->name}}</td>
			                        <td>{{$equipo->marca}}</td>
			                        <td>{{$equipo->tipo}}</td>
			                        <td class="right">{{$equipo->tarifa}}</td>
			                        <td>{{$equipo->updated_at }}</td>
			                        <td>Proveedor</td>
			                    </tr>
			                    @endforeach
			                </tbody>
			            </table>
					</div>
	            </div>

	        </div>
	    </div>
	</div>
@endsection
