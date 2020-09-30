@extends('layouts.base')

@section('panel-heading')
    Detalhes da Marca
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <p>Identificador: {{$marca->id}}</p>
                <p>Nome: {{$marca->nome}}</p>
            </div>
        </div>
    </div>
@endsection
