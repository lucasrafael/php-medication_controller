<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Troca de navega&ccedil;&atilde;o</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand noselect">Controle de Medicamentos</div>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i>&nbsp;Início</a></li>
            <li><a href="{{route('marcas.index')}}"><i class="fa fa-copyright"></i>&nbsp;Marcas</a></li>
            <li><a href="{{route('categorias.index')}}"><i class="fa fa-list"></i>&nbsp;Categorias</a></li>
            <li><a href="{{route('medicamentos.index')}}"><i class="fa fa-briefcase-medical"></i>&nbsp;Medicamentos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li><div class="username"><strong>login:</strong>&nbsp;{{ Auth::user()->login }}</div></li>
                <li><a href="{{route('usuario.logout')}}"><i class="fa fa-power-off"></i>&nbsp;Sair</a></li>
            @else
                <li><a href="{{route('usuario.create')}}"><i class="fa fa-edit"></i> Registrar</a></li>
                <li><a href="{{route('usuario.login')}}"><i class="fa fa-key"></i> Login</a></li>
            @endif
        </ul>
    </div>
</div>
