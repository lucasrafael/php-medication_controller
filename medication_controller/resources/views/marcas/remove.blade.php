@extends('layouts.base')

@section('panel-heading')
    Remover a Marca
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('marcas.destroy', $marca->id)}}">
        <input type="hidden" name="_method" value="DELETE">

           {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <h4>Deseja realmente remover a marca?</h4>
                    <hr>

                    <p>Identificador: {{$marca->id}}</p>
                    <p>Nome: {{$marca->nome}}</p>
                </div>
            </div>

            <button type="submit" class="btn btn-danger" @guest disabled @endguest>Remover</button>
            <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
