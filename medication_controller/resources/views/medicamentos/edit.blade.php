@extends('layouts.base')

@section('panel-heading')
    Altere o Medicamento
@endsection

@section('content')
    <div class="panel-body">
        <form method="post" action="{{route ('medicamentos.update', $medicamento->id)}}">
            <input type="hidden" name="_method" value="PUT">

            {{ csrf_field() }}

            <h4>Dados do Medicamento</h4>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" value="{{$medicamento->nome}}"  required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" placeholder="Descrição" name="descricao" value="{{$medicamento->descricao}}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="preco">Prescri&ccedil;&atilde;o</label>
                        <input type="text" class="form-control" placeholder="Prescri&ccedil;&atilde;o" name="prescricao" value="{{$medicamento->prescricao}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="qtdQuartos">Validade</label>
                        <input type="text" class="form-control @if (app()->getLocale() == 'pt-BR') date_pt-BR @else date_en @endif"
                               placeholder="Validade" name="validade" value="{{$medicamento->validade}}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="qtdQuartos">Quantidade</label>
                        <input type="text" class="form-control 3d_number" placeholder="Quantidade" name="quantidade" value="{{$medicamento->quantidade}}" required>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <h4>Marca</h4>
                    <hr>
                    <div class="form-group">
                        <label for="marca_id">Selecione a marca deste medicamento</label>
                        <select class="form-control" name="marca_id" required>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}"
                                    {{(isset($medicamento->marca_id) && $medicamento->marca_id == $marca->id ? 'selected' : '')}}>{{$marca->nome}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Categorias</h4>
                    <hr>
                    <div class="form-group">
                        <label for="categoria_id">Selecione as categorias deste medicamento</label>
                        <select multiple class="form-control" name="categoria_id[]" required>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}"
                                    @foreach($medicamento->categorias as $c)
                                        @if($categoria->id == $c->id) selected="selected" @endif
                                    @endforeach>
                                    {{$categoria->nome}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary" @guest disabled @endguest>Editar</button>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            @if (app()->getLocale() == 'pt-BR')
               $('.date_pt-BR').mask('00/00/0000');
               $('.date_pt-BR').datepicker( $.datepicker.regional[ "pt" ] );

               @include('layouts.datapicker_regional')
            @else
                $('.date_en').mask('0000/00/00');
                $('.date_en').datepicker( $.datepicker.regional[ "en" ] );
            @endif
            $('.3d_number').mask('000');
        });
    </script>
@endsection
