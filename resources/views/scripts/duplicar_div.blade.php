{{--Como declarar:
@include('scripts.duplicar_div', ['divpai' => 'id da div desejada'])--}}

<script type="text/javascript" >
    $('#addInput').on('click', function(e) {
        let i = $('{{$divpai}}').length;
        $('{{$divpai}}').first().clone().find("input").attr('name', function(idx, attrVal) {
            return attrVal.replace('[0]','')+'['+i+']';
        }).removeAttr('checked').end().find("input[type=text]").val('').end().insertBefore('.botoes');
    });

    $('#remInput').on('click', function(e) {
        let i = $('{{$divpai}}').length;
        if (i > 1){
            $('{{$divpai}}').last().remove();
        }
    });
</script>