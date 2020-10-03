@extends('marcas.default')

@section('panel-heading')
    Listagem de medicamentos por marca
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Marca: <strong>{{ $marca->nome }}</strong></h4>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="column-order-color text-center">Nome <i class="fa fa-caret-down"></i></th>
                            <th>Ver informa&ccedil;&otilde;es</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marca->medicamentos as $medicamento)
                            <tr>
                                <td>{{$medicamento->nome}}</td>
                                <td><a href="{{route('medicamentos.show', $medicamento->id)}}">Visualisar medicamento</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
