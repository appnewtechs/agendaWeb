<template>
	<!-- MODAL NOVO -->
	<div class="modal fade in" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:block;margin-top:30px;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form ref="FORM" class="form-horizontal formulario0" method="POST" :action="action + '.php'">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="handleClose">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Adicionar Evento</h4>
					</div>
					<div class="modal-body">
						<input type="hidden" name="id_evento" v-model="dados.id_evento">
						<div class="form-group">
							<label class="control-label col-sm-2 required">Usuário</label>
							<div class="col-sm-10">
								<select name="id_usuario" class="custom-select form-control" required="true" v-model="dados.id_usuario" :disabled="!canEdit">
									<option v-for="usuario in usuariosSelect" :key="usuario.id_usuario" :value="usuario.id_usuario">{{usuario.nome}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Empresa</label>

							<div class="col-sm-10">
								<select name="empresa" class="custom-select form-control" v-model="dados.id_empresa" :disabled="!canEdit">
									<option v-for="empresa in empresasSelect" :key="empresa.id_empresa" :value="empresa.id_empresa">{{empresa.nome_fantasia}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2 required">Tipo de Trabalho</label>

							<div class="col-sm-10">
								<select name="tipo_trabalho" class="custom-select form-control" required="true" v-model="dados.tipo_trabalho" :disabled="!canEdit">
									<option v-for="trabalho in tiposTrabalhoSelect" :key="trabalho.id_trabalho" :value="trabalho.id_trabalho">{{trabalho.descricao}}</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label required">Titulo</label>
							<div class="col-sm-10">
								<input type="text" name="titleEdit" class="form-control" id="title" placeholder="Titulo" required="true" v-model="dados.titleEdit" :disabled="!canEdit">
							</div>
						</div>
						<div class="form-group">
							<div class="w-full mt-4 flex justify-center">
								<div class="px-4">
									<span class="text-2xl px-4">Por datas</span>
									<input type="radio" name="tipo_data" value="1" checked v-model="dados.tipo_data">
								</div>
								<div>
									<span class="text-2xl px-4">Por intervalos de data</span>
									<input type="radio" name="tipo_data" value="2" checked v-model="dados.tipo_data">
								</div>
							</div>
						</div>
						<div class="form-group" :class="{'hidden' : dados.tipo_data==2}">
							<label for="title" class="col-sm-2 control-label required">Datas do Evento</label>
							<div class="col-sm-10">
								<input type="text" required="true" class="form-control multipledates dates" autocomplete="off" name="datas_trabalho" placeholder="Datas do Evento" :value="dados.datas_trabalho" @blur.capture="dados.datas_trabalho = $event.target.value;" :disabled="!canEdit">
							</div>
						</div>
						<div class="form-group" :class="{'hidden' : dados.tipo_data==1}">
							<label for="title" class="col-sm-2 control-label required">Data Período</label>
							<div class="col-sm-10">
								<input type="text" required="true" class="form-control duasdatas dates" autocomplete="off" name="datas_trabalho_periodo" placeholder="Datas do Evento" :value="dados.datas_trabalho_periodo" @blur.capture="dados.datas_trabalho_periodo = $event.target.value;" :disabled="!canEdit">
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Status</label>
							<div class="col-sm-10">
								<select class="form-control" name="status" v-model="dados.status" :disabled="!canEdit">
									<option value="1">Confirmado</option>
									<option value="0">A confirmar</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Travar usuário criador</label>
							<div class="col-sm-10">
								<select class="form-control" name="fechado" v-model="dados.fechado" :disabled="!canEdit">
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Cliente</label>
							<div class="col-sm-10">
								<select name="cliente" class="custom-select form-control" v-model="dados.cliente" :disabled="!canEdit">
									<option v-for="cliente in clientesSelect" :key="cliente.id_cliente" :value="cliente.id_cliente">{{cliente.nome_fantasia}}</option>
								</select>
							</div>
						</div>
						<div v-if="canEdit" class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger">
										<input type="checkbox" name="delete" v-model="dados.delete" :disabled="!canEdit"> Deletar Evento
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" @click="handleClose">Fechar</button>
						<button v-if="canEdit" type="submit" class="btn btn-primary" id="addEvent" @click.prevent="handleSalvar">Salvar</button>
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
		modo: String,
		form: String
	},
	data() {
		return {
			action: 'addEvent',
			dados : {
				id_evento: null,
				titleEdit: null,
				id_usuario: null,
				id_empresa: null,
				tipo_trabalho: null,
				title: null,
				datas_trabalho: null,
				datas_trabalho_periodo: null,
				tipo_data: null,
				status: null,
				fechado: null,
				cliente: null,
				id_creator: null,
				delete: null
			},
			usuariosSelect: [],
			empresasSelect: [],
			clientesSelect: [],
			tiposTrabalhoSelect: [],
			usuario: null
		}
	},
	computed: {
		canEdit(){
			if(this.dados.id_creator == this.usuario && this.modo == 1) {
				return true;
			}
			return (!this.dados.id_evento || this.dados.fechado == 0) && this.modo == 1
		}
	},
	methods: {
		handleSalvar() {
			console.log(
				"Salvando dados",
				JSON.parse(JSON.stringify(this.dados))
			)

			const f = this.$refs['FORM'];
			var validar = false
			if(this.dados.id_evento){
				this.dados.id_creator = this.usuario
			}
			if(this.dados.delete){
				this.dados.delete = true
			}
			if(!this.dados.titleEdit && !validar){
				validar = true;
			}
			if(!this.dados.id_usuario && !validar){
				validar = true;
			}
			if(!this.dados.tipo_trabalho && !validar){
				validar = true;
			}
			if((!this.dados.datas_trabalho && !this.dados.datas_trabalho_periodo)  && !validar){
				validar = true;
			}
			// this.dados.datas_trabalho = this.dados.datas_trabalho ? this.dados.datas_trabalho.join(",") : ''
			// this.dados.datas_trabalho_periodo = this.dados.datas_trabalho_periodo ? this.dados.datas_trabalho_periodo.join(",") : ''

			if(!validar){
			$.ajax({
				url: this.action + ".php",
				method: "POST",
				data: this.dados,
				success: (data) => {
					this.dados.id_empresa = data
					this.$emit('save');
					this.handleClose();
				}
			})
			}else{
				validar = false
				console.log('campos obrigatorios faltando')
			}
		},
		loadEmpresas(id_usuario, empresa){
			// console.log(id_usuario)
			$.ajax({
				url: this.BASE_URL + "eventos/select-empresa.php",
				method: "POST",
				data: {
					id_usuario: id_usuario
				},
				success: (data) => {
					// console.log(data)
					this.dados.id_empresa = data
				}
			})
		},
		clearDados(){
			this.dados = {
				id_evento: null,
				titleEdit: null,
				id_usuario: null,
				id_empresa: null,
				tipo_trabalho: null,
				title: null,
				datas_trabalho: null,
				datas_trabalho_periodo: null,
				tipo_data: null,
				status: null,
				fechado: null,
				cliente: null,
				id_creator: null,
				delete: null
			}
		},
		handleClose(){
			this.clearDados();
			this.$emit('close')
		}
	},
	watch: {
		'dados.id_usuario'(id_usuario){
			this.loadEmpresas(id_usuario)
		},
		evento(){
			// this.dados = this.evento
		}
	},
	created() {
		this.usuariosSelect = _DADOS.usuarios_select
		this.empresasSelect = _DADOS.empresas_select
		this.clientesSelect = _DADOS.clientes_select
		this.tiposTrabalhoSelect = _DADOS.tipos_trabalho_select
		// this.evento.datas_trabalho = this.evento.datas_trabalho
		// this.evento.datas_trabalho = this.evento.datas_trabalho ? this.evento.datas_trabalho.join(",") : ''
		if(this.evento.id_evento) {
			this.action = 'editEventTitle'
		} else {
			this.action = 'addEvent'
		}
		
	},
	mounted() {
		console.log(this.modo)
		this.dados = {
			id_evento: this.evento.id_evento,
			titleEdit: this.evento.titleEdit,
			id_usuario: this.evento.id_usuario || '',
			id_empresa: this.evento.empresa || '',
			tipo_trabalho: this.evento.tipo_trabalho || '',
			title: this.evento.title,
			datas_trabalho: this.evento.datas_trabalho,
			datas_trabalho_periodo: this.evento.datas_trabalho_periodo,
			tipo_data: this.evento.tipo_data || 1,
			status: this.evento.status || 1,
			fechado: this.evento.fechado || 0,
			cliente: this.evento.cliente || '',
			id_creator: this.evento.id_creator || window.USUARIO.id
		}

		this.usuario = window.USUARIO.id

		var formatDate = function(dates){
			return dates.map(function(date){
				return date.getDate() + '/' + date.getMonth() + "/" + date.getFullYear()
			})
		}

		const _ = this;

		$('.multipledates').datepick({
			multiSelect: 999,
			onClose: function(dates) {
				const value = this.elem ? this.elem.val() : this.value;
				_.dados.datas_trabalho = value
			}
		}),
		$(".duasdatas").datepick({
			multiSelect: 2,
			onClose: function(dates) {
				const value = this.elem ? this.elem.val() : this.value;
				_.dados.datas_trabalho_periodo = value
			}
		})
	}
}
</script>
<style>
</style>