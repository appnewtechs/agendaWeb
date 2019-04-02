$(function() {
	   // Atribui evento e função para limpeza dos campos
	    $('#autocompleteEmpresa').on('input', limpaCampos);

	    // Dispara o Autocomplete a partir do segundo caracter
	    $( "#autocompleteEmpresa" ).autocomplete({
		    minLength: 2,
		    source: function( request, response ) {
		        $.ajax({
		            url: "consultaEmpresa.php",
		            dataType: "json",
		            data: {
		            	acao: 'autocomplete',
		                parametro: $('#autocompleteEmpresa').val()
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
		        $("#autocompleteEmpresa").val( ui.item.nome_fantasia );
		        $('#id_empresa').val(ui.item.id_empresa);
		        // carregarDados();
		        return false;
		    },
		    select: function( event, ui ) {
		        $("#autocompleteEmpresa").val( ui.item.nome_fantasia );
				$('#id_empresa').val(ui.item.id_empresa);
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
	       var busca = $('#autocompleteEmpresa').val();
	       if(busca == ""){
	        	$('#autocompleteEmpresa').val('');
	       }
	    }
	});