<!DOCTYPE html>
<html>

@includeIf('layouts.head')

<body class="hold-transition login-page">

@yield('conteudo')

@includeIf('layouts.scripts')

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
