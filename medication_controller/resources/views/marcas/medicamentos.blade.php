@extends('layouts.base')

@section('panel-heading')
    Medicamentos da Marca
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ver informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marca->medicamentos as $medicamento)
                            <tr>
                                <td>{{$medicamento->nome}}</td>
                                <td><a href="{{route('medicamentos.show', $medicamento->id)}}">Visualisar Medicamento</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection