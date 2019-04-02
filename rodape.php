    </div>
  </div>
</body>
  
    <script src='<?php echo $base_url; ?>/js/popup.js'></script>
    <script src="<?php echo $base_url; ?>/js/custom.js"></script>
<script>
$(document).ready(function(){
  $('.modal').on('shown.bs.modal', function() {
    $(this).find('[autofocus]').focus();
  }); 
  $('.modal').on('hidden.bs.modal', function(){
      $(this).find('form')[0].reset();
  });
});

$.datepick.setDefaults($.datepick.regionalOptions['pt-BR']);
  $('#styleSelect').change(function() { 
    $('#theme').attr('href', 'css/' + $(this).val()); 
    setTimeout(function() { 
        $('.onedate').datepick('option'); }, 0); 
});

var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.inteiro').mask("0#");
$('.phone_with_ddd').mask(SPMaskBehavior, spOptions);

    // $(".phone_with_ddd").mask("(99)99999-9999");
var count=0;
$('form').each(function() {
var $form = $(".formulario"+count);
$successMsg = $(".alert");
$.validator.addMethod("letters", function(value, element) {
  return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
});
$.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");
// $.validator.addMethod("data_nascimento",
//     function(value, element) {
//         return Date.parseExact(value, "d/M/yyyy");
//     });
$form.validate({
  rules: {
    field:{
      required: true
    },
    // data_nascimento: {
    //     data_nascimento: true,
    //     required: false
    // },
    name: {
      required: true,
      minlength: 3,
      letters: true
    },
    email: {
      required: false,
      email: true
    },
    SelectName: { valueNotEquals: "default" }
  },
  messages: {
    required: "Este campo e obrigatorio.",
    name: "Por favor, especifique seu nome (somente letras e espaços são permitidos)",
    email: "Por favor, especifique um email válido",
    // data_nascimento: "Por favor, especifique uma data no formato dd-mm-yyyy."
  },
  submitHandler: function() {
    if(!$(".fichatrabalho").length){
      form.submit();
    }
    $successMsg.show();
  }
});
count=count+1;
});
jQuery.extend(jQuery.validator.messages, {
  required: "Este campo é obrigatório."
});
</script>
<footer>
  <div class="navbar navbar-default navbar-bottom sombra--menor--rodape">
    <h4>MonsterCave</h4>
  </div>
</footer>
</html>