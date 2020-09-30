@extends('layouts.base')

@section('panel-heading')
    Altere a marca
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('marcas.update', $marca->id)}}">
        <input type="hidden" name="_method" value="PUT">

            {{ csrf_field() }}

            <h4>Dados da Marca</h4>
            <hr>

            <div class="form-group">
                <label for="descricao">Nome</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{$marca->nome}}">
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Editar</button>
        </form>
    </div>
@endsection
