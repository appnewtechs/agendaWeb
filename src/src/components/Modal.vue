<template>
	<!-- MODAL NOVO -->
	<div class="modal fade in" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:block;margin-top:100px;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal formulario0" method="POST" :action="action + '.php'">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$emit('close')">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Adicionar Evento</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id_evento" v-model="dados.id_evento">
						<div class="form-group">
							<label class="control-label col-sm-2 required">Usuário</label>
							<div class="col-sm-10">
								<select name="id_usuario" class="custom-select form-control" required="true" v-model="dados.id_usuario">
									<option v-for="usuario in usuariosSelect" :key="usuario.id_usuario" :value="usuario.id_usuario">{{usuario.nome}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Empresa</label>

							<div class="col-sm-10">
								<select name="empresa" class="custom-select form-control" v-model="dados.id_empresa">
									<option v-for="empresa in empresasSelect" :key="empresa.id_empresa" :value="empresa.id_empresa">{{empresa.nome_fantasia}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 required">Tipo de Trabalho</label>

							<div class="col-sm-10">
								<select name="tipo_trabalho" class="custom-select form-control" required="true" v-model="dados.tipo_trabalho">
									<option v-for="trabalho in tiposTrabalhoSelect" :key="trabalho.id_trabalho" :value="trabalho.id_trabalho">{{trabalho.descricao}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Titulo</label>
							<div class="col-sm-10">
								<input type="text" name="titleEdit" class="form-control" id="title" placeholder="Titulo" required="true" v-model="dados.titleEdit">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Datas do Evento</label>
							<div class="col-sm-10">
								<input type="text" required="true" class="form-control multipledates dates" autocomplete="off" name="datas_trabalho" placeholder="Datas do Evento" :value="dados.datas_trabalho" @blur="dados.datas_trabalho = $event.target.value">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-10">
								<select class="form-control" name="status" v-model="dados.status">
									<option value="1">Confirmado</option>
									<option value="0">A confirmar</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Fechar dia</label>
							<div class="col-sm-10">
								<select class="form-control" name="fechado" v-model="dados.fechado">
									<option value="0">Dia aberto</option>
									<option value="1">Bloquar dia inteiro</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Cliente</label>
							<div class="col-sm-10">
								<select name="cliente" class="custom-select form-control" v-model="dados.cliente">
									<option v-for="cliente in clientesSelect" :key="cliente.id_cliente" :value="cliente.id_cliente">{{cliente.nome_fantasia}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger">
										<input type="checkbox" name="delete"> Deletar Evento
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" @click="$emit('close')">Fechar</button>
						<button type="submit" class="btn btn-primary" id="addEvent" >Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	props: {
		evento: {
			type: Object,
			default(){
				return {}
			}
		},
		form: String
	},
	data() {
		return {
			action: 'addEvent',
			dados: {
				id_evento: this.evento.id_evento,
				titleEdit: this.evento.titleEdit,
				id_usuario: this.evento.id_usuario || '',
				id_empresa: this.evento.empresa || '',
				tipo_trabalho: this.evento.tipo_trabalho || '',
				title: this.evento.title,
				datas_trabalho: this.evento.datas_trabalho,
				status: this.evento.status || 1,
				fechado: this.evento.fechado || 1,
				cliente: this.evento.cliente || ''
			},
			usuariosSelect: [],
			empresasSelect: [],
			clientesSelect: [],
			tiposTrabalhoSelect: []
		}
	},
	methods: {
		handleSalvar() {
			console.log(
				"Salvando dados",
				JSON.parse(JSON.stringify(this.dados))
			)
		}
	},
	created() {
		this.usuariosSelect = _DADOS.usuarios_select
		this.empresasSelect = _DADOS.empresas_select
		this.clientesSelect = _DADOS.clientes_select
		this.tiposTrabalhoSelect = _DADOS.tipos_trabalho_select
		this.evento.datas_trabalho = this.evento.datas_trabalho ? this.evento.datas_trabalho.join(",") : ''
		if(this.evento.id_evento) {
			this.action = 'editEventTitle'
		} else {
			this.action = 'addEvent'
		}
		
	},
	mounted() {
		$('.multipledates').datepick({
			multiSelect: 999
		});
	}
}
</script>
<style>
</style>