{{--Como declarar:
@include('scripts.duplicar_div', ['divpai' => 'id da div desejada'])--}}

<script type="text/javascript" >
    $(function () {
        let divfilha = $('#divfilha');
        $(document).on('click', '#addInput', function () {
            $('{{$divpai}}').clone().find('input').val('').removeAttr('checked').end().appendTo(divfilha);
            return false;
        });

        $(document).on('click', '#remInput', function () {
            $('#divfilha {{$divpai}}').last().remove();
            return false;
        });
    });
</script>