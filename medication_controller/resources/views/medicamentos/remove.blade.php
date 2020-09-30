@extends('layouts.base')

@section('panel-heading')
    Remover o Medicamento
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('medicamentos.destroy', $medicamento->id)}}">
        <input type="hidden" name="_method" value="DELETE">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <h4>Deseja realmente remover o medicamento?</h4>
                    <hr>

                    <p>Identificador: {{$medicamento->id}}</p>
                    <p>Nome: {{$medicamento->nome}}</p>
                    <p>Descri&ccedil;&atilde;o: {{$medicamento->descricao}}</p>
                    <p>Prescri&ccedil;&atilde;o: {{$medicamento->prescricao}}</p>
                </div>
            </div>
            <button type="submit" class="btn btn-danger" @guest disabled @endguest>Remover</button>
            <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
        </form>
    </div>
@endsection
