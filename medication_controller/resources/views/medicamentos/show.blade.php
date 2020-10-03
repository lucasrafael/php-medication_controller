@extends('medicamentos.default')

@section('panel-heading')
    Detalhes de medicamento
@endsection

@section('panel-button')
    <a href="{{ url()->previous() }}" class="btn btn-default">Voltar</a>
@endsection

@section('content')
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <p><b>Identificador:</b> {{$medicamento->id}}</p>
                <p><b>Nome:</b> {{$medicamento->nome}}</p>
                <p><b>Descri&ccedil;&atilde;o:</b> {{$medicamento->descricao}}</p>
                <p><b>Prescri&ccedil;&atilde;o:</b> {{$medicamento->prescricao}}</p>
                <p><b>Validade:</b> {{$medicamento->validade}}</p>
                <p><b>Quantidade:</b> {{$medicamento->quantidade}}</p>
                <p><b>Marca:</b> {{$medicamento->marca->nome}}</p>
                <p><b>Categorias:</b>
                    @foreach($medicamento->categorias as $categoria)
                        <a href="{{route('categorias.show', $categoria->id)}}">{{$categoria->nome}}</a>
                    @endforeach
                </p>
            </div>
        </div>
    </div>
@endsection
