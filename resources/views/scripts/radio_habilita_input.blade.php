<script type="text/javascript">
    //Script habilita input de acordo com um radio

    $(document).ready(function()
    {
        $('input:radio[name="{{$nomeRadio}}"]').change(function(e)
        {
            if ($(this).val() == 0)
            {
                $("#{{$idInput}}").attr('disabled', true).attr('placeholder', '').attr('value', '').val('');
            } else
            {
                $("#{{$idInput}}").attr('disabled', false).attr('placeholder', '{{$mensagem}}').attr('required', true);
            }
        });
    });
</script>