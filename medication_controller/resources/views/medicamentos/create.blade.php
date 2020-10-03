@extends('medicamentos.default')

@section('panel-heading')
    Inser&ccedil;&atilde;o de medicamento
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('medicamentos.store')}}">

            {{ csrf_field() }}

            <h4>Dados do rem&eacute;dio</h4>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome"><span class="text-danger">*</span>Nome</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" value="{{ old('nome') }}" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="descricao"><span class="text-danger">*</span>Descri&ccedil;&atilde;o</label>
                        <input type="text" class="form-control" placeholder="Descri&ccedil;&atilde;o" name="descricao" value="{{ old('descricao') }}" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="validade"><span class="text-danger">*</span>Validade</label>
                        <input type="text" class="form-control @if (app()->getLocale() == 'pt-BR') date_pt-BR @else date_en @endif"
                               placeholder="Validade" name="validade" value="{{ old('validade') }}" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="qtdQuartos"><span class="text-danger">*</span>Quant.</label>
                        <input type="text" class="form-control 3d_number" placeholder="total" name="quantidade" value="{{ old('quantidade') }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="prescricao">Prescri&ccedil;&atilde;o</label>
                        <textarea style="resize:vertical" rows="4" cols="50" class="form-control" placeholder="Prescri&ccedil;&atilde;o m&eacute;dica" name="prescricao">{{ old('prescricao') }}</textarea>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <h4>Marca</h4>
                    <hr>
                    <div class="form-group">
                        <label for="marca_id"><span class="text-danger">*</span>Selecione a marca</label>
                        <select class="form-control" name="marca_id" required>
                            <option value="">---</option>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}" {{ (old('marca_id') && old('marca_id') == $marca->id ? 'selected' : '') }}>
                                    {{$marca->nome}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Categorias</h4>
                    <hr>
                    <div class="form-group">
                        <label for="categoria_id"><span class="text-danger">*</span>Selecione as categorias</label>
                        <select multiple class="form-control" name="categoria_id[]" required>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Cadastrar</button>
            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
        </form>
    </div>

    @include('medicamentos.default_create-edit')
@endsection
