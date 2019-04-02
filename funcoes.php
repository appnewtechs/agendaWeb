<?php
function select_form($tp,$tabela,$campo,$titulo,$class,$id,$filtro_listagem,$conexao)
{
	$selected = '  <select name="'.$campo.'" id="'.$campo.'" class="'.$class.'">';
	
	if ($tp == 'edit' || $tp == 'ver' || $tp == 'copia')
	{
		
		$consulta_selected1 = mysqli_query($conexao,"SELECT * FROM $tabela WHERE id_".$tabela."='$id'") or die (mysql_error());
		$n_selected1  = mysqli_fetch_array($consulta_selected1);
		
		$id_selected1	 = $n_selected1['id_'.$tabela.''];
		$nome_selected1 = utf8_encode($n_selected1[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected1.'" selected="selected">'.$nome_selected1.'</option>
		<option value="">---</option>';

		
	}
	else if ($tp == 'add')
	{ 
		$selected .=  '
		<option value="" selected="selected">Selecione</option>';
	}
	
	// LISTAGEM DE FILIAIS EM ADD
	$consulta_selected = mysqli_query($conexao,"SELECT * FROM $tabela $filtro_listagem ORDER BY $titulo") or die (mysql_error());
	while($n_selected  = mysqli_fetch_array($consulta_selected))
	{
		
		$id_selected	 = $n_selected['id'];
		$nome_selected = utf8_encode($n_selected[''.$titulo.'']);
		
		$selected .=  '
		<option value="'.$id_selected.'">'.$nome_selected.'</option>';
	
	}
	$selected .=  '
	</select>';
	
	return $selected;
	
		
}
#ENTER EM AREA DE TEXTO
function enter($string)
{ 
	$string = str_replace(array("\r\n", "\r", "\n"), "<br>", $string); 
	return $string; 
}
#ENTER EM AREA DE TEXTO
function enter2($string)
{ 
	$string = str_replace('<br>', "\n", $string); 
	$string = str_replace('<Br>', "\n", $string); 
	$string = str_replace('<BR>', "\n", $string); 
	$string = str_replace('<bR>', "\n", $string); 
	return $string; 
}
#VIRGULA
function virgula($valor)
{
	return str_replace(".",",",$valor);
}
function chamacampo($tabela,$campo,$filtro,$conexao)
{
	// echo "SELECT $campo FROM $tabela $filtro";
	$consulta_cliente = mysqli_query($conexao,"SELECT $campo FROM $tabela $filtro") or die (mysqli_error());
	$n_cliente = mysqli_fetch_array($consulta_cliente);

	return utf8_encode($n_cliente[''.$campo.'']);	
}

function chamacampoarray($tabela,$campo,$filtro,$conexao)
{
	$consulta_cliente = mysqli_query($conexao,"SELECT $campo FROM $tabela $filtro") or die (mysqli_error());
	// $n_cliente = mysqli_fetch_array($consulta_cliente);
	$array = array();
	while ($usuario = mysqli_fetch_assoc($consulta_cliente)) {
		// var_dump($usuario);
		array_push($array, $usuario);
	}
	return $array;
	// return utf8_encode($n_cliente[''.$campo.'']);	
}

function chamacampoarray2($tabela,$campo,$filtro,$conexao)
{
	$consulta_cliente = mysqli_query($conexao,"SELECT $campo FROM $tabela $filtro") or die (mysqli_error());
	// $n_cliente = mysqli_fetch_array($consulta_cliente);
	$array = array();
	while ($usuario = mysqli_fetch_assoc($consulta_cliente)) {
		array_push($array, utf8_encode($usuario[''.$campo.'']));
	}
	return $array;
	// return utf8_encode($n_cliente[''.$campo.'']);	
}

function vfloat($valor)
{
	$array = explode(",",$valor);
	
	$um 	= str_replace(".","",$array[0]);
	
	$novo = $um.'.'.$array[1];
	
	return $novo;
}
function calculatotal($campo,$tabela,$filtro,$conexao) {

	$query1 = mysqli_query($conexao,"SELECT SUM($campo) AS soma FROM $tabela $filtro")or die(mysql_error());
	$cont1 = mysqli_fetch_array($query1);
	return $cont1["soma"];
		
}
function numeroentradas($tabela,$filtro,$conexao)
{
	$sql1 = mysqli_query($conexao,"SELECT * FROM $tabela $filtro");
	$numero = mysqli_num_rows($sql1);
	return $numero;
}

#DATA BRASIL EUA
function data_brasil_eua($data)
{
	$array = explode("/",$data);
	
	return $array[2].'-'.$array[1].'-'.$array[0];
}
#DATA EUA BRASIL
function data_eua_brasil($data)
{
	$array = explode("-",$data);
	
	return $array[2].'/'.$array[1].'/'.$array[0];
}

function enviar_email($assunto,$nome_remetente,$email_remetente,$email_para,$nome_para,$mensagem)
{


    $enviaFormularioParaNome = $nome_para;
    $enviaFormularioParaEmail = $email_para;
    $caixaPostalServidorNome = $nome_remetente;
	$caixaPostalServidorEmail = 'andre@monstermovie.com.br';
	$caixaPostalServidorSenha = 'wr9peir0718';
     
    $remetenteNome  = $nome_remetente;
    $remetenteEmail = $email_remetente;
    $assunto  = $assunto;
    $mensagem = $mensagem;
     
    $mensagemConcatenada = $mensagem;
     
    require_once('PHPMailer-master/PHPMailerAutoload.php');
     
    $mail = new PHPMailer();
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
); 
    $mail->IsSMTP();
    $mail->SMTPAuth  = true;
    $mail->CharSet = 'UTF-8';
    //$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
	$mail->Host  = 'mail.monstermovie.com.br';
    $mail->Port  = '26';
    $mail->Username  = $caixaPostalServidorEmail;
    $mail->Password  = $caixaPostalServidorSenha;
    $mail->From  = $remetenteEmail;
    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
    $mail->IsHTML(true);
    $mail->Subject  = utf8_decode($assunto);
    $mail->Body  = utf8_decode($mensagemConcatenada);
     
     
    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));
     
    if(!$mail->Send())
    {
      $mensagemRetorno = 'Erro ao enviar email: '. print($mail->ErrorInfo);
    }
    else
    {
      $mensagemRetorno = 'Email enviado com sucesso!';
    } 
}