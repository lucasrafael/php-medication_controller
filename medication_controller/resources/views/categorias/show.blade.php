@extends('categorias.default')

@section('panel-heading')
    Detalhes de categoria
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <p><b>Identificador:</b> {{$categoria->id}}</p>
                <p><b>Nome:</b> {{$categoria->nome}}</p>
            </div>
        </div>
    </div>
@endsection
