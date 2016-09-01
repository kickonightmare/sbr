-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 02-Set-2016 às 00:01
-- Versão do servidor: 5.6.11
-- versão do PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `forn_id` int(11) NOT NULL AUTO_INCREMENT,
  `forn_cnpj` char(14) NOT NULL,
  `forn_razaosoc` varchar(128) NOT NULL,
  `forn_rua` varchar(128) NOT NULL,
  `forn_numero` int(11) NOT NULL,
  `forn_complemento` varchar(64) NOT NULL,
  `forn_cep` char(8) NOT NULL,
  `forn_bairro` varchar(128) NOT NULL,
  `forn_cidade` varchar(128) NOT NULL,
  `forn_uf` char(2) NOT NULL,
  `forn_pais` varchar(64) NOT NULL,
  `forn_fone` varchar(11) NOT NULL,
  `forn_email` varchar(128) NOT NULL,
  PRIMARY KEY (`forn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `forn_id` int(11) DEFAULT NULL,
  `prod_nome` varchar(64) DEFAULT NULL,
  `prod_tipo` enum('perecivel','nao perecivel') DEFAULT NULL,
  `prod_desc` text,
  `prod_valorunit` double DEFAULT NULL,
  `prod_valorvenda` double DEFAULT NULL,
  `prod_desconto` int(11) DEFAULT NULL,
  `prod_qtdestoque` int(11) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
