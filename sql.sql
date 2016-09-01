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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;