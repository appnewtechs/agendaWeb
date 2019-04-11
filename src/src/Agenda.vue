<template>
	<div class="container">
		<!-- FILTROS -->
		<div class="col-sm-2">
			<div class="row filtros">
				<div class="filtros__titulo">
					<h3>Filtros</h3>
				</div>
				<!-- Usuário -->
				<div class="row filtro-toggle">
					<div class="row">
						<span class="filtro-toggle__title">
							Usuario
							<i id="icon" class="fa fa-arrow-down open"></i>
						</span>
					</div>
					<input v-model="buscaUsuario" type="text" required="true" class="form-control" autocomplete="off" name="usuarios" placeholder="Consultor..">
					<div class="filtro-toggle__checkbox filtro">
						<div v-for="usuario in usuariosSelecionados" :key="usuario.id_usuario" class="form-check row">
							<label class="form-check-label">
								<input v-model="selected_usuarios[usuario.id_usuario]" class="form-check-input" type="checkbox" :value="usuario.id_usuario" name="checkbox[]">
								{{usuario.nome}}
							</label>
						</div>
					</div>
				</div>
				<!-- Tipos de trabalho -->
				<div class="row filtro-toggle">
					<div class="row">
						<span class="filtro-toggle__title">
							Tipos de Trabalho
							<i id="icon" class="fa fa-arrow-down open"></i>
						</span>
					</div>
					<div class="row filtro-toggle__checkbox">
						<div v-for="trabalho in filtroTrabalho" :key="trabalho.id_tipo_trabalho" class="form-check row">
							<label class="form-check-label">
								<input v-model="selected_trabalhos[trabalho.id_trabalho]" class="form-check-input" type="checkbox" :value="trabalho.id_tipo_trabalho" name="checkbox[]">
								<div class="calListSquare" :style="{'background-color': '#'+trabalho.cor, 'border-color':trabalho.cor}"/>
								{{trabalho.descricao}}
							</label>
						</div>
					</div>
				</div>
				<!-- Empresas -->
				<div class="row filtro-toggle">
					<div class="row">
						<span class="filtro-toggle__title">
							Empresas
							<i id="icon" class="fa fa-arrow-down open"></i>
						</span>
					</div>
					<div class="row filtro-toggle__checkbox">
						<div v-for="empresa in filtroEmpresa" :key="empresa.id_empresa" class="form-check row">
							<label class="form-check-label">
								<input v-model="selected_empresas[empresa.id_empresa]" class="form-check-input" type="checkbox" :value="empresa.id_empresa" name="checkbox[]">
								{{empresa.nome_fantasia}}
							</label>
						</div>
					</div>
				</div>
				<!-- Clientes -->
				<div class="row filtro-toggle">
					<div class="row">
						<span class="filtro-toggle__title">
							Clientes
							<i id="icon" class="fa fa-arrow-down open"></i>
						</span>
					</div>
					<div class="row filtro-toggle__checkbox">
						<div v-for="cliente in filtroCliente" :key="cliente.id_cliente" class="form-check row">
							<label class="form-check-label">
								<input v-model="selected_clientes[cliente.id_cliente]" class="form-check-input" type="checkbox" :value="cliente.id_cliente" name="checkbox[]">
								{{cliente.nome_fantasia}}
							</label>
						</div>
					</div>
				</div>
				<!-- Linhas de produto -->
				<div class="row filtro-toggle">
					<div class="row">
						<span class="filtro-toggle__title">
							Linhs de Produto
							<i id="icon" class="fa fa-arrow-down open"></i>
						</span>
					</div>
					<div class="row filtro-toggle__checkbox">
						<div v-for="linhaProduto in filtroLinhaProduto" :key="linhaProduto.id_linha_produto" class="form-check row">
							<label class="form-check-label">
								<input v-model="selected_produtos[linhaProduto.id_linha_produto]" class="form-check-input" type="checkbox" :value="linhaProduto.id_linha_produto" name="checkbox[]">
								{{linhaProduto.descricao}}
							</label>
						</div>
					</div>
				</div>
			</div>
			<!-- Relatório -->
			<div class="row filtro-relatorio">
				<form ref="form_relatorio" action="relatorio.php" method="post" target="_blank">
					<span class="filtro-relatorio__title">Datas pro relatório</span>
					<div class="filtro-relatorio__data">
						<input type="text" required="true" class="form-control duasdatas dates" autocomplete="off" name="datas_evento" placeholder="Datas do Evento">
					</div>
					<input name="filtro" type="hidden">
					<button type="submit" class="btn btn-success" @click="handleRelatorio">Gerar Relatório</button>
				</form>
			</div>
		</div>
		<!-- AGENDA -->
		<div class="col-sm-10">
			<div v-if="modo==1" class="novoEventoDiv">
				<a href="javascript:void(0);" class="btn btn-primary pull-left h2 btn-novo novoEvento" @click="handleNovoEvento"><i class="glyphicon glyphicon-plus"></i> Novo evento</a></div>
			<FullCalendar ref="Calendar" :events="eventosFiltrados || eventos" :config="fullCalendarConfig" @view-render="viewRender" @event-selected="handleSelectEvent"/>
		</div>
		<Modal v-if="showModal" :evento="evento" @close="showModal = false"/>
	</div>
