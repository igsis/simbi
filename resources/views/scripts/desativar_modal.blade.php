
<script defer type="text/javascript">
	
	$('#desativar').on('show.bs.modal', function (e)
    {	
    	let id = $(e.relatedTarget).attr('data-id');
    	let message = $(e.relatedTarget).attr('data-title');
    	let route = $(e.relatedTarget).attr('data-route')
    	
    	$(this).find('.modal-title').text(` Desativar ${message} ?`);
    	$(this).find('form').attr('action', `${route}/${id}`);
    });

</script>


<script defer type="text/javascript">
    
    $('#ativar').on('show.bs.modal', function (e)
    {   
        let id = $(e.relatedTarget).attr('data-id');
        let message = $(e.relatedTarget).attr('data-title');
        let route = $(e.relatedTarget).attr('data-route')
        
        $(this).find('.modal-title').text(` Ativar ${message} ?`);
        $(this).find('form').attr('action', `${route}/${id}`);
    });

</script>