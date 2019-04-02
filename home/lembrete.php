
<?php if(!empty($lembretes)){ ?>
<table class="table table-striped" style="margin-top:10px; ">
	<thead>
	  <tr>
	    <th width="90%">Descricação</th>
	    <!-- <th>Usuário Remetente</th> -->
	    <th width="10%">Excluir</th>
	  </tr>
	</thead>
	<tbody>
	<?php foreach ($lembretes as $lembrete){ ?>
	  <tr>
	    <td><?= utf8_encode($lembrete['descricao']); ?></td>
	    <!-- <td><?= $lembrete['usuario_remetente']; ?></td> -->
	    <td>
							<form action="home/remove-lembrete.php" method="POST" name="form_exclusao_lembrete">
								<input type="hidden" name="id_lembrete" value="<?= $lembrete['id_lembrete']?>"/>
								<button onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn btn-xs btn-danger btn_delete">x</button>
							</form>
	    </td>
	  </tr>
	<?php  } ?>
	</tbody>
</table>
<?php } ?>
<?php $usuarios = buscaUsuariosNome($conexao); ?>
<!-- MODAL PARA CADASTRO DE NOVO lembrete -->
<div class="modal fade bs-lembrete-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Cadastro de novo lembrete</h4>
			</div>

			<div class="modal-body">
				<div class="container-fluid">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-body">
									<form class="form-horizontal formulario0" action="home/adiciona-lembrete.php" method="post">		  
										<div class="row">
											<input type="hidden" value="<?= $id_usuario_remetente ?>" name="id_usuario_remetente"></input>
										    <div class="form-group col-md-6">
										      	<label class="col-form-label required">Destinatário</label>
										    	<select name="id_usuario" class="custom-select form-control" required="true">
												<?php 
												  	foreach ($usuarios as $key => $usuario) {
														echo "<option value='".$usuario['id_usuario']."'>".utf8_encode($usuario['nome'])."</option>";
												  	}
												?>
												</select>
										    </div>
										    <div class="form-group col-md-6">
										      	<label class="col-form-label required">Descrição</label>
										    	<textarea type="text" class="form-control" name="descricao" placeholder="Descrição" required="true" autofocus></textarea>
										    </div>
										</div>
										<div class="row">
											<div class="form-group col-md-12">
												<div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn btn-success" name="botaoEnviar" name="botaoEnviar">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>		
							</div>	
						</div>	
					</div>
				</div>			
			</div>	
		</div>
	</div>
</div>