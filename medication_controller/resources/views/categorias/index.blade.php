@extends('categorias.default')

@section('panel-heading')
    Listagem de categorias
@endsection

@section('panel-button')
    <a href="{{route('categorias.create')}}">
        <button class="btn btn-primary" @guest disabled @endguest>Adicionar</button>
    </a>
@endsection

@section('content')
    <form method="GET" action="{{route('categorias.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control"
                           placeholder="Digite a parte inicial do nome da categoria"
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
                    <th class="column-order-color text-center">Nome <i class="fa fa-caret-down"></i></th>
                    <th>Medicamentos</th>
                    <th colspan="3" class="text-center">A&ccedil;&otilde;es</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->nome}}</td>
                        <td><a href="{{route('categorias.medicamentos', $categoria->id)}}">Listar medicamentos</a></td>

                        @auth
                            <td class="text-center">
                                <a href="{{route('categorias.edit', $categoria->id)}}">
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
                                <a href="{{route('categorias.remove', $categoria->id)}}">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        @else
                            <td class="text-center" title="Deve-se logar!">
                                <i class="glyphicon glyphicon-trash"></i>
                            </td>
                        @endauth
                        <td class="text-center">
                            <a href="{{route('categorias.show', $categoria->id)}}">
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
        {{ $categorias->links() }}
    </div>
@endsection
