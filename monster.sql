-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Dez-2017 às 11:05
-- Versão do servidor: 5.5.56
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monster`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `telafundo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`telafundo`) VALUES
('uploads/2017.12.18-13.05.32telafundo.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `telefone2` varchar(30) NOT NULL,
  `telefone3` varchar(30) NOT NULL,
  `area_contato` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `observacao` varchar(300) NOT NULL,
  `id_monstro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_prestador_ficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ficha_trabalho`
--

CREATE TABLE `ficha_trabalho` (
  `id_ficha_trabalho` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_trabalho` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `agencia` varchar(100) NOT NULL,
  `data_emissao` date NOT NULL,
  `agente` varchar(100) NOT NULL,
  `contato` varchar(50) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_contato_contabilidade` int(11) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `endereco_trabalho` varchar(100) DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  `info_job` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frase`
--

CREATE TABLE `frase` (
  `id_frase` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `usado` tinyint(1) NOT NULL DEFAULT '0',
  `usado_em` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `frase`
--

INSERT INTO `frase` (`id_frase`, `descricao`, `usado`, `usado_em`) VALUES
(1, 'Frase Teste 1', 1, '2017-12-19'),
(2, 'Frase Teste 2', 0, '0000-00-00'),
(3, 'Frase Teste 3', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_orcamentario`
--

CREATE TABLE `item_orcamentario` (
  `id_item_orcamentario` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_orcamentario`
--

INSERT INTO `item_orcamentario` (`id_item_orcamentario`, `descricao`) VALUES
(1, 'Locação'),
(2, 'Estúdio\r\n'),
(3, 'Pintura de Estúdio'),
(4, 'Hospedagem Celebridade'),
(5, 'Hospedagem Elenco'),
(6, 'Hospedagem Equipe'),
(7, 'Transporte Terrestre Equipe'),
(8, 'Transporte Aéreo Equipe'),
(9, 'Transporte Terrestre Elenco'),
(10, 'Transporte Aéreo Celeb.'),
(11, 'Transporte Terrestre Celeb.'),
(12, 'Transporte Figurino'),
(13, 'Adicional Transporte (km)'),
(14, 'Extras'),
(15, 'Equipamento de Câmera'),
(16, 'Acessórios Câmera'),
(17, 'Equipamento de Som'),
(18, 'Acessórios de Som'),
(19, 'Equipamento de Luz'),
(20, 'Acessórios de Luz'),
(21, 'Celebridade'),
(22, 'Modelo'),
(23, 'Coadjuvante'),
(24, 'Figuração'),
(25, 'Fotógrafo'),
(26, 'Assistente de Fotografia'),
(27, 'Tratamento de foto'),
(28, 'Diretor de cena'),
(29, 'Assist. de Direção'),
(30, 'Diretor de Fotografia'),
(31, 'Diretor de Arte'),
(32, 'Assist de Arte'),
(33, 'Cenógrafo'),
(34, 'Assist de Cenografia'),
(35, 'Cinegrafistas'),
(36, 'Assist de Camera'),
(37, 'Op. de Áudio'),
(38, 'Assiste de Audio'),
(39, 'Logging'),
(40, 'Anima 2D'),
(41, 'Anima 3D'),
(42, 'Gráficas'),
(43, 'Stylist'),
(44, 'Assist. de Styling'),
(45, 'Camareira'),
(46, 'Costureira'),
(47, 'Carro Produção/Desprodução'),
(48, 'Maquiador'),
(49, 'Assistente de Make & Cabelo'),
(50, 'Produtor Executivo'),
(51, 'Produtor Principal'),
(52, 'Produtor Assistente'),
(53, 'Produtor de Objetos'),
(54, 'Assistente de Objetos'),
(55, 'Produtor de Elenco'),
(56, 'Assistente de Elenco'),
(57, 'Produtor de Locação'),
(58, 'Assistente de Locação'),
(59, 'Eletricista'),
(60, 'Assistente de Elétrica'),
(61, 'Ajudantes'),
(62, 'Café da manhã'),
(63, 'Almoço'),
(64, 'Manutenção de Mesa'),
(65, 'Verba de Produção'),
(66, 'Verba de Alimentação'),
(67, 'Verba de Figurino'),
(68, 'Verba de Objetos'),
(69, 'Verba de Cenografia'),
(70, 'Seguranças'),
(71, 'Radio-comunicaçao'),
(72, 'Dvd\'s'),
(73, 'XDCam'),
(74, 'Fitas Betas de 30\''),
(75, 'Fitas Betas+copias+despesas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `monstro`
--

CREATE TABLE `monstro` (
  `id_monstro` int(11) NOT NULL,
  `id_trabalho` int(11) NOT NULL,
  `id_tipo_monstro` int(11) NOT NULL,
  `prestador_servico` tinyint(1) NOT NULL,
  `razao_social` varchar(200) NOT NULL,
  `nome_fantasia` varchar(200) NOT NULL,
  `apelido` varchar(200) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `telefone_fixo` varchar(15) NOT NULL,
  `telefone_celular` varchar(20) NOT NULL,
  `observacao` varchar(200) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `banco` varchar(100) NOT NULL,
  `agencia` varchar(20) NOT NULL,
  `conta` varchar(20) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `banco_2` varchar(100) NOT NULL,
  `agencia_2` varchar(20) NOT NULL,
  `conta_2` varchar(20) NOT NULL,
  `descricao_2` varchar(200) NOT NULL,
  `banco_3` varchar(100) NOT NULL,
  `agencia_3` varchar(20) NOT NULL,
  `conta_3` varchar(20) NOT NULL,
  `descricao_3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id_orcamento` int(11) NOT NULL,
  `id_ficha_trabalho` int(11) NOT NULL,
  `voucher` varchar(110) NOT NULL,
  `status` varchar(100) NOT NULL,
  `data_emissao` date NOT NULL,
  `data_aprovacao` date DEFAULT NULL,
  `orcamento` int(11) DEFAULT NULL,
  `executado` int(11) DEFAULT NULL,
  `taxa_produtora` int(11) DEFAULT NULL,
  `eventuais` int(11) DEFAULT NULL,
  `impostos` int(11) DEFAULT NULL,
  `comissao` int(11) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `percentual_taxa_produtora` int(11) DEFAULT NULL,
  `percentual_eventuais` int(11) DEFAULT NULL,
  `percentual_impostos` int(11) DEFAULT NULL,
  `percentual_comissao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_item`
--

CREATE TABLE `orcamento_item` (
  `id_orcamento_item` int(11) NOT NULL,
  `id_orcamento` int(11) NOT NULL,
  `id_item_orcamentario` int(11) NOT NULL,
  `id_orcamento_tipo_item` int(11) NOT NULL,
  `valor_unidade` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `diarias` int(11) NOT NULL,
  `valor_total` int(11) NOT NULL,
  `executado` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `vencimento_fechamento` int(11) DEFAULT NULL,
  `vencimento_consolidado` int(11) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `nota_fiscal` varchar(100) DEFAULT NULL,
  `data_nota_fiscal` date DEFAULT NULL,
  `observacao` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento_tipo_item`
--

CREATE TABLE `orcamento_tipo_item` (
  `id_orcamento_tipo_item` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `orcamento_tipo_item`
--

INSERT INTO `orcamento_tipo_item` (`id_orcamento_tipo_item`, `descricao`) VALUES
(1, 'Locação / Transporte'),
(2, 'Equipamentos e Acessórios'),
(3, 'Casting'),
(4, 'Equipe Foto'),
(5, 'Equipe Filme'),
(6, 'Equipe de estilo'),
(7, 'Equipe Make e Cabelo'),
(8, 'Equipe Produção'),
(9, 'Alimentação'),
(10, 'Verbas'),
(11, 'Gastos Gerais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(6) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nome`, `descricao`) VALUES
(1, 'Boss', 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil_rotina`
--

CREATE TABLE `perfil_rotina` (
  `id_perfil_rotina` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `id_rotina` int(11) NOT NULL,
  `edicao` tinyint(1) NOT NULL,
  `visualizacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil_rotina`
--

INSERT INTO `perfil_rotina` (`id_perfil_rotina`, `id_perfil`, `id_rotina`, `edicao`, `visualizacao`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 1),
(3, 1, 3, 1, 1),
(4, 1, 4, 1, 1),
(5, 1, 5, 1, 1),
(6, 1, 6, 1, 1),
(7, 1, 7, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `prestador_ficha`
--

CREATE TABLE `prestador_ficha` (
  `id_prestador_ficha` int(11) NOT NULL,
  `id_prestador_monstro` int(11) NOT NULL,
  `id_ficha_trabalho` int(11) NOT NULL,
  `datas_trabalho` varchar(100) NOT NULL,
  `cache_bruto` int(11) DEFAULT NULL,
  `percentual_comissao` int(11) DEFAULT NULL,
  `cache_liquido` int(11) DEFAULT NULL,
  `comissao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotina`
--

CREATE TABLE `rotina` (
  `id_rotina` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rotina`
--

INSERT INTO `rotina` (`id_rotina`, `nome`) VALUES
(1, 'admin'),
(2, 'cadastros'),
(3, 'ficha_de_trabalho'),
(4, 'orcamento'),
(5, 'agendas'),
(6, 'followup'),
(7, 'financeiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_monstro`
--

CREATE TABLE `tipo_monstro` (
  `id_tipo_monstro` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `cliente_fornecedor` varchar(200) NOT NULL,
  `prestador_servico` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_monstro`
--

INSERT INTO `tipo_monstro` (`id_tipo_monstro`, `descricao`, `cliente_fornecedor`, `prestador_servico`) VALUES
(1, 'Retratador', 'Cliente', 0),
(2, 'Maquiador', 'Cliente/Fornecedor', 1),
(3, 'Chauffer', 'Cliente/Fornecedor', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalho`
--

CREATE TABLE `trabalho` (
  `id_trabalho` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `trabalho`
--

INSERT INTO `trabalho` (`id_trabalho`, `descricao`) VALUES
(1, 'Teste 1'),
(2, 'Teste 2'),
(3, 'Teste 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(6) NOT NULL,
  `login` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cor` varchar(20) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login`, `senha`, `nome`, `email`, `telefone`, `data_nascimento`, `cor`, `imagem`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Francisco Perdona', 'francisco.perdona@newtechs.com.br', '(47) 9953-9312', '2017-09-06', '400040', '/uploads/2017.12.19-11.00.38Francisco Perdona.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_perfil`
--

CREATE TABLE `usuario_perfil` (
  `id_usuario_perfil` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_perfil`
--

INSERT INTO `usuario_perfil` (`id_usuario_perfil`, `id_usuario`, `id_perfil`) VALUES
(17, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`),
  ADD KEY `fk_id_monstro` (`id_monstro`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_usuario_event` (`id_usuario`);

--
-- Indexes for table `ficha_trabalho`
--
ALTER TABLE `ficha_trabalho`
  ADD PRIMARY KEY (`id_ficha_trabalho`),
  ADD KEY `fk_id_cliente` (`id_cliente`),
  ADD KEY `fk_id_contato_contabilidade` (`id_contato_contabilidade`);

--
-- Indexes for table `frase`
--
ALTER TABLE `frase`
  ADD PRIMARY KEY (`id_frase`);

--
-- Indexes for table `item_orcamentario`
--
ALTER TABLE `item_orcamentario`
  ADD PRIMARY KEY (`id_item_orcamentario`);

--
-- Indexes for table `monstro`
--
ALTER TABLE `monstro`
  ADD PRIMARY KEY (`id_monstro`),
  ADD UNIQUE KEY `razao_social` (`razao_social`),
  ADD UNIQUE KEY `nome_fantasia` (`nome_fantasia`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD KEY `fk_id_tipo_monstro` (`id_tipo_monstro`),
  ADD KEY `fk_id_trabalho` (`id_trabalho`),
  ADD KEY `fk_id_usuario_monstro` (`id_usuario`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id_orcamento`),
  ADD KEY `fk_id_ficha_trabalho_orcamento` (`id_ficha_trabalho`);

--
-- Indexes for table `orcamento_item`
--
ALTER TABLE `orcamento_item`
  ADD PRIMARY KEY (`id_orcamento_item`),
  ADD KEY `fk_id_item_orcamentario` (`id_item_orcamentario`),
  ADD KEY `fk_id_orcamento_tipo_item` (`id_orcamento_tipo_item`),
  ADD KEY `fk_id_orcamento` (`id_orcamento`);

--
-- Indexes for table `orcamento_tipo_item`
--
ALTER TABLE `orcamento_tipo_item`
  ADD PRIMARY KEY (`id_orcamento_tipo_item`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `perfil_rotina`
--
ALTER TABLE `perfil_rotina`
  ADD PRIMARY KEY (`id_perfil_rotina`),
  ADD KEY `fk_id_rotina_perfil` (`id_rotina`) USING BTREE,
  ADD KEY `fk_id_perfil_rotina` (`id_perfil`);

--
-- Indexes for table `prestador_ficha`
--
ALTER TABLE `prestador_ficha`
  ADD PRIMARY KEY (`id_prestador_ficha`),
  ADD KEY `fk_id_ficha_trabalho_prestador` (`id_ficha_trabalho`),
  ADD KEY `fk_id_prestador_monstro` (`id_prestador_monstro`);

--
-- Indexes for table `rotina`
--
ALTER TABLE `rotina`
  ADD PRIMARY KEY (`id_rotina`);

--
-- Indexes for table `tipo_monstro`
--
ALTER TABLE `tipo_monstro`
  ADD PRIMARY KEY (`id_tipo_monstro`);

--
-- Indexes for table `trabalho`
--
ALTER TABLE `trabalho`
  ADD PRIMARY KEY (`id_trabalho`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`) USING BTREE,
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD PRIMARY KEY (`id_usuario_perfil`),
  ADD KEY `fk_id_usuario_perfil` (`id_usuario`) USING BTREE,
  ADD KEY `fk_id_perfil_usuario` (`id_perfil`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `ficha_trabalho`
--
ALTER TABLE `ficha_trabalho`
  MODIFY `id_ficha_trabalho` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `frase`
--
ALTER TABLE `frase`
  MODIFY `id_frase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_orcamentario`
--
ALTER TABLE `item_orcamentario`
  MODIFY `id_item_orcamentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `monstro`
--
ALTER TABLE `monstro`
  MODIFY `id_monstro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id_orcamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orcamento_item`
--
ALTER TABLE `orcamento_item`
  MODIFY `id_orcamento_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orcamento_tipo_item`
--
ALTER TABLE `orcamento_tipo_item`
  MODIFY `id_orcamento_tipo_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `perfil_rotina`
--
ALTER TABLE `perfil_rotina`
  MODIFY `id_perfil_rotina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `prestador_ficha`
--
ALTER TABLE `prestador_ficha`
  MODIFY `id_prestador_ficha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rotina`
--
ALTER TABLE `rotina`
  MODIFY `id_rotina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipo_monstro`
--
ALTER TABLE `tipo_monstro`
  MODIFY `id_tipo_monstro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trabalho`
--
ALTER TABLE `trabalho`
  MODIFY `id_trabalho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  MODIFY `id_usuario_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contato`
--
ALTER TABLE `contato`
  ADD CONSTRAINT `fk_id_monstro` FOREIGN KEY (`id_monstro`) REFERENCES `monstro` (`id_monstro`);

--
-- Limitadores para a tabela `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_id_usuario_event` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `ficha_trabalho`
--
ALTER TABLE `ficha_trabalho`
  ADD CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `monstro` (`id_monstro`),
  ADD CONSTRAINT `fk_id_contato_contabilidade` FOREIGN KEY (`id_contato_contabilidade`) REFERENCES `contato` (`id_contato`);

--
-- Limitadores para a tabela `monstro`
--
ALTER TABLE `monstro`
  ADD CONSTRAINT `fk_id_tipo_monstro` FOREIGN KEY (`id_tipo_monstro`) REFERENCES `tipo_monstro` (`id_tipo_monstro`),
  ADD CONSTRAINT `fk_id_trabalho` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id_trabalho`),
  ADD CONSTRAINT `fk_id_usuario_monstro` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `fk_id_ficha_trabalho_orcamento` FOREIGN KEY (`id_ficha_trabalho`) REFERENCES `ficha_trabalho` (`id_ficha_trabalho`);

--
-- Limitadores para a tabela `orcamento_item`
--
ALTER TABLE `orcamento_item`
  ADD CONSTRAINT `fk_id_item_orcamentario` FOREIGN KEY (`id_item_orcamentario`) REFERENCES `item_orcamentario` (`id_item_orcamentario`),
  ADD CONSTRAINT `fk_id_orcamento` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id_orcamento`),
  ADD CONSTRAINT `fk_id_orcamento_tipo_item` FOREIGN KEY (`id_orcamento_tipo_item`) REFERENCES `orcamento_tipo_item` (`id_orcamento_tipo_item`);

--
-- Limitadores para a tabela `perfil_rotina`
--
ALTER TABLE `perfil_rotina`
  ADD CONSTRAINT `fk_id_perfil_rotina` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `fk_id_rotina_perfil` FOREIGN KEY (`id_rotina`) REFERENCES `rotina` (`id_rotina`);

--
-- Limitadores para a tabela `prestador_ficha`
--
ALTER TABLE `prestador_ficha`
  ADD CONSTRAINT `fk_id_ficha_trabalho_prestador` FOREIGN KEY (`id_ficha_trabalho`) REFERENCES `ficha_trabalho` (`id_ficha_trabalho`),
  ADD CONSTRAINT `fk_id_prestador_monstro` FOREIGN KEY (`id_prestador_monstro`) REFERENCES `monstro` (`id_monstro`);

--
-- Limitadores para a tabela `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
