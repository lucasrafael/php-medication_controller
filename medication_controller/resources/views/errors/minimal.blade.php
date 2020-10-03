@extends('layouts.base')

@section('panel-heading-class', 'fa fa-thumbs-down alert-danger')

@section('panel-heading')
    Falha na solicita&ccedil;&atilde;o
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12 text-danger">
                <p><strong>C&oacute;digo:</strong> @yield('code') @isset($code){{$code}}@endisset</p>
                <p><strong>Erro:</strong> @yield('message') @isset($message){{$message}}@endisset</p>
            </div>
        </div>
    </div>
@endsection
