@extends('layouts.base')

@section('panel-heading')
    Altere a categoria
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('categorias.update', $categoria->id)}}">
            <input type="hidden" name="_method" value="PUT">

            {{ csrf_field() }}

            <h4>Dados do categoria</h4>
            <hr>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{$categoria->nome}}">
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Editar</button>
        </form>
    </div>
@endsection