</template>
<script>
import { FullCalendar } from "vue-full-calendar"
import Modal from "./components/Modal.vue"

function getTrueKeysValues(obj) {
	const list = []
	for (const key in obj) {
		if (obj.hasOwnProperty(key) && obj[key]) {
			list.push(key)
		}
	}
	return list
}

export default {
	components: {
		FullCalendar,
		Modal
	},
	data() {
		return {
			showModal: false,
			evento: {},
			consultaUsuario: "",
			tiposEmpresas: null,
			filtroEmpresa: null,
			filtroTrabalho: null,
			filtroCliente: null,
			filtroLinhaProduto: null,
			usuariosSelect: null,
			empresasSelect: null,
			clientesSelect: null,
			linhaProdutosSelect: null,
			tiposTrabalhoSelect: null,
			usuarios: null,
			modo: null,
			eventos: null,
			buscaUsuario: "",
			selected_usuarios: {},
			selected_trabalhos: {},
			selected_clientes: {},
			selected_empresas: {},
			selected_produtos: {}
		}
	},
	computed: {
		eventosFiltrados() {
			let list = this.eventos
			if (this.hasUsuariosSelected) {
				list = list.map(evento => {
					if (!!this.selected_usuarios[evento.id_usuario]) {
						return evento
					}
					return false
				})
			}
			if (this.hasTrabalhosSelected) {
				list = list.map(evento => {
					if (!!this.selected_trabalhos[evento.tipo_trabalho]) {
						return evento
					}
					return false
				})
			}
			if (this.hasClientesSelected) {
				list = list.map(evento => {
					if (!!this.selected_clientes[evento.cliente]) {
						return evento
					}
					return false
				})
			}
			if (this.hasEmpresasSelected) {
				list = list.map(evento => {
					if (!!this.selected_empresas[evento.empresa]) {
						return evento
					}
					return false
				})
			}
			if (this.hasProtudosSelected) {
				list = list.map(evento => {
					if (!!this.selected_produtos[evento.id_linha_produto]) {
						return evento
					}
					return false
				})
			}
			return list
		},
		fullCalendarConfig() {
			return {
				displayEventTime: false,
				locale: "pt-BR",
				defaultView: "month",
				buttonText: {
					today: "Hoje",
					month: "Mês",
					week: "Semana",
					day: "Dia"
				},
				height: 650,
				eventLimit: 100,
				eventRender: (event, element) => {
					if (this.hasUsuariosSelected) {
						return !!this.selected_usuarios[event.id_usuario]
					}
					if (this.hasTrabalhosSelected) {
						return !!this.selected_trabalhos[event.tipo_trabalho]
					}
					if (this.hasClientesSelected) {
						return !!this.selected_clientes[event.cliente]
					}
					if (this.hasEmpresasSelected) {
						return !!this.selected_empresas[event.empresa]
					}
					if (this.hasProtudosSelected) {
						return !!this.selected_produtos[event.id_linha_produto]
					}
					return true
				}
			}
		},
		hasUsuariosSelected() {
			for (const usuario in this.selected_usuarios) {
				if (this.selected_usuarios[usuario]) {
					return true
				}
			}
			return false
		},
		hasTrabalhosSelected() {
			for (const trabalho in this.selected_trabalhos) {
				if (this.selected_trabalhos[trabalho]) {
					return true
				}
			}
			return false
		},
		hasClientesSelected() {
			for (const cliente in this.selected_clientes) {
				if (this.selected_clientes[cliente]) {
					return true
				}
			}
			return false
		},
		hasEmpresasSelected() {
			for (const empresa in this.selected_empresas) {
				if (this.selected_empresas[empresa]) {
					return true
				}
			}
			return false
		},
		hasProtudosSelected() {
			for (const produto in this.selected_produtos) {
				if (this.selected_produtos[produto]) {
					return true
				}
			}
			return false
		},
		usuariosSelecionados() {
			let list = this.usuarios
			if (!this.buscaUsuario) {
				return list
			}
			list = list.filter(usuario => {
				const reg = new RegExp(`${this.buscaUsuario}`, "gi")
				return (
					reg.test(usuario.nome) ||
					!!this.selected_usuarios[usuario.id_usuario]
				)
			})
			return list
		}
	},
	methods: {
		viewRender(view, element) {
			var start = moment(view.start).format("YYYY/MM/DD")
			var end = moment(view.end).format("YYYY/MM/DD")
			var result
			$.ajax({
				url: "../../eventos/eventos.php",
				method: "POST",
				async: false,
				data: {
					start: start,
					end: end
				},
				success: function(data) {
					result = data
				}
			})
			this.eventos = JSON.parse(result)
		},
		handleRelatorio() {
			const form = this.$refs.form_relatorio
			const usuarios = getTrueKeysValues(this.selected_usuarios)
			const empresas = getTrueKeysValues(this.selected_empresas)
			const clientes = getTrueKeysValues(this.selected_clientes)
			const trabalhos = getTrueKeysValues(this.selected_trabalhos)
			const linhas = getTrueKeysValues(this.selected_linhas)
			form.filtro.value = JSON.stringify({
				usuarios,
				empresas,
				clientes,
				trabalhos,
				linhas
			})
		},
		handleSelectEvent(event){
			$.ajax({
				url: "../../eventos/select-datas.php",
				method: "POST",
				data: {
					id_evento: event.id_evento
				},
				success: (data) => {
					var dataResultado = ''
					dataResultado = data.split(",")
					event.datas_trabalho = dataResultado
					this.evento = event
					this.showModal = true
			console.log(this.evento)
				}
			})
			
		},
		handleNovoEvento(){
			this.showModal = true
		}
	},
	created() {
		this.tiposEmpresas = _DADOS.tipos_empresa
		this.filtroEmpresa = _DADOS.filtro_empresa
		this.filtroTrabalho = _DADOS.filtro_trabalho
		this.filtroCliente = _DADOS.filtro_cliente
		this.filtroLinhaProduto = _DADOS.filtro_linha_produto
		this.usuariosSelect = _DADOS.usuarios_select
		this.empresasSelect = _DADOS.empresas_select
		this.clientesSelect = _DADOS.clientes_select
		this.linhaProdutosSelect = _DADOS.linha_produtos_select
		this.tiposTrabalhoSelect = _DADOS.tipos_trabalho_select
		this.usuarios = _DADOS.usuarios
		this.modo = _DADOS.modo
	},
	mounted() {
		$(".duasdatas").datepick({
			multiSelect: 2
		})
	}
}
</script>
<style>
/* @import 'fullcalendar/dist/fullcalendar.css'; */
#calendar {
	max-width: 100%;
	margin: 25px;
}
.col-centered {
	float: none;
	margin: 0 auto;
}
.modal-body .col-sm-10 {
	padding-top: 10px;
}
.filtros {
	text-align: left;
	margin-left: 15px;
}
.filtros__title {
	margin-top: 15px;
	margin-left: 0px;
}
.filtro-toggle__title {
	margin-top: 15px;
	margin-left: 10px;
}
.filtro {
	overflow-y: auto;
	display: block;
	min-height: 50px;
	max-height: 400px;
	z-index: 99;
	padding: 0px 15px;
	margin-left: -15px;
}
.filtro-toggle input {
	margin: 20px 0px;
}
.filtros .row {
	margin-left: -10px !important;
	margin-right: -10px !important;
}
.filtro-relatorio {
	margin-top: 30px;
}
.filtro-relatorio__data {
	margin: 10px 0px;
}
.fa-arrow-down {
	float: right;
	transform: rotate(0deg);
	transition: transform 0.2s linear;
}

.fa-arrow-down.open {
	float: right;
	transform: rotate(-180deg);
	transition: transform 0.2s linear;
}
.filtro-toggle,
.filtro-toggle2 {
	cursor: pointer !important;
	margin-bottom: 20px;
}
.form-check.row input {
	margin: 4px 10px 0px;
}
</style>