-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05/12/2018 às 22:54
-- Versão do servidor: 5.7.17
-- Versão do PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ctec`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexos`
--

CREATE TABLE `anexos` (
  `cd_anexos` int(11) NOT NULL,
  `anexo` varchar(45) DEFAULT NULL,
  `thumb` varchar(45) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `path` varchar(300) DEFAULT NULL,
  `cd_chamado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

CREATE TABLE `chamados` (
  `cd_chamado` int(11) NOT NULL,
  `ds_assunto` varchar(60) NOT NULL,
  `dt_abertura` date DEFAULT NULL,
  `dt_encerramento` date DEFAULT NULL,
  `cd_usuario` int(11) DEFAULT NULL,
  `st_chamado` varchar(1) DEFAULT NULL,
  `cd_empresa` int(11) DEFAULT NULL,
  `cd_prioridade` int(11) DEFAULT NULL,
  `cd_usuario_encerrou` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `cd_empresa` int(11) NOT NULL,
  `ds_empresa` varchar(30) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `ds_logradouro` varchar(40) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `ds_bairro` varchar(30) DEFAULT NULL,
  `ds_cidade` varchar(20) DEFAULT NULL,
  `nr_cnpj` varchar(20) DEFAULT NULL,
  `ds_estado` varchar(2) DEFAULT NULL,
  `ds_telefone` varchar(20) DEFAULT NULL,
  `ds_email` varchar(100) DEFAULT NULL,
  `ds_telefone2` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lancamentos`
--

CREATE TABLE `lancamentos` (
  `cd_lancamento` int(11) NOT NULL,
  `cd_chamado` int(11) DEFAULT NULL,
  `dt_lancamento` date DEFAULT NULL,
  `ds_lancamento` longtext CHARACTER SET latin1,
  `cd_usuario` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cd_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(30) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cd_empresa` int(11) DEFAULT NULL,
  `st_usuario` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `tp_usuario` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`cd_anexos`),
  ADD KEY `fk_anexos_chamados1` (`cd_chamado`);

--
-- Índices de tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`cd_chamado`),
  ADD KEY `fk_chamados_empresas01` (`cd_empresa`),
  ADD KEY `fk_chamados_usuarios01` (`cd_usuario`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`cd_empresa`);

--
-- Índices de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD PRIMARY KEY (`cd_lancamento`),
  ADD KEY `fk_lancamentos_chamados01` (`cd_chamado`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cd_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `cd_anexos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `cd_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `cd_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  MODIFY `cd_lancamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cd_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
