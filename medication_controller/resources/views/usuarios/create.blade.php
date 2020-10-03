@extends('layouts.base')

@section('panel-heading-class','fa fa-edit')

@section('panel-heading')
    Registro de usu&aacute;rio
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <form class="form-horizontal" method="post" action="{{route ('usuario.store')}}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="nome" class="col-sm-5 control-label"><span class="text-danger">*</span>Nome</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="nome" placeholder="Informe seu nome" value="{{ old('nome') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-5 control-label"><span class="text-danger">*</span>Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" name="email" placeholder="Informe seu email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login" class="col-sm-5 control-label"><span class="text-danger">*</span>Login</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="login" placeholder="Informe seu login" value="{{ old('login') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-5 control-label"><span class="text-danger">*</span>Senha</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password" placeholder="Informe sua senha" autocomplete="new-password" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirm" class="col-sm-5 control-label"><span class="text-danger">*</span>Confirme sua Senha</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" name="password_confirm" placeholder="Informe novamente a senha" autocomplete="new-password" value="{{ old('password_confirm') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <button type="reset" class="btn btn-default">Limpar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
