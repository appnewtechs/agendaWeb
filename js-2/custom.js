$(function() {
	   // Atribui evento e função para limpeza dos campos
	    $('#busca').on('input', limpaCampos);

	    // Dispara o Autocomplete a partir do segundo caracter
	    $( "#busca" ).autocomplete({
		    minLength: 1,
		    source: function( request, response ) {
		        $.ajax({
		            url: "../consulta.php",
		            dataType: "json",
		            data: {
		            	acao: 'autocomplete',
		                parametro: $('#busca').val(),
		                tabela: $('#tabela').val(),
		                campos: $('#campos').val(),
		                like: $('#like').val()
		            },
		            success: function(data) {
		               response(data);
		               console.log('data: '+data);
		               console.log(data);
		            },error: function(data){console.log(data);}
		        });
		    },
		    focus: function( event, ui ) {
		    	if($('#tabela').val()=="cliente"){ui.item.nome=ui.item.razao_social}
		        $("#busca").val( ui.item.nome );
		        carregarDados();
		        return false;
		    },
		    select: function( event, ui ) {
		    	if($('#tabela').val()=="cliente"){ui.item.nome=ui.item.razao_social}
		        $("#busca").val( ui.item.nome );
		        return false;
		    }
	    })
	    .autocomplete( "instance" )._renderItem = function( ul, item ) {

		    if($('#tabela').val()=="cliente" || $('#tabela').val()=="agenciado"){item.nome=item.razao_social}
		    if($('#tabela').val()=="ficha_trabalho" || $('#tabela').val()=="orcamento" || $('#tabela').val()=="consolidado" || $('#tabela').val()=="voucher"){item.nome=item.job}
		    if($('#tabela').val()=="tipo_cliente" || $('#tabela').val()=="tipo_agenciado" || $('#tabela').val()=="trabalho" || $('#tabela').val()=="item_orcamentario"){item.nome=item.descricao;}
			return $( "<li>" )
	        .append( "<a>"+ item.nome + "</a><br>" )
	        .appendTo( ul );
	    };

	    // Função para carregar os dados da consulta nos respectivos campos
	    function carregarDados(){
	    	var busca = $('#busca').val();

	    	if(busca != "" && busca.length >= 1){
	    		$.ajax({
		            url: "../consulta.php",
		            dataType: "json",	
		            data: {
		            	acao: 'consulta',
		                parametro: $('#busca').val(),
		                tabela: $('#tabela').val(),
		                campos: $('#campos').val(),
		                like: $('#like').val(),
		                modo: $('#modo').val()
		            },
		            success: function( data ) {
		            	console.log(data);
		            	$('.table.table-hover.default').hide();
		            	$('.table.table-hover.busca').show();
		            	var campos = $('#campos').val().split(",").reverse();
		            	console.log(data);
		            	var td = '';
		            	for (var i = campos.length - 1; i >= 0; i--) {
		            		if(campos[i] != 'cor'){
		            			td += '<td>'+data[0][campos[i]]+'</td>';
		            		}else{
		            			td += "<td><div style='border:1px solid "+data[0][campos[i]]+";background-color:"+data[0][campos[i]]+";padding:10px;'></div></td>";
		            		}
		            	}
		            	// if($('#modo').val()==1){
		            		console.log('tabela: '+$('#tabela').val());
		            		if($('#tabela').val() == 'usuario'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../admin/usuario.php?acao=2&id_usuario='+data[0]['id_'+$('#tabela').val()]+'\',\'Usuario\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'cliente'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/cliente.php?acao=2&id_cliente='+data[0]['id_'+$('#tabela').val()]+'\',\'cliente\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'tipo_cliente'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/tipo_cliente.php?acao=2&id_tipo_cliente='+data[0]['id_'+$('#tabela').val()]+'\',\'Tipo de cliente\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'agenciado'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/agenciado_edit.php?acao=2&id_agenciado='+data[0]['id_'+$('#tabela').val()]+'\',\'Agenciado\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'tipo_agenciado'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/tipo_agenciado.php?acao=2&id_tipo_agenciado='+data[0]['id_'+$('#tabela').val()]+'\',\'Tipo de Agenciado\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'trabalho'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/trabalho.php?acao=2&id_trabalho='+data[0]['id_'+$('#tabela').val()]+'\',\'Tipo de Trabalho\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'item_orcamentario'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/item-orcamentario.php?acao=2&id_item_orcamentario='+data[0]['id_'+$('#tabela').val()]+'\',\'Item Orçamentário\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'contato'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../cadastros/contato.php?acao=2&id_contato='+data[0]['id_'+$('#tabela').val()]+'\',\'Contato\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'ficha_trabalho'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../fichatrabalho/fichatrabalho.php?acao=2&id_ficha_trabalho='+data[0]['id_'+$('#tabela').val()]+'\',\'Ficha de Trabalho\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'orcamento'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../orcamento/orcamento.php?acao=2&id_orcamento='+data[0]['id_'+$('#tabela').val()]+'\',\'Orçamento\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'consolidado'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../financeiro/consolidado.php?acao=2&id_orcamento='+data[0]['id_orcamento']+'\',\'Consolidado\');">'+td+'</tr>';
		            		}
		            		if($('#tabela').val() == 'voucher'){
								var html = '<tr data-toggle="modal" onclick="abrirpopup(\'../financeiro/voucher.php?pop=1&id_orcamento='+data[0]['id_orcamento']+'\',\'Voucher\');">'+td+'</tr>';
		            		}
		          		  	// var html = '<tr data-toggle="modal" data-target=".bs-'+$('#tabela').val()+'-alterar-modal-lg-'+data[0]['id_'+$('#tabela').val()]+'">'+td+'</tr>';
		            	// }
		            	// var html = '<tr>'+td+'</tr>';
		              	$('.table.table-hover.busca .insert').html(html);
		            }, error: function (data){console.log(data);}
		        });
	    	}
	    }

	    // Função para limpar os campos caso a busca esteja vazia
	    function limpaCampos(){
	       var busca = $('#busca').val();

	       if(busca == ""){
	        	$('.table.table-hover.default').show();
	        	$('.table.table-hover.busca').hide();
	       }
	    }
	});