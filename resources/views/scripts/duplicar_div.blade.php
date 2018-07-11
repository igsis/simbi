{{--Como declarar:
@include('scripts.duplicar_div', ['divpai' => 'id da div desejada'])--}}

<script type="text/javascript" >
    $(function () {

        let divfilha = $('#divfilha');

        $(document).on('click', '#addInput', function () {
            if (($('#divfilha {{$divpai}}').length))
            {
                let index = parseInt($('#divfilha {{$divpai}}').last().attr('data-cont'));
                $('{{$divpai}}').clone().attr('data-cont', index+1).find('input').val('').removeAttr('checked').end().appendTo(divfilha);
                return false;
            }
            else
            {
                let index = parseInt($('{{$divpai}}').last().attr('data-cont'));
                $('{{$divpai}}').clone().attr('data-cont', index+1).find('input').val('').removeAttr('checked').end().appendTo(divfilha);
                return false;
            }
        });

        $(document).on('click', '#remInput', function () {
            $('#divfilha {{$divpai}}').last().remove();
            return false;
        });
    });
</script>