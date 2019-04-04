<?php
require_once "../bootstrap.php";
require "../cabecalho-relatorio.php";
// require_once("../cabecalho-relatorio.php"); 
// require_once("../banco-cadastros.php"); 
// require_once("../banco-usuario.php"); 
// require_once("../funcoes.php"); 
?>

<!-- <div class="col-xs-12 breadcrumb" style="margin-bottom: 0px;">
	<span>AGENDA > RELATÓRIO</span>
</div>	 -->
<?php
if(isset($_SESSION["sucesso"])) {
  echo "<p class='alert-success'>".$_SESSION["sucesso"]."</p>";
  unset($_SESSION["sucesso"]);
}
if(isset($_SESSION["danger"])){
  echo "<p class='alert-danger'>".$_SESSION["danger"]."</p>";
  unset($_SESSION["danger"]);
}
function searchForId($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['id_rotina'] === $id) {
           return $val['edicao'];
       }
   }
   return null;
}
$selected_usuario = explode(",", $_POST['selected_usuario']);
$selected_empresa = explode(",", $_POST['selected_empresa']);
$selected_trabalho = explode(",", $_POST['selected_trabalho']);
$selected_cliente = explode(",", $_POST['selected_cliente']);
$selected_linha_produto = explode(",", $_POST['selected_linha_produto']);
// var_dump(expression)
// var_dump($selected_empresa);
date_default_timezone_set('America/Sao_Paulo');
$datas_evento = $_POST["datas_evento"];
$datas_evento = explode(",", $_POST['datas_evento']);
$datas_evento = str_replace('/', '-', $datas_evento);
$data_inicio = '';
$data_final = '';
foreach ($datas_evento as $key => $value) {
	$value = date('Y-m-d H:i:s', strtotime($value));
	if($data_inicio == ''){
		$data_inicio = $value;
	}else{
		$data_final = date('Y-m-d H:i:s', strtotime($value . ' +1 day'));
	}
}
$id = searchForId('3', $_SESSION["permissoesRotina"]);
$modo = $id;
$start = new \DateTime($data_inicio);
$end = new \DateTime($data_final);
$diaunico = 0;
if($data_final !=  ''){
$periodArr = new \DatePeriod($start , new \DateInterval('P1D') , $end);
}else{
$periodArr = new \DatePeriod($start , new \DateInterval('P1D') , $start);
$diaunico = 1;
}

// var_dump($periodArr);
$quantidadeDias = 0;
foreach($periodArr as $period) {
					$quantidadeDias++;
					}
$largura = $quantidadeDias*100;
// echo $largura;
$semana = array(
        'Sun' => 'Dom', 
        'Mon' => 'Seg',
        'Tue' => 'Ter',
        'Wed' => 'Qua',
        'Thu' => 'Qui',
        'Fri' => 'Sex',
        'Sat' => 'Sab'
    );

$filtro = '';
if($selected_usuario[0]!=''){
	// $filtro.= ' and `id_usuario` IN (' . implode(',', array_map('intval', $selected_usuario)) . ')';
}
if($selected_empresa[0]!=''){
	$filtro.= ' and `empresa` IN (' . implode(',', array_map('intval', $selected_empresa)) . ')';
}
if($selected_trabalho[0]!=''){
	$filtro.= ' and `tipo_trabalho` IN (' . implode(',', array_map('intval', $selected_trabalho)) . ')';
}
if($selected_cliente[0]!=''){
	$filtro.= ' and `cliente` IN (' . implode(',', array_map('intval', $selected_cliente)) . ')';
}

// if($selected_linha_produto[0]!=''){
// 	$filtro.= ' and `linha_produto` IN (' . implode(',', array_map('intval', $selected_linha_produto)) . ')';
// }

function myfunction($products, $field, $value)
{
   foreach($products as $key => $product)
   {
      if ( $product[$field] === $value )
         return $key;
   }
   return false;
}
$usuarios = buscaUsuariosOrder($conexao,'id_linha_produto');

?>
<style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 20px;
        color: #333;
        margin: 20px;
      }
    </style>
