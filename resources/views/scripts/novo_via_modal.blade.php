<?php
$tabela = {{$countTabela}};
?>
<script>
    function {{$nomeFuncao}}()
    {
        let select = document.getElementById("{{$idSelect}}"),
            div = document.getElementById("{{$divSelect}}"),
            i = <?=$tabela?>,
            txtVal = document.getElementById("{{$idInputModal}}").value,
            newOption = document.createElement("OPTION"),
            newInput = document.createElement("INPUT"),
            newOptionVal = document.createTextNode(txtVal);

        if (txtVal !== "")
        {
            newOption.appendChild(newOptionVal);
            newOption.setAttribute("value", `${i + 1}`);
            select.insertBefore(newOption, select.lastChild);
            newOption.setAttribute('selected', 'selected');

            newInput.setAttribute("type", "hidden");
            newInput.setAttribute("name", "{{$idInputModal}}");
            newInput.setAttribute("value", newOptionVal.textContent);
            div.insertBefore(newInput, div.lastChild);
        }
        $('#addCargo').modal('hide');
        $("input[id='{{$idInputModal}}']").val('');
    }
</script>