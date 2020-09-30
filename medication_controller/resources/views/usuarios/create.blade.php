@extends('layouts.base')

@section('panel-heading')
    Cadastre-se
@endsection

@section('content')
    <div class="panel-body">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form class="form-horizontal" method="post" action="{{route ('usuario.store')}}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nome" class="col-sm-5 control-label">Nome</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nome" placeholder="Informe seu nome" value="{{ old('nome') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-5 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" name="email" placeholder="Informe seu email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login" class="col-sm-5 control-label">Login</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="login" placeholder="Informe seu login" value="{{ old('login') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-5 control-label">Senha</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" placeholder="Informe sua senha" autocomplete="new-password" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-5 control-label">Confirme sua Senha</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password_confirm" placeholder="Informe novamente a senha" autocomplete="new-password" value="{{ old('password_confirm') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <button type="reset" class="btn btn-default">Limpar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
