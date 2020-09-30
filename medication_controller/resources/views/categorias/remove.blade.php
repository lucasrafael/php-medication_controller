@extends('layouts.base')

@section('panel-heading')
    Remover a categoria
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('categorias.destroy', $categoria->id)}}">
            <input type="hidden" name="_method" value="DELETE">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <h4>Deseja realmente remover a categoria?</h4>
                    <hr>

                    <p>Identificador: {{$categoria->id}}</p>
                    <p>Nome: {{$categoria->nome}}</p>
                </div>
            </div>

            <button type="submit" class="btn btn-danger" @guest disabled @endguest>Remover</button>
            <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
