function fecharpopup(){
	console.log("fechou");
	$(document.body).addClass('modal-open');
	$('.luz').fadeOut('fast');
	$('.popup').fadeOut('fast');
	$('.conteudopopu').html('');
	$('.tpopup').html('');
	$('.modal-backdrop.fade.in').fadeOut('fast');
	console.log($('.tpopup'));
	console.log($('body'));
}
function fecharpopupagenda(id_ficha_trabalho,datas_trabalho,acao){
	console.log("fechou");
	console.log(id_ficha_trabalho);
	console.log(datas_trabalho);
	console.log(acao);
	if(datas_trabalho != ""){
		console.log('entrou1');
		$('input[name="datas_trabalho"]').val(datas_trabalho);
	}
	if(acao == "delete"){
		console.log('entrou2');
		$('input[name="datas_trabalho"]').val("");
	}
	$(document.body).addClass('modal-open');
	$('.luz2').fadeOut('fast');
	$('.popup2').fadeOut('fast');
	$('.conteudopopu2').html('');
	$('.tpopup2').html('');
	console.log($('.tpopup2'));
	console.log($('body2'));
	if(id_ficha_trabalho != ''){
		$.ajax({  
	        url:"select.php",  
	        method:"POST",
	        data:{id_ficha_trabalho:id_ficha_trabalho},  
	        success:function(data){ 
	        	// console.log(data);
	        	 // if($("#live_data").length != 0) {
	        	 // 	console.log('length 0');
	          //    		$('#live_data').html(data);                  	 
	        	 // }else{
	        	 	// console.log('length '+id_ficha_trabalho);
	        	 	// $('#live_data'+id_ficha_trabalho).empty();
					$('.modal.in #live_data'+id_ficha_trabalho).html(data);  
	        	 // }
	        }  
	    }); 
	}
}

function ajax(camada,pagina){
	$(camada).html('carregando...');
	$.ajax(
	{
		url: pagina,
		cache: false,
		async: true,
		success: function(html){
			$(camada).html(html);
		}
	});
}

function abrirpopup(pagina,titulo){
	console.log("abru");
	$('body').addClass('overflowAuto');
	ajax('.conteudopopup',pagina);
	$(".tpopup").html(titulo);
	$('.luz').fadeIn('fast');
	$('.popup').fadeIn('fast');

}
function abrirpopup2(pagina,titulo){
	console.log("abru");
	// $('body').addClass('overflowAuto');
	ajax('.conteudopopup2',pagina);
	$(".tpopup2").html(titulo);
	$('.luz2').fadeIn('fast');
	$('.popup2').fadeIn('fast');

}