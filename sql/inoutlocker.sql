-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/05/2025 às 00:42
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inoutlocker`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_armario`
--

CREATE TABLE `tb_armario` (
  `id_armario` int(11) NOT NULL COMMENT 'PK - Número Identificador do Armário',
  `local` varchar(80) NOT NULL COMMENT 'Localização do armário',
  `flg_ativo` char(1) NOT NULL COMMENT 'Ativo: S-Sim | N-Não',
  `id_empresa` int(11) NOT NULL COMMENT 'FK - Número Identificador da empresa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_armario`
--

INSERT INTO `tb_armario` (`id_armario`, `local`, `flg_ativo`, `id_empresa`) VALUES
(1, 'Biblioteca', 'S', 1),
(2, 'Bloco C', 'S', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_empresa`
--

CREATE TABLE `tb_empresa` (
  `id_empresa` int(11) NOT NULL COMMENT 'PK - Número Identificador da empresa',
  `razao_social` varchar(80) NOT NULL COMMENT 'Razão social da empresa',
  `cnpj` varchar(20) NOT NULL COMMENT 'CNPJ da empresa',
  `endereco` varchar(80) DEFAULT NULL COMMENT 'Rua/Avenida do endereço da empresa',
  `cidade` varchar(80) DEFAULT NULL COMMENT 'Cidade do endereço da empresa',
  `uf` char(2) DEFAULT NULL COMMENT 'UF do endereço da empresa',
  `cep` varchar(10) DEFAULT NULL COMMENT 'CEP do endereço da empresa',
  `numero` int(11) DEFAULT NULL COMMENT 'Número do endereço da empresa',
  `bairro` varchar(50) DEFAULT NULL COMMENT 'Bairro do endereço da empresa',
  `flg_ativo` char(1) NOT NULL COMMENT 'Ativo: S-Sim | N-Não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_empresa`
--

INSERT INTO `tb_empresa` (`id_empresa`, `razao_social`, `cnpj`, `endereco`, `cidade`, `uf`, `cep`, `numero`, `bairro`, `flg_ativo`) VALUES
(1, 'SERVICO NACIONAL DE APRENDIZAGEM INDUSTRIAL-SENAI', '03.776.284/0001-09', 'Rua Arno Waldemar Döhler', 'Joinville', 'SC', '89219-510', 957, 'Zona Industrial Norte', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_movimentacao`
--

CREATE TABLE `tb_movimentacao` (
  `id_movimentacao` int(11) NOT NULL COMMENT 'PK -  Número Identificador da Movimentação',
  `movimentacao` datetime NOT NULL COMMENT 'Data e hora da movimentação',
  `status` varchar(45) NOT NULL COMMENT 'Status: Entrada | Saída',
  `id_usuario` int(11) NOT NULL COMMENT 'FK - Número Identificador do Usuário ',
  `id_porta` int(11) NOT NULL COMMENT 'FK -  Número Identificador da Porta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_porta`
--

CREATE TABLE `tb_porta` (
  `id_porta` int(11) NOT NULL COMMENT 'PK -  Número Identificador da Porta',
  `referencia` varchar(10) NOT NULL COMMENT 'Identificador da porta',
  `status` char(1) NOT NULL COMMENT 'Status: D-Disponível | O-Ocupado',
  `flg_ativo` char(1) NOT NULL COMMENT 'Ativo: S-Sim | N-Não',
  `id_armario` int(11) NOT NULL COMMENT 'FK -  Número Identificador do Armario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_porta`
--

INSERT INTO `tb_porta` (`id_porta`, `referencia`, `status`, `flg_ativo`, `id_armario`) VALUES
(1, 'A001', 'D', 'S', 1),
(2, 'A002', 'D', 'S', 1),
(3, 'B001', 'D', 'S', 1),
(4, 'B002', 'D', 'S', 1),
(5, 'C001', 'D', 'S', 1),
(6, 'C002', 'D', 'S', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_tipo_usuario`
--

CREATE TABLE `tb_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL COMMENT 'PK -  Número Identificador do Tipo de Usuário',
  `descricao` varchar(80) NOT NULL COMMENT 'Descrição do tipo de usuário',
  `flg_ativo` char(1) NOT NULL COMMENT 'Ativo: S-Sim | N-Não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_tipo_usuario`
--

INSERT INTO `tb_tipo_usuario` (`id_tipo_usuario`, `descricao`, `flg_ativo`) VALUES
(1, 'Admin', 'S'),
(2, 'Funcionário', 'S'),
(3, 'Comum', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id_usuario` int(11) NOT NULL COMMENT 'PK -  Número Identificador do Usuário',
  `matricula` int(11) NOT NULL COMMENT 'Matricula do usuário \r\nAno + Centena\r\nExemplo: 2025001',
  `nome` varchar(80) NOT NULL COMMENT 'Nome do usuário',
  `cpf` varchar(14) NOT NULL COMMENT 'CPF do usuário',
  `cidade` varchar(80) NOT NULL COMMENT 'Cidade do endereço do usuário',
  `endereco` varchar(80) NOT NULL COMMENT 'Rua/Avenida do endereço do usuário',
  `numero` int(11) NOT NULL COMMENT 'Número do endereço do usuário',
  `bairro` varchar(50) NOT NULL COMMENT 'Bairro do endereço do usuário',
  `cep` varchar(10) NOT NULL COMMENT 'CEP do endereço do usuário',
  `uf` char(2) NOT NULL COMMENT 'UF do endereço do usuário',
  `foto` varchar(200) DEFAULT NULL COMMENT 'Foto de perfil do usuário',
  `login` varchar(80) NOT NULL COMMENT 'Login de acesso do usuário',
  `senha` varchar(32) NOT NULL COMMENT 'Senha de acesso do usuário',
  `flg_ativo` char(1) NOT NULL COMMENT 'Ativo: S-Sim | N-Não',
  `id_empresa` int(11) NOT NULL COMMENT 'FK -  Número Identificador da Empresa',
  `id_tipo_usuario` int(11) NOT NULL COMMENT 'FK -  Número Identificador do Tipo do Usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `matricula`, `nome`, `cpf`, `cidade`, `endereco`, `numero`, `bairro`, `cep`, `uf`, `foto`, `login`, `senha`, `flg_ativo`, `id_empresa`, `id_tipo_usuario`) VALUES
(8, 2025001, 'João', '111.222.333-44', 'Joinville', 'Rua Rouxinol', 123, 'Aventureiro', '89225-100', 'SC', 'dist/img/usuarios/03db7394c53cf29a9a1e62b30f058d9e.png', 'j@teste.com', '123', 'S', 1, 1),
(9, 2025002, 'Gabriel', '111.222.333-44', 'Joinville', 'Rua Rouxinol', 42, 'Aventureiro', '89225-100', 'SC', 'dist/img/usuarios/03db7394c53cf29a9a1e62b30f058d9e.png', 'g@teste.com', '123', 'S', 1, 2),
(10, 2025003, 'Mari', '111.222.333-44', 'Joinville', 'Rua Rouxinol', 1231, 'Aventureiro', '89225-100', 'SC', 'dist/img/usuarios/03db7394c53cf29a9a1e62b30f058d9e.png', '', 'd41d8cd98f00b204e9800998ecf8427e', 'S', 1, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_armario`
--
ALTER TABLE `tb_armario`
  ADD PRIMARY KEY (`id_armario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Índices de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `tb_movimentacao`
--
ALTER TABLE `tb_movimentacao`
  ADD PRIMARY KEY (`id_movimentacao`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_porta` (`id_porta`);

--
-- Índices de tabela `tb_porta`
--
ALTER TABLE `tb_porta`
  ADD PRIMARY KEY (`id_porta`),
  ADD KEY `id_armario` (`id_armario`);

--
-- Índices de tabela `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_armario`
--
ALTER TABLE `tb_armario`
  MODIFY `id_armario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - Número Identificador do Armário', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_empresa`
--
ALTER TABLE `tb_empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - Número Identificador da empresa', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_movimentacao`
--
ALTER TABLE `tb_movimentacao`
  MODIFY `id_movimentacao` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK -  Número Identificador da Movimentação', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_porta`
--
ALTER TABLE `tb_porta`
  MODIFY `id_porta` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK -  Número Identificador da Porta', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tb_tipo_usuario`
--
ALTER TABLE `tb_tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK -  Número Identificador do Tipo de Usuário', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK -  Número Identificador do Usuário', AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_armario`
--
ALTER TABLE `tb_armario`
  ADD CONSTRAINT `tb_armario_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `tb_empresa` (`id_empresa`);

--
-- Restrições para tabelas `tb_movimentacao`
--
ALTER TABLE `tb_movimentacao`
  ADD CONSTRAINT `tb_movimentacao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id_usuario`),
  ADD CONSTRAINT `tb_movimentacao_ibfk_2` FOREIGN KEY (`id_porta`) REFERENCES `tb_porta` (`id_porta`);

--
-- Restrições para tabelas `tb_porta`
--
ALTER TABLE `tb_porta`
  ADD CONSTRAINT `tb_porta_ibfk_1` FOREIGN KEY (`id_armario`) REFERENCES `tb_armario` (`id_armario`);

--
-- Restrições para tabelas `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `tb_usuario_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `tb_empresa` (`id_empresa`),
  ADD CONSTRAINT `tb_usuario_ibfk_2` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tb_tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
