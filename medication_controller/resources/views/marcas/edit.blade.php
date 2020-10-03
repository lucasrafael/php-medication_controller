@extends('marcas.default')

@section('panel-heading')
    Altera&ccedil;&atilde;o de marca
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h4>Dados da empresa</h4>

                <hr>

                <form method="post" action="{{route ('marcas.update', $marca->id)}}">
                    <input type="hidden" name="_method" value="PUT">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nome"><span class="text-danger">*</span>Nome</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" required value="{{$marca->nome}}">
                    </div>

                    <button type="submit" class="btn btn-primary" @guest disabled @endguest>Editar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>

                </form>

            </div>
        </div>
    </div>
@endsection
