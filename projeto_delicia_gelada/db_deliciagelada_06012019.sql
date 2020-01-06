-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: db_deliciagelada
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_acesso_setor_perfil`
--

DROP TABLE IF EXISTS `tbl_acesso_setor_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_acesso_setor_perfil` (
  `id_acesso_setor_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `id_setor_cms` int(11) NOT NULL,
  PRIMARY KEY (`id_acesso_setor_perfil`),
  KEY `fk_id_perfil_tbl_acesso_setor_perfil` (`id_perfil`),
  KEY `fk_id_setor_cms_tbl_acesso_setor_perfil` (`id_setor_cms`),
  CONSTRAINT `fk_id_perfil_tbl_acesso_setor_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfil` (`id_perfil`),
  CONSTRAINT `fk_id_setor_cms_tbl_acesso_setor_perfil` FOREIGN KEY (`id_setor_cms`) REFERENCES `tbl_setor` (`id_setor_cms`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acesso_setor_perfil`
--

LOCK TABLES `tbl_acesso_setor_perfil` WRITE;
/*!40000 ALTER TABLE `tbl_acesso_setor_perfil` DISABLE KEYS */;
INSERT INTO `tbl_acesso_setor_perfil` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,3,2);
/*!40000 ALTER TABLE `tbl_acesso_setor_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categorias`
--

DROP TABLE IF EXISTS `tbl_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(20) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categorias`
--

LOCK TABLES `tbl_categorias` WRITE;
/*!40000 ALTER TABLE `tbl_categorias` DISABLE KEYS */;
INSERT INTO `tbl_categorias` VALUES (1,'Suco Natural','2019-12-09',NULL),(2,'Vitaminas','2019-12-09',NULL);
/*!40000 ALTER TABLE `tbl_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contato`
--

DROP TABLE IF EXISTS `tbl_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contato` (
  `id_contato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `profissao` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `home_page` varchar(30) DEFAULT NULL,
  `facebook` varchar(30) DEFAULT NULL,
  `motivo_contato` varchar(20) NOT NULL,
  `mensagem` text NOT NULL,
  `data_insercao` date NOT NULL,
  `data_exclusao` date DEFAULT NULL,
  PRIMARY KEY (`id_contato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contato`
--

LOCK TABLES `tbl_contato` WRITE;
/*!40000 ALTER TABLE `tbl_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mensalistic`
--

DROP TABLE IF EXISTS `tbl_mensalistic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mensalistic` (
  `id_produto_mes` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `imagem1_inicio` varchar(50) DEFAULT NULL,
  `texto_inicio` text,
  `imagem2_inicio` varchar(50) DEFAULT NULL,
  `texto1_meio` text,
  `imagem_meio` varchar(50) DEFAULT NULL,
  `texto2_meio` text,
  `imagem_final` varchar(50) DEFAULT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date DEFAULT NULL,
  `data_exclusao` date DEFAULT NULL,
  PRIMARY KEY (`id_produto_mes`),
  KEY `fk_id_produto_tbl_mensalistic` (`id_produto`),
  CONSTRAINT `fk_id_produto_tbl_mensalistic` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produtos` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalistic`
--

LOCK TABLES `tbl_mensalistic` WRITE;
/*!40000 ALTER TABLE `tbl_mensalistic` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mensalistic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pagina`
--

DROP TABLE IF EXISTS `tbl_pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pagina` (
  `id_pagina` int(11) NOT NULL AUTO_INCREMENT,
  `nome_pagina` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pagina`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pagina`
--

LOCK TABLES `tbl_pagina` WRITE;
/*!40000 ALTER TABLE `tbl_pagina` DISABLE KEYS */;
INSERT INTO `tbl_pagina` VALUES (1,'Curiosidades','curiosidades.php'),(2,'A Empresa','empresa.php'),(3,'Lojas','lojas.php'),(4,'Home/Produtos','index.php'),(5,'Promoções','promocoes.php'),(6,'Mensalistic','mensalistic.php');
/*!40000 ALTER TABLE `tbl_pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfil`
--

DROP TABLE IF EXISTS `tbl_perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nome_perfil` varchar(100) NOT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfil`
--

LOCK TABLES `tbl_perfil` WRITE;
/*!40000 ALTER TABLE `tbl_perfil` DISABLE KEYS */;
INSERT INTO `tbl_perfil` VALUES (1,'Administrador',1,'2019-10-21',NULL),(2,'Operador de Conteúdo',1,'2019-10-21',NULL),(3,'Relacionamento com Cliente',1,'2019-10-21',NULL);
/*!40000 ALTER TABLE `tbl_perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produtos`
--

DROP TABLE IF EXISTS `tbl_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(25) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `ativado` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_id_categoria_tbl_produtos` (`id_categoria`),
  KEY `fk_id_subcategoria_tbl_produtos` (`id_subcategoria`),
  CONSTRAINT `fk_id_categoria_tbl_produtos` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`),
  CONSTRAINT `fk_id_subcategoria_tbl_produtos` FOREIGN KEY (`id_subcategoria`) REFERENCES `tbl_subcategorias` (`id_subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produtos`
--

LOCK TABLES `tbl_produtos` WRITE;
/*!40000 ALTER TABLE `tbl_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocoes`
--

DROP TABLE IF EXISTS `tbl_promocoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promocoes` (
  `id_promocao` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `desconto` int(11) NOT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_promocao`),
  KEY `fk_id_produto_tbl_promocoes` (`id_produto`),
  CONSTRAINT `fk_id_produto_tbl_promocoes` FOREIGN KEY (`id_produto`) REFERENCES `tbl_produtos` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocoes`
--

LOCK TABLES `tbl_promocoes` WRITE;
/*!40000 ALTER TABLE `tbl_promocoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_promocoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_secao_curiosidades`
--

DROP TABLE IF EXISTS `tbl_secao_curiosidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_secao_curiosidades` (
  `id_secao` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text,
  `imagem` varchar(50) DEFAULT NULL,
  `posicao_imagem` varchar(15) DEFAULT NULL,
  `formato_imagem` varchar(15) DEFAULT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_secao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_secao_curiosidades`
--

LOCK TABLES `tbl_secao_curiosidades` WRITE;
/*!40000 ALTER TABLE `tbl_secao_curiosidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_secao_curiosidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_secao_lojas`
--

DROP TABLE IF EXISTS `tbl_secao_lojas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_secao_lojas` (
  `id_secao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_loja` varchar(25) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `estado` char(2) NOT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_secao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_secao_lojas`
--

LOCK TABLES `tbl_secao_lojas` WRITE;
/*!40000 ALTER TABLE `tbl_secao_lojas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_secao_lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_setor`
--

DROP TABLE IF EXISTS `tbl_setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_setor` (
  `id_setor_cms` int(11) NOT NULL AUTO_INCREMENT,
  `nome_setor_cms` varchar(50) NOT NULL,
  `link_logo` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id_setor_cms`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_setor`
--

LOCK TABLES `tbl_setor` WRITE;
/*!40000 ALTER TABLE `tbl_setor` DISABLE KEYS */;
INSERT INTO `tbl_setor` VALUES (1,'Conteúdo','./icons/content.png','./controle_conteudo.php'),(2,'Fale Conosco','./icons/contact.png','./controle_fale_conosco.php'),(3,'Usuários','./icons/user.png','./controle_usuarios.php');
/*!40000 ALTER TABLE `tbl_setor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategorias`
--

DROP TABLE IF EXISTS `tbl_subcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_subcategoria` varchar(20) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  PRIMARY KEY (`id_subcategoria`),
  KEY `fk_id_categoria_tbl_subcategorias` (`id_categoria`),
  CONSTRAINT `fk_id_categoria_tbl_subcategorias` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategorias`
--

LOCK TABLES `tbl_subcategorias` WRITE;
/*!40000 ALTER TABLE `tbl_subcategorias` DISABLE KEYS */;
INSERT INTO `tbl_subcategorias` VALUES (1,'Morango',1,'2019-12-09',NULL),(2,'Banana',1,'2019-12-09',NULL),(3,'Maçã',2,'2019-12-09',NULL);
/*!40000 ALTER TABLE `tbl_subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `ativado` tinyint(1) NOT NULL,
  `data_insercao` date NOT NULL,
  `data_remocao` date DEFAULT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_id_perfil_tbl_usuarios` (`id_perfil`),
  CONSTRAINT `fk_id_perfil_tbl_usuarios` FOREIGN KEY (`id_perfil`) REFERENCES `tbl_perfil` (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'adm_teste','45667878989','edu@teste','1145678987','adm','adm',1,'2019-10-15',NULL,1);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-06 10:27:08
