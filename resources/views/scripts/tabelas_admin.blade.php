<!-- DataTables -->
<script src="{{asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('AdminLTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- page script -->
<script>
    $(function () {
        $('#tabela1').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "language": {
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo"
                },
                "info": "Mostrando _START_ para _END_ de _TOTAL_ Dados",
                "search":"Procurar: ",
                "lengthMenu": "Quantidade mostrada por página _MENU_ ",
                "zeroRecords": "Nenhum registro encontrado",
                "infoEmpty": " "
            }
        })
    })
</script>