<!-- Primeiro busca todos usuarios, depois cada td é um usuário e dentro do loop pesquisa os eventos daquele usuário naquele intervalo de datas, depois passa novamente pelo foreach do intervalo de datas imprimindo os eventos -->
<!-- LISTA DADOS JÁ INCLUSOS NO BANCO -->
<div>
			<table id="relatorio" class="table table-bordered table-dark table-hover relatorio bluetable" width="100%">
				<thead>
					<th class="preto" width="200" >Recurso<br>Linha Produto</th>
					<?php 
					// echo $diaunico;
					if($diaunico == 1){
							echo '<th width="100" >'.$semana[$start->format('D')].'<br>'.$start->format('d/m').'</th>';
					}else{
						foreach($periodArr as $period) {
							echo '<th width="100" >'.$semana[$period->format('D')].'<br>'.$period->format('d/m').'</th>';
						}
					}
					?>
				</thead>
				<tbody>
					<?php 
					$linha_produto_row='';
					foreach ($usuarios as $keyuser => $usuario) {
						$linha_produto = chamacampo('linha_produto','descricao',"WHERE id_linha_produto='".$usuario['id_linha_produto']."'",$conexao);
						if ((in_array($usuario['id_usuario'], $selected_usuario, TRUE) || $selected_usuario[0] == '') && (in_array($usuario['id_linha_produto'], $selected_linha_produto, TRUE) || $selected_linha_produto[0] == '') ){
					?>

						<tr>
							<td class="preto" width="200" ><?php echo utf8_encode($usuario['nome']); ?><br><?php echo utf8_encode($linha_produto); ?></td>
							<?php 
							if($diaunico == 1){
								// if (in_array($usuario['id_usuario'], $selected_usuario, TRUE) || $selected_usuario[0] == ''){
								$td = '<td width="100">';
								$eventos = chamacampoarray('events','*',"WHERE start='".$start->format('Y-m-d H:i:s')."' and id_usuario='".$usuario['id_usuario']."'".$filtro,$conexao);
								$cor_evento = "";
								$eventoHtml = "";
								foreach ($eventos as $keyevento => $evento) {
									# code...
								
								if($evento['title'] != ''){
									$tipo_trabalho = chamacampo('events','tipo_trabalho',"WHERE id='".$evento['id']."'",$conexao);
									$cor_evento = chamacampo('trabalho','cor',"WHERE id_trabalho='".$tipo_trabalho."'",$conexao);
								}
								// $period->format('Y-m-d H:i:s')
								$td.= '<div class="relatorioEvento" style="background-color:#'.$cor_evento.';">'.utf8_encode($evento['title']).'</div>';
								}
								$td.='</td>';
								echo $td;
								// }
							}else{
							foreach($periodArr as $period) {
								// if (in_array($usuario['id_usuario'], $selected_usuario, TRUE) || $selected_usuario[0] == ''){
								$td = '<td width="100">';
								$eventos = chamacampoarray('events','*',"WHERE start='".$period->format('Y-m-d H:i:s')."' and id_usuario='".$usuario['id_usuario']."'".$filtro,$conexao);
								$cor_evento = "";
								$eventoHtml = "";
								foreach ($eventos as $keyevento => $evento) {
									# code...
								
								if($evento['title'] != ''){
									$tipo_trabalho = chamacampo('events','tipo_trabalho',"WHERE id='".$evento['id']."'",$conexao);
									$cor_evento = chamacampo('trabalho','cor',"WHERE id_trabalho='".$tipo_trabalho."'",$conexao);
								}
								// $period->format('Y-m-d H:i:s')
								$td.= '<div class="relatorioEvento" style="background-color:#'.$cor_evento.';">'.utf8_encode($evento['title']).'</div>';
								}
								$td.='</td>';
								echo $td;
								// }
							}
							}
							?>
						</tr>
					<?php
					}	}				
					?>
				</tbody>
			</table>

</div>

<script type="text/javascript">
$(document).ready(function() {
  // $('tbody').scroll(function(e) { //detect a scroll event on the tbody
  //  $('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
  //   $('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()-1); //fix the first cell of the header
  //   $('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()-1); //fix the first column of tdbody
  // });
   $('#relatorio').fixedHeaderTable({
                    altClass : 'odd',
                    footer : true,
                    fixedColumns : 1
                });
});

</script>

<?php include("../rodape-relatorio.php") ?>