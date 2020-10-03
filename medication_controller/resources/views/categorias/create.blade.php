@extends('categorias.default')

@section('panel-heading')
    Inser&ccedil;&atilde;o de categoria
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form method="post" action="{{route ('categorias.store')}}">

                    {{ csrf_field() }}

                    <h4>Dados</h4>
                    <hr>

                    <div class="form-group">
                        <label for="nome"><span class="text-danger">*</span>Nome</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" value="{{ old('nome') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary" @guest disabled @endguest>Cadastrar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
