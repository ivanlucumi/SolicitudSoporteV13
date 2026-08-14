@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Inventario')
@section('cabecera', ' Inventario')

@section('content') 

<link rel="stylesheet" href="/css/style.css">

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><strong style="color: red; font-size:30px">{{strtoupper($inventario[0]->nombreElemento)}}</strong></h3>
  </div>
  <div class="panel-body">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-6">
          <div class="col-xs-4 alto">
            <strong>JUZGADO:</strong>
          </div>
          <div class="col-xs-8 estiloShow alto" >
            {{strtoupper($inventario[0]->nombreDespacho)}}
          </div>
        </div>
        <div class="col-xs-6">
          <div class="col-xs-4 alto" >
             <strong>PLACA INVENTARIO:</strong>
          </div>
          <div class="col-xs-8 estiloShow alto" >
            {{strtoupper($inventario[0]->placaInventario)}}
          </div>
        </div>
        
      </div>
      <br>

      <div class="row">

          <div class="col-xs-6">
            <div class="col-xs-4 alto">
              <strong>MARCA:</strong>
            </div>
            <div class="col-xs-8 estiloShow alto" >
              {{strtoupper($inventario[0]->marca)}}
            </div>
          </div>
        <div class="col-xs-6">
          <div class="col-xs-4 alto" >
             <strong>MODELO:</strong>
          </div>
          <div class="col-xs-8 estiloShow alto" >
            {{strtoupper($inventario[0]->modelo)}}
          </div>
        </div>

      </div>
      <br>
      <div class="row">

          <div class="col-xs-6">
            <div class="col-xs-4 alto">
              <strong>SERIAL:</strong>
            </div>
            <div class="col-xs-8 estiloShow alto" >
              {{strtoupper($inventario[0]->serial)}}
            </div>
          </div>
        <div class="col-xs-6">
          <div class="col-xs-4 alto" >
             <strong>VALOR ARTICULO:</strong>
          </div>
          <div class="col-xs-8 estiloShow alto" >
            {{strtoupper($inventario[0]->valorArticulo)}}
          </div>
        </div>

      </div>

      <br>
      <div class="row">

          <div class="col-xs-6">
            <div class="col-xs-4 alto">
              <strong>FECHA ASIGNACION:</strong>
            </div>
            <div class="col-xs-8 estiloShow alto" >
              {{strtoupper($inventario[0]->fechaAsignacion)}}
            </div>
          </div>
        <div class="col-xs-6">
          <div class="col-xs-4 alto" >
             <strong>ESTADO PLACA:</strong>
          </div>
          <div class="col-xs-8 estiloShow alto" >
            @if(($inventario[0]->estadoPlaca) == 1)
            EN USO
            @else
            EN DESUSO
            @endif
          </div>
        </div>

      </div>
      
      <br>
      <div class="row">

          <div class="col-xs-12">
            <div class="col-xs-12 alto">
              <strong>OBSERVACIONES:</strong>
            </div><br>
            <div class="col-xs-12 estiloShow alto" >
              {{strtoupper($inventario[0]->observacionPlaca)}}
            </div>
          </div>
       
      </div>

      <br>
      <div class="row">

          <div class="col-xs-12">
            <div class="col-xs-4">
              <a href="{{ route('inventarios.edit', $inventario[0]->id) }}" class="btn btn-primary  btn-block fa fa-pencil"> EDITAR</a>
            </div>
            <div class="col-xs-4 " >
              <!--<form action="{{ route('inventarios.destroy', $inventario[0]->id) }}" method="POST">
    @csrf
    @method('DELETE')
              <button type="submit">ELIMINAR</button>
              </form> -->
              <a href="" data-target="#modal-delete-{{$inventario[0]->id}}" data-toggle="modal"><button class="btn btn-danger btn-block fa fa-close"></button></a>
            </div>
            <div class="col-xs-4">
              <a href="{{ url()->previous() }}" class="btn btn-success btn-sm btn-block">CANCELAR</a>
            </div>
          </div>
       
      </div>

    </div>
  </div>
</div>
@include('administrador.inventario.modaleliminar')

@endsection
