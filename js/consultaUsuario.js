$(function() {
	   // Atribui evento e função para limpeza dos campos
	    $('#autocompleteUsuario').on('input', limpaCampos);

	    // Dispara o Autocomplete a partir do segundo caracter
	    $( "#autocompleteUsuario" ).autocomplete({
		    minLength: 2,
		    source: function( request, response ) {
		        $.ajax({
		            url: "consultaUsuario.php",
		            dataType: "json",
		            data: {
		            	acao: 'autocomplete',
		                parametro: $('#autocompleteUsuario').val()
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
		        $("#autocompleteUsuario").val( ui.item.login );
		        $('#id_usuario').val(ui.item.id_usuario);
		        // carregarDados();
		        return false;
		    },
		    select: function( event, ui ) {
		        $("#autocompleteUsuario").val( ui.item.login );
				$('#id_usuario').val(ui.item.id_usuario);
		        return false;
		    }
	    })
	    .autocomplete( "instance" )._renderItem = function( ul, item ) {
	    	return $( "<li>" )
	        .append( "<a>"+ item.login + "</a><br>" )
	        .appendTo( ul );
	    };

	    // Função para limpar os campos caso a busca esteja vazia
	    function limpaCampos(){
	       var busca = $('#autocompleteUsuario').val();
	       if(busca == ""){
	        	$('#autocompleteUsuario').val('');
	       }
	    }
	});