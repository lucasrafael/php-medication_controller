@section('date_msg')
    <div class="text-right">
        <strong>Data:</strong> {{ now() }}
    </div>
@endsection

@if(Session::has('msg_sucesso'))
    <div class="alert alert-success alert-dismissible">
        @yield('date_msg')
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('msg_sucesso') }}
    </div>
@endif
@if(Session::has('msg_erro'))
    <div class="alert alert-danger alert-dismissible">
        @yield('date_msg')
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('msg_erro') }}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        @yield('date_msg')
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
<script>
    $(document).ready(function(){
        $(".alert-success").fadeTo(3000, 1000).slideUp(1000, function(){
            $(".alert-success").alert("close");
        });
    });
</script>
