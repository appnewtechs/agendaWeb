<?php
require_once "../bootstrap.php";
require "../cabecalho-relatorio.php";

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
$filtro = json_decode($_POST['filtro']);

$selected_usuario = $filtro->usuarios;
$selected_empresa = $filtro->empresas;
$selected_trabalho = $filtro->trabalhos;
$selected_cliente = $filtro->clientes;
$selected_linha_produto = $filtro->linhas;
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
// if($selected_usuario[0]!=''){
if(!empty($selected_usuario)){
	// $filtro.= ' and `id_usuario` IN (' . implode(',', array_map('intval', $selected_usuario)) . ')';
}
// if($selected_empresa[0]!=''){
	if(!empty($selected_empresa)){
	$filtro.= ' and `empresa` IN (' . implode(',', array_map('intval', $selected_empresa)) . ')';
}
// if($selected_trabalho[0]!=''){
	if(!empty($selected_trabalho)){
	$filtro.= ' and `tipo_trabalho` IN (' . implode(',', array_map('intval', $selected_trabalho)) . ')';
}
// if($selected_cliente[0]!=''){
	if(!empty($selected_cliente)){
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
$usuarios = buscaUsuariosOrder($conexao,'id_linha_produto');
$feriadosJSON = '[{"date": "2019-01-01","name": "Ano Novo"},{"date": "2019-01-25","name": "Aniv. São Paulo"},{"date": "2019-04-19","name": "Sexta-Feira Santa"},{"date": "2019-04-19","name": "Sexta-feira Santa"},{"date": "2019-04-21","name": "Tiradentes"},{"date": "2019-05-01","name": "Dia do Trabalho"},{"date": "2019-06-20","name": "Corpus Christi"},{"date": "2019-07-09","name": "Rev. Constituinte"},{"date": "2019-09-07","name": "Indep. do Brasil"},{"date": "2019-10-12","name": "N. Sra. Aparecida"},{"date": "2019-11-02","name": "Finados"},{"date": "2019-11-02","name": "Finados"},{"date": "2019-11-15","name": "Proc. da República"},{"date": "2019-11-20","name": "Consciência Negra"},{"date": "2019-12-25","name": "Natal"},{"date": "2020-01-01","name": "Ano Novo"},{"date": "2020-01-25","name": "Aniv. São Paulo"},{"date": "2020-04-10","name": "Sexta-Feira Santa"},{"date": "2020-04-10","name": "Sexta-feira Santa"},{"date": "2020-04-21","name": "Tiradentes"},{"date": "2020-05-01","name": "Dia do Trabalho"},{"date": "2020-06-11","name": "Corpus Christi"},{"date": "2020-07-09","name": "Rev. Constituinte"},{"date": "2020-09-07","name": "Indep. do Brasil"},{"date": "2020-10-12","name": "N. Sra. Aparecida"},{"date": "2020-11-02","name": "Finados"},{"date": "2020-11-02","name": "Finados"},{"date": "2020-11-15","name": "Proc. da República"},{"date": "2020-11-20","name": "Consciência Negra"},{"date": "2020-12-25","name": "Natal"},{"date": "2021-01-01","name": "Ano Novo"},{"date": "2021-01-25","name": "Aniv. São Paulo"},{"date": "2021-04-02","name": "Sexta-Feira Santa"},{"date": "2021-04-02","name": "Sexta-feira Santa"},{"date": "2021-04-21","name": "Tiradentes"},{"date": "2021-05-01","name": "Dia do Trabalho"},{"date": "2021-06-03","name": "Corpus Christi"},{"date": "2021-07-09","name": "Rev. Constituinte"},{"date": "2021-09-07","name": "Indep. do Brasil"},{"date": "2021-10-12","name": "N. Sra. Aparecida"},{"date": "2021-11-02","name": "Finados"},{"date": "2021-11-02","name": "Finados"},{"date": "2021-11-15","name": "Proc. da República"},{"date": "2021-11-20","name": "Consciência Negra"},{"date": "2021-12-25","name": "Natal"}]';
$feriados = json_decode($feriadosJSON);
?>
<style>
      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 20px;
        color: #333;
        margin: 20px;
      }
      .feriado-td{
        background-color: rgb(255, 207, 122)!important;
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
						// if ((in_array($usuario['id_usuario'], $selected_usuario, TRUE) || $selected_usuario[0] == '') && (in_array($usuario['id_linha_produto'], $selected_linha_produto, TRUE) || $selected_linha_produto[0] == '') ){
						if ((in_array($usuario['id_usuario'], $selected_usuario, TRUE) || empty($selected_usuario)) && (in_array($usuario['id_linha_produto'], $selected_linha_produto, TRUE) || empty($selected_linha_produto)) ){
					?>

						<tr>
							<td class="preto" width="200" ><?php echo utf8_encode($usuario['nome']); ?><br><?php echo utf8_encode($linha_produto); ?></td>
							<?php 
							if($diaunico == 1){
								$dia = $period->format('Y-m-d');
									$feriadoClass = false;
									$td = '';
									foreach($feriados as $feriado){
										if($feriado->date == $dia){
											$td = '<td width="100" class="feriado-td"><div class="feriado-title">'.$feriado->name.'</div>';
											break;
										}else{
											$td = '<td width="100">';
										}
									};
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
								$dia = $period->format('Y-m-d');
									$feriadoClass = false;
									$td = '';
									foreach($feriados as $feriado){
										if($feriado->date == $dia){
											$td = '<td width="100" class="feriado-td"><div class="feriado-title">'.$feriado->name.'</div>';
											break;
										}else{
											$td = '<td width="100">';
										}
									};
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