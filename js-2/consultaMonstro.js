$(function() {
	   // Atribui evento e função para limpeza dos campos
	    $('#autocompleteCliente').on('input', limpaCampos);

	    // Dispara o Autocomplete a partir do segundo caracter
	    $( "#autocompleteCliente" ).autocomplete({
		    minLength: 2,
		    source: function( request, response ) {
		        $.ajax({
		            url: "consultaCliente.php",
		            dataType: "json",
		            data: {
		            	acao: 'autocomplete',
		                parametro: $('#autocompleteCliente').val()
		            },
		            success: function(data) {
		            	console.log(data);
		               response(data);
		            },
		            error: function(data){
		            	console.log(data);
		            }
		        });
		    },
		    focus: function( event, ui ) {
		        $("#autocompleteCliente").val( ui.item.nome_fantasia );
		        $('#id_cliente').val(ui.item.id_cliente);
		        // carregarDados();
		        return false;
		    },
		    select: function( event, ui ) {
		        $("#autocompleteCliente").val( ui.item.nome_fantasia );
				$('#id_cliente').val(ui.item.id_cliente);
		        return false;
		    }
	    })
	    .autocomplete( "instance" )._renderItem = function( ul, item ) {
	    	return $( "<li>" )
	        .append( "<a>"+ item.nome_fantasia + "</a><br>" )
	        .appendTo( ul );
	    };

	    // Função para limpar os campos caso a busca esteja vazia
	    function limpaCampos(){
	       var busca = $('#autocompleteCliente').val();
	       if(busca == ""){
	        	$('#autocompleteCliente').val('');
	       }
	    }
	});