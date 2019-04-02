<?php require_once("cabecalho.php") ?>

<script>
	// $(document).ready(function () {
 //        $('#calendario').fullCalendar({
 //            header: {
 //                left: 'prev,next today',
 //                center: 'title',
 //                right: 'month,agendaWeek,agendaDay'
 //            },
 //            defaultDate: '2016-01-12',
 //            editable: true,
 //            eventLimit: true,
 //            events: 'eventos.php',
 //            eventColor: '#dd6777'
 //        });
 //        //CADASTRA NOVO EVENTO
 //        $('#novo_evento').submit(function(){
 //            //serialize() junta todos os dados do form e deixa pronto pra ser enviado pelo ajax
 //            var dados = jQuery(this).serialize();
 //            $.ajax({
 //                type: "POST",
 //                url: "cadastrar_evento.php",
 //                data: dados,
 //                success: function(data)
 //                {
 //                	console.log(data);
 //                    if(data == "1"){
 //                        alert("Cadastrado com sucesso! ");
 //                        //atualiza a página!
 //                        location.reload();
 //                    }else{
 //                        alert("Houve algum problema.. ");
 //                    }
 //                }
 //            });
 //            return false;
 //        });
 //    });

$(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendario').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay, timelineDay'
   },

   events: "eventos.php",

   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },
   selectable: true,
   selectHelper: true,
   select: function(start, end, allDay) {
   var title = prompt('Event Title:');

   if (title) {
   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
   $.ajax({
	   url: 'cadastrar_evento.php',
	   data: 'title='+ title+'&start='+ start +'&end='+ end,
	   type: "POST",
	   success: function(json) {
	   console.log(json);
	   alert('Added Successfully');
	   }
   });
   calendar.fullCalendar('renderEvent',
   {
	   title: title,
	   start: start,
	   end: end,
	   allDay: allDay
   },
   true
   );
   }
   calendar.fullCalendar('unselect');
   },

   editable: true,
   eventDrop: function(event, delta) {
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   $.ajax({
	   url: 'alterar_evento.php',
	   data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
	   type: "POST",
	   success: function(json) {
	    alert("Updated Successfully");
	   }
   });
   },
   eventClick: function(event, element) {
   	console.log(event);
   	console.log(element);
   	openModal(event.id);
	var decision = confirm("Do you really want to do that?");
	if (decision) {
	$.ajax({
		type: "POST",
		url: "deletar_evento.php",
		data: "&id=" + event.id,
		 success: function(json) {
			 $('#calendario').fullCalendar('removeEvents', event.id);
			  alert("Updated Successfully");}
	});
	}
  	},
   eventResize: function(event) {
	   var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
	   var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
	   $.ajax({
	    url: 'update_events.php',
	    data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
	    type: "POST",
	    success: function(json) {
	     alert("Updated Successfully");
	    }
	   });
	}

  });

 });

</script>

<div id='calendario' style="padding: 30px;">
</div>

<?php include("rodape.php") ?>