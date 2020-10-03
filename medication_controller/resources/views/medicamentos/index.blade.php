@extends('medicamentos.default')

@section('panel-heading')
    Listagem de medicamentos
@endsection

@section('panel-button')
    <a href="{{route('medicamentos.create')}}">
        <button class="btn btn-primary" @guest disabled @endguest>Adicionar</button>
    </a>
@endsection

@section('content')
    <form method="GET" action="{{route('medicamentos.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Digite a parte inicial do nome do medicamento"
                           name="buscar">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Pesquisar</button>
                    </span>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th class="column-order-color text-center">Validade <i class="fa fa-caret-down"></i></th>
                    <th class="text-center">Quantidade</th>
                    <th>Marca</th>
                    <th colspan="3" class="text-center">A&ccedil;&otilde;es</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medicamentos as $medicamento)
                    <tr>
                        <td>{{$medicamento->nome}}</td>
                        <td class="text-center">{{$medicamento->validade}}</td>
                        <td class="text-center">{{$medicamento->quantidade}}</td>
                        <td>{{$medicamento->marca->nome}}</td>

                        @auth
                            <td class="text-center">
                                <a href="{{route('medicamentos.edit', $medicamento->id)}}">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                        @else
                            <td class="text-center" title="Deve-se logar!">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </td>
                        @endauth
                        @auth
                            <td class="text-center">
                                <a href="{{route('medicamentos.remove', $medicamento->id)}}">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        @else
                            <td class="text-center" title="Deve-se logar!">
                                <i class="glyphicon glyphicon-trash"></i>
                            </td>
                        @endauth
                        <td class="text-center">
                            <a href="{{route('medicamentos.show', $medicamento->id)}}">
                                <i class="glyphicon glyphicon-zoom-in"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div align="center" class="row">
        {{ $medicamentos->links() }}
    </div>
@endsection
