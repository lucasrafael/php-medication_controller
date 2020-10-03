@extends('marcas.default')

@section('panel-heading')
    Listagem de marcas
@endsection

@section('panel-button')
    <a href="{{route('marcas.create')}}"><button class="btn btn-primary" @guest disabled @endguest>Adicionar</button></a>
@endsection

@section('content')
    <form method="GET" action="{{route('marcas.index', 'buscar' )}}">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Digite a parte inicial do nome da marca" name="buscar">
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
                    @foreach($marcas as $marca)
                        <tr>
                            <td>{{$marca->nome}}</td>
                            <td><a href="{{route('marcas.medicamentos', $marca->id)}}">Listar medicamentos</a></td>

                            @auth
                                <td class="text-center"><a href="{{route('marcas.edit', $marca->id)}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                            @else
                                <td class="text-center" title="Deve-se logar!"><i class="glyphicon glyphicon-pencil"></i></td>
                            @endauth
                            @auth
                                <td class="text-center"><a href="{{route('marcas.remove', $marca->id)}}"><i class="glyphicon glyphicon-trash"></i></a></td>
                            @else
                                <td class="text-center" title="Deve-se logar!"><i class="glyphicon glyphicon-trash"></i></td>
                            @endauth
                            <td class="text-center"><a href="{{route('marcas.show', $marca->id)}}"><i class="glyphicon glyphicon-zoom-in"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div align="center" class="row">
        {{ $marcas->links() }}
    </div>
@endsection
