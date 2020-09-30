@extends('layouts.base')

@section('panel-heading')
    Insira a categoria
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('categorias.store')}}">

            {{ csrf_field() }}

            <h4>Dados da categoria</h4>
            <hr>

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" placeholder="Nome" name="nome" value="{{ old('nome') }}" required>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Cadastrar</button>
        </form>
    </div>
@endsection
