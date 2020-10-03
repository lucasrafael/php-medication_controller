<script type="text/javascript">
    $(document).ready(function(){
        $('.3d_number').mask('000');

        @if (app()->getLocale() == 'pt-BR')
            $('.date_pt-BR').mask('00/00/0000');
            $('.date_pt-BR').datepicker( $.datepicker.regional[ "pt" ] );

            @include('layouts.datapicker_regional')
        @else
            $('.date_en').mask('00/00/0000');
            $('.date_en').datepicker( $.datepicker.regional[ "en" ] );
        @endif
    });
</script>
