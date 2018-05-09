CREATE DATABASE  IF NOT EXISTS `dbsimbi` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dbsimbi`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbsimbi
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

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
-- Table structure for table `acervo_alexandria`
--

DROP TABLE IF EXISTS `acervo_alexandria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo_alexandria` (
  `idAcervoAlexandria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `quantidadeMaterial` int(5) DEFAULT NULL,
  `idMaterial` int(10) unsigned NOT NULL,
  `idTipoMaterial` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idAcervoAlexandria`),
  KEY `acervoalexandria_equipamento_fk_idx` (`idEquipamento`),
  KEY `acervoalexandria_material_fk_idx` (`idMaterial`),
  KEY `acervoalexandria_materialtipo_fk_idx` (`idTipoMaterial`),
  CONSTRAINT `acervoalexandria_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoalexandria_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoalexandria_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='49 - Acervo Importado do Alexandria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo_alexandria`
--

LOCK TABLES `acervo_alexandria` WRITE;
/*!40000 ALTER TABLE `acervo_alexandria` DISABLE KEYS */;
/*!40000 ALTER TABLE `acervo_alexandria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acervo_forma_documento`
--

DROP TABLE IF EXISTS `acervo_forma_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo_forma_documento` (
  `idAcervoFormaDocumento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idAcervoFormaDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='51 - Forma do Documento do Acervo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo_forma_documento`
--

LOCK TABLES `acervo_forma_documento` WRITE;
/*!40000 ALTER TABLE `acervo_forma_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `acervo_forma_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acervo_forma_movimentacao`
--

DROP TABLE IF EXISTS `acervo_forma_movimentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo_forma_movimentacao` (
  `idAcervoFormaMovimentacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idFormaDocumentoAcervo` int(10) unsigned NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `qtdConsultada` int(5) DEFAULT NULL,
  `qtdEmprestada` int(5) DEFAULT NULL,
  PRIMARY KEY (`idAcervoFormaMovimentacao`),
  KEY `acervoformamovimentacao_equipamento_fk_idx` (`idEquipamento`),
  KEY `acervoformamovimentacao_acervoformadocumento_fk_idx` (`idFormaDocumentoAcervo`),
  KEY `acervoformamovimentacao_servidor_fk_idx` (`rfOperador`),
  CONSTRAINT `acervoformamovimentacao_acervoformadocumento_fk` FOREIGN KEY (`idFormaDocumentoAcervo`) REFERENCES `acervo_forma_documento` (`idAcervoFormaDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoformamovimentacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoformamovimentacao_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='12 - Movimentacao Forma do Acervo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo_forma_movimentacao`
--

LOCK TABLES `acervo_forma_movimentacao` WRITE;
/*!40000 ALTER TABLE `acervo_forma_movimentacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `acervo_forma_movimentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acervo_movimentacao`
--

DROP TABLE IF EXISTS `acervo_movimentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo_movimentacao` (
  `idAcervoMovimentacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idMaterial` int(10) unsigned NOT NULL,
  `idTipoMaterial` int(10) unsigned NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `qtdConsultada` int(5) DEFAULT NULL,
  `qtdConsultadaTematico` int(5) DEFAULT NULL,
  `qtdEmprestada` int(5) DEFAULT NULL,
  `qtdEmprestadaTematico` int(5) DEFAULT NULL,
  PRIMARY KEY (`idAcervoMovimentacao`),
  KEY `acervomovimentacao_equipamento_fk_idx` (`idEquipamento`),
  KEY `acervomovimentacao_material_fk_idx` (`idMaterial`),
  KEY `acervomovimentacao_materialtipo_fk_idx` (`idTipoMaterial`),
  KEY `acervomovimentacao_servidor_idx` (`rfOperador`),
  CONSTRAINT `acervomovimentacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervomovimentacao_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervomovimentacao_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervomovimentacao_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='11 - Movimentacao Acervo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo_movimentacao`
--

LOCK TABLES `acervo_movimentacao` WRITE;
/*!40000 ALTER TABLE `acervo_movimentacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `acervo_movimentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acervo_quantidade`
--

DROP TABLE IF EXISTS `acervo_quantidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acervo_quantidade` (
  `idAcervoQuantidade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idMaterial` int(10) unsigned NOT NULL,
  `idTipoMaterial` int(10) unsigned NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `idAcervoAlexandria` int(10) unsigned NOT NULL,
  `qtdAcervoTematico` int(5) DEFAULT NULL,
  PRIMARY KEY (`idAcervoQuantidade`),
  KEY `acervoquantitade_equipamento_fk_idx` (`idEquipamento`),
  KEY `acervoquantidade_material_fk_idx` (`idMaterial`),
  KEY `acervoquantidade_materialtipo_fk_idx` (`idTipoMaterial`),
  KEY `acervoquantidade_acervoalexandria_fk_idx` (`idAcervoAlexandria`),
  KEY `acervoquantidade_servidor_idx` (`rfOperador`),
  CONSTRAINT `acervoquantidade_acervoalexandria_fk` FOREIGN KEY (`idAcervoAlexandria`) REFERENCES `acervo_alexandria` (`idAcervoAlexandria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoquantidade_material_fk` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`idMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoquantidade_materialtipo_fk` FOREIGN KEY (`idTipoMaterial`) REFERENCES `material_tipo` (`idTipoMaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoquantidade_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `acervoquantitade_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='10 - Quantidade Acervo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acervo_quantidade`
--

LOCK TABLES `acervo_quantidade` WRITE;
/*!40000 ALTER TABLE `acervo_quantidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `acervo_quantidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acessibilidade_arquitetonica`
--

DROP TABLE IF EXISTS `acessibilidade_arquitetonica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acessibilidade_arquitetonica` (
  `idAcessibilidadeArquitetonica` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Total, Parcial ou Nao Acessivel',
  PRIMARY KEY (`idAcessibilidadeArquitetonica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.6 - Acessibilidade Arquitetonica';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acessibilidade_arquitetonica`
--

LOCK TABLES `acessibilidade_arquitetonica` WRITE;
/*!40000 ALTER TABLE `acessibilidade_arquitetonica` DISABLE KEYS */;
/*!40000 ALTER TABLE `acessibilidade_arquitetonica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atendimento_recepcao`
--

DROP TABLE IF EXISTS `atendimento_recepcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atendimento_recepcao` (
  `idAtendimentoRecepcao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `data` date DEFAULT NULL,
  `idUsuario` int(10) unsigned NOT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `idEtnia` int(10) unsigned NOT NULL,
  `idSexo` int(10) unsigned NOT NULL,
  `idEscolaridade` int(10) unsigned NOT NULL,
  `idDeficiencia` int(10) unsigned NOT NULL,
  `idFaixaEtaria` int(10) unsigned NOT NULL,
  `quantidadeUsuarios` int(3) DEFAULT '1',
  PRIMARY KEY (`idAtendimentoRecepcao`),
  KEY `atendimentorecepcao_equipamento_fk_idx` (`idEquipamento`),
  KEY `atendimentorecepcao_usuario_fk_idx` (`idUsuario`),
  KEY `atendimentorecepcao_etnia_fk_idx` (`idEtnia`),
  KEY `atendimentorecepcao_sexo_fk_idx` (`idSexo`),
  KEY `atendimentorecepcao_escolaridade_fk_idx` (`idEscolaridade`),
  KEY `atendimentorecepcao_deficiencia_fk_idx` (`idDeficiencia`),
  KEY `atendimentorecepcao_faixaetaria_fk_idx` (`idFaixaEtaria`),
  KEY `atendimentorecepcao_servidor_fk_idx` (`rfOperador`),
  CONSTRAINT `atendimentorecepcao_deficiencia_fk` FOREIGN KEY (`idDeficiencia`) REFERENCES `deficiencia` (`idDeficiencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_etnia_fk` FOREIGN KEY (`idEtnia`) REFERENCES `etnia` (`idEtnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_faixaetaria_fk` FOREIGN KEY (`idFaixaEtaria`) REFERENCES `faixa_etaria` (`idFaixaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_sexo_fk` FOREIGN KEY (`idSexo`) REFERENCES `sexo` (`idSexo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atendimentorecepcao_usuario_fk` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='08 - Atendimento Recepcao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atendimento_recepcao`
--

LOCK TABLES `atendimento_recepcao` WRITE;
/*!40000 ALTER TABLE `atendimento_recepcao` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimento_recepcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `idCargo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'AA, AGPP/ATA, AA Vigia, Bibliotecario, Outro de Nivel Superior',
  PRIMARY KEY (`idCargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='25 - Cargo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria_etaria`
--

DROP TABLE IF EXISTS `categoria_etaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria_etaria` (
  `idCategoriaEtaria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`idCategoriaEtaria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='38 - Categoria Etaria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_etaria`
--

LOCK TABLES `categoria_etaria` WRITE;
/*!40000 ALTER TABLE `categoria_etaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria_etaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classificacao_area_externa`
--

DROP TABLE IF EXISTS `classificacao_area_externa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classificacao_area_externa` (
  `idClassificacaoAreaExterna` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Pequena, Media ou Grande',
  PRIMARY KEY (`idClassificacaoAreaExterna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.1 - Classificacao Area Externa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classificacao_area_externa`
--

LOCK TABLES `classificacao_area_externa` WRITE;
/*!40000 ALTER TABLE `classificacao_area_externa` DISABLE KEYS */;
/*!40000 ALTER TABLE `classificacao_area_externa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato_uso`
--

DROP TABLE IF EXISTS `contrato_uso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_uso` (
  `idContratoUso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Proprio, Alugado ou Concessao de Uso',
  PRIMARY KEY (`idContratoUso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.2 - Contrato de Uso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_uso`
--

LOCK TABLES `contrato_uso` WRITE;
/*!40000 ALTER TABLE `contrato_uso` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato_uso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controle_acesso`
--

DROP TABLE IF EXISTS `controle_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controle_acesso` (
  `idControleAcesso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(50) CHARACTER SET latin1 NOT NULL,
  `idNivelAcesso` int(10) unsigned NOT NULL,
  `idFuncionalidadesAcesso` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idControleAcesso`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `controleacesso_servidor_fk_idx` (`rfServidor`),
  KEY `controleacesso_nivelacesso_idx` (`idNivelAcesso`),
  KEY `controleacesso_funcionalidadesacesso_fk_idx` (`idFuncionalidadesAcesso`),
  CONSTRAINT `controleacesso_funcionalidadesacesso_fk` FOREIGN KEY (`idFuncionalidadesAcesso`) REFERENCES `funcionalidades_acesso` (`idFuncionalidadesAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `controleacesso_nivelacesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `nivel_acesso` (`idNivelAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `controleacesso_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52 - Controle de Acesso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controle_acesso`
--

LOCK TABLES `controle_acesso` WRITE;
/*!40000 ALTER TABLE `controle_acesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `controle_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custo_evento_igsis`
--

DROP TABLE IF EXISTS `custo_evento_igsis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custo_evento_igsis` (
  `idCustoEventoIgsis` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idProgramacaoCultural` int(10) unsigned NOT NULL,
  `custoEvento` decimal(10,2) DEFAULT NULL,
  `idFormaContratacao` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idCustoEventoIgsis`),
  KEY `custoeventoigsis_equipamento_fk_idx` (`idEquipamento`),
  KEY `custoeventoigsis_programacaocultural_fk_idx` (`idProgramacaoCultural`),
  KEY `custoeventoigsis_formacontratacao_fk_idx` (`idFormaContratacao`),
  CONSTRAINT `custoeventoigsis_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `custoeventoigsis_formacontratacao_fk` FOREIGN KEY (`idFormaContratacao`) REFERENCES `forma_contratacao` (`idFormaContratacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `custoeventoigsis_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='50 - Custo do Evento Importado do Igsis';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custo_evento_igsis`
--

LOCK TABLES `custo_evento_igsis` WRITE;
/*!40000 ALTER TABLE `custo_evento_igsis` DISABLE KEYS */;
/*!40000 ALTER TABLE `custo_evento_igsis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dados_edificacao`
--

DROP TABLE IF EXISTS `dados_edificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dados_edificacao` (
  `idEquipamento` int(10) unsigned NOT NULL,
  `areaInterna` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaAuditorio` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTeatro` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTotalConstruida` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `areaTotalTerreno` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `auditorio` tinyint(1) NOT NULL DEFAULT '0',
  `auditorioNome` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `auditorioCapacidade` int(4) DEFAULT NULL,
  `teatro` tinyint(1) NOT NULL DEFAULT '0',
  `teatroNome` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `teatroCapacidade` int(4) DEFAULT NULL,
  `salaMultiuso` tinyint(1) NOT NULL DEFAULT '0',
  `salaMultiusoCapacidade` int(4) DEFAULT NULL,
  `capacidadeOutros` int(4) DEFAULT NULL,
  `salaEstudoGrupo` tinyint(1) NOT NULL DEFAULT '0',
  `salaEstudoGrupoCapacidade` int(4) DEFAULT NULL,
  `salaEstudoIndividual` tinyint(1) NOT NULL DEFAULT '0',
  `salaEstudoIndividualSalas` int(4) DEFAULT NULL,
  `salaInfantil` tinyint(1) NOT NULL DEFAULT '0',
  `salaInfantilCapacidade` int(4) DEFAULT NULL,
  `estacionamento` tinyint(1) NOT NULL DEFAULT '0',
  `estacionamentoCapacidade` int(4) DEFAULT NULL,
  `situadaPraca` tinyint(1) DEFAULT NULL,
  `idClassificacaoAreaExterna` int(10) unsigned NOT NULL,
  `idContratoUso` int(10) unsigned NOT NULL,
  `idUtilizacao` int(10) unsigned NOT NULL,
  `idPorte` int(10) unsigned NOT NULL,
  `idPadrao` int(10) unsigned NOT NULL,
  `pavimentos` int(2) DEFAULT NULL,
  `idAcessibilidadeArquitetonica` int(10) unsigned NOT NULL,
  `banheirosAdaptados` tinyint(1) DEFAULT '0',
  `rampasAcesso` tinyint(1) DEFAULT '0',
  `elevador` tinyint(1) DEFAULT '0',
  `pisoTatil` tinyint(1) DEFAULT '0',
  `estacionamentoAcessivel` tinyint(1) NOT NULL DEFAULT '0',
  `estacionamentoAcessivelCapacidade` int(4) DEFAULT NULL,
  `segurancaValidade` date DEFAULT NULL,
  `dataInicioReforma` date DEFAULT NULL,
  `dataTerminoReforma` date DEFAULT NULL,
  `descricaoServicos` longtext CHARACTER SET latin1,
  PRIMARY KEY (`idEquipamento`),
  KEY `dadosedificacao_equipamento_fk_idx` (`idEquipamento`),
  KEY `dadosedificacao_classificacaoareaexterna_fk_idx` (`idClassificacaoAreaExterna`),
  KEY `dadosedificacao_contratouso_fk_idx` (`idContratoUso`),
  KEY `dadosedificacao_utilizacao_fk_idx` (`idUtilizacao`),
  KEY `dadosedificacao_porte_fk_idx` (`idPorte`),
  KEY `dadosedificacao_padrao_fk_idx` (`idPadrao`),
  KEY `dadosedificacao_acessibilidadearquitetonica_fk_idx` (`idAcessibilidadeArquitetonica`),
  CONSTRAINT `dadosedificacao_acessibilidadearquitetonica_fk` FOREIGN KEY (`idAcessibilidadeArquitetonica`) REFERENCES `acessibilidade_arquitetonica` (`idAcessibilidadeArquitetonica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_classificacaoareaexterna_fk` FOREIGN KEY (`idClassificacaoAreaExterna`) REFERENCES `classificacao_area_externa` (`idClassificacaoAreaExterna`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_contratouso_fk` FOREIGN KEY (`idContratoUso`) REFERENCES `contrato_uso` (`idContratoUso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_padrao_fk` FOREIGN KEY (`idPadrao`) REFERENCES `padrao` (`idPadrao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_porte_fk` FOREIGN KEY (`idPorte`) REFERENCES `porte` (`idPorte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `dadosedificacao_utilizacao_fk` FOREIGN KEY (`idUtilizacao`) REFERENCES `utilizacao` (`idUtilizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05 - Dados da Edificacao\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dados_edificacao`
--

LOCK TABLES `dados_edificacao` WRITE;
/*!40000 ALTER TABLE `dados_edificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `dados_edificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deficiencia`
--

DROP TABLE IF EXISTS `deficiencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deficiencia` (
  `idDeficiencia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idDeficiencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='40 - Deficiencia';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deficiencia`
--

LOCK TABLES `deficiencia` WRITE;
/*!40000 ALTER TABLE `deficiencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `deficiencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa_categoria`
--

DROP TABLE IF EXISTS `despesa_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa_categoria` (
  `idDespesaCategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idDespesaCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='46 - Categoria da Despesa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa_categoria`
--

LOCK TABLES `despesa_categoria` WRITE;
/*!40000 ALTER TABLE `despesa_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesa_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa_financeira`
--

DROP TABLE IF EXISTS `despesa_financeira`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa_financeira` (
  `idDespesaFinanceira` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idDespesaTipo` int(10) unsigned NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idDespesaFinanceira`),
  KEY `despesafinanceira_equipamento_fk_idx` (`idEquipamento`),
  KEY `despesafinanceira_despesatipo_fk_idx` (`idDespesaTipo`),
  KEY `despesafinanceira_servidor_fk_idx` (`rfOperador`),
  CONSTRAINT `despesafinanceira_despesatipo_fk` FOREIGN KEY (`idDespesaTipo`) REFERENCES `despesa_tipo` (`idDespesaTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `despesafinanceira_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `despesafinanceira_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='20 - Despesa Financeira';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa_financeira`
--

LOCK TABLES `despesa_financeira` WRITE;
/*!40000 ALTER TABLE `despesa_financeira` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesa_financeira` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesa_tipo`
--

DROP TABLE IF EXISTS `despesa_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesa_tipo` (
  `idDespesaTipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` longtext CHARACTER SET latin1 NOT NULL,
  `idDespesaCategoria` int(10) unsigned NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idDespesaTipo`),
  KEY `despesatipo_despesacategoria_fk_idx` (`idDespesaCategoria`),
  CONSTRAINT `despesatipo_despesacategoria_fk` FOREIGN KEY (`idDespesaCategoria`) REFERENCES `despesa_categoria` (`idDespesaCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='47 - Tipo de Despesa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesa_tipo`
--

LOCK TABLES `despesa_tipo` WRITE;
/*!40000 ALTER TABLE `despesa_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesa_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distrito`
--

DROP TABLE IF EXISTS `distrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distrito` (
  `idDistrito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idDistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='31 - Distrito';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distrito`
--

LOCK TABLES `distrito` WRITE;
/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_tipo`
--

DROP TABLE IF EXISTS `documento_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_tipo` (
  `idTipoDocumento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `documento` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='45 - Tipo do Documento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_tipo`
--

LOCK TABLES `documento_tipo` WRITE;
/*!40000 ALTER TABLE `documento_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endereco` (
  `idEndereco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) CHARACTER SET latin1 NOT NULL,
  `titulo` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `preposicao` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `numero` int(6) NOT NULL,
  `complemento` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `cep` char(9) CHARACTER SET latin1 NOT NULL,
  `bairro` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idEndereco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.3 - Endereco';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamento`
--

DROP TABLE IF EXISTS `equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamento` (
  `idEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `idTipoServico` int(10) unsigned NOT NULL,
  `idSigla` int(10) unsigned NOT NULL,
  `idSecretaria` int(10) unsigned NOT NULL,
  `idSubordinacaoAdministrativa` int(10) unsigned NOT NULL,
  `tematica` tinyint(1) NOT NULL,
  `nomeTematica` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `idEndereco` int(10) unsigned NOT NULL,
  `telefone` varchar(15) CHARACTER SET latin1 NOT NULL,
  `idSubPrefeitura` int(10) unsigned NOT NULL,
  `idDistrito` int(10) unsigned NOT NULL,
  `idMacrorregiao` int(10) unsigned NOT NULL,
  `idRegiao` int(10) unsigned NOT NULL,
  `idRegional` int(10) unsigned NOT NULL,
  `idFuncionamento` int(10) unsigned NOT NULL,
  `telecentro` tinyint(1) NOT NULL DEFAULT '0',
  `nucleoBraille` tinyint(1) NOT NULL DEFAULT '0',
  `acervoEspecializado` tinyint(1) NOT NULL DEFAULT '0',
  `idStatusEquipamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idEquipamento`),
  KEY `equipamento_servicotipo_fk_idx` (`idTipoServico`),
  KEY `equipamento_equipamentosigla_fk_idx` (`idSigla`),
  KEY `equipamento_secretaria_fk_idx` (`idSecretaria`),
  KEY `equipamento_subordinacaoadministrativa_fk_idx` (`idSubordinacaoAdministrativa`),
  KEY `equipamento_subprefeitura_fk_idx` (`idSubPrefeitura`),
  KEY `equipamento_distrito_fk_idx` (`idDistrito`),
  KEY `equipamento_macroregiao_fk_idx` (`idMacrorregiao`),
  KEY `equipamento_regiao_idx` (`idRegiao`),
  KEY `equipamento_regional_idx` (`idRegional`),
  KEY `equipamento_funcionamento_idx` (`idFuncionamento`),
  KEY `equipamento_status_fk_idx` (`idStatusEquipamento`),
  KEY `equipamento_endereco_fk_idx` (`idEndereco`),
  CONSTRAINT `equipamento_distrito_fk` FOREIGN KEY (`idDistrito`) REFERENCES `distrito` (`idDistrito`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_endereco_fk` FOREIGN KEY (`idEndereco`) REFERENCES `endereco` (`idEndereco`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_equipamentosigla_fk` FOREIGN KEY (`idSigla`) REFERENCES `equipamento_sigla` (`idSigla`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_funcionamento_fk` FOREIGN KEY (`idFuncionamento`) REFERENCES `funcionamento` (`idFuncionamento`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `equipamento_macroregiao_fk` FOREIGN KEY (`idMacrorregiao`) REFERENCES `macrorregiao` (`idMacrorregiao`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_regiao_fk` FOREIGN KEY (`idRegiao`) REFERENCES `regiao` (`idRegiao`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_regional` FOREIGN KEY (`idRegional`) REFERENCES `regional` (`idRegional`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_secretaria_fk` FOREIGN KEY (`idSecretaria`) REFERENCES `secretaria` (`idSecretaria`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_servicotipo_fk` FOREIGN KEY (`idTipoServico`) REFERENCES `servico_tipo` (`idTipoServico`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_status_fk` FOREIGN KEY (`idStatusEquipamento`) REFERENCES `status_equipamento` (`idStatusEquipamento`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_subordinacaoadministrativa_fk` FOREIGN KEY (`idSubordinacaoAdministrativa`) REFERENCES `subordinacao_administrativa` (`idSubordinacaoAdministrativa`) ON UPDATE CASCADE,
  CONSTRAINT `equipamento_subprefeitura_fk` FOREIGN KEY (`idSubPrefeitura`) REFERENCES `subprefeitura` (`idSubPrefeitura`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01 - Cadastro Equipamento\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamento`
--

LOCK TABLES `equipamento` WRITE;
/*!40000 ALTER TABLE `equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipamento_sigla`
--

DROP TABLE IF EXISTS `equipamento_sigla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipamento_sigla` (
  `idSigla` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `roteiro` longtext CHARACTER SET latin1,
  PRIMARY KEY (`idSigla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='43 - Sigla do Equipamento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipamento_sigla`
--

LOCK TABLES `equipamento_sigla` WRITE;
/*!40000 ALTER TABLE `equipamento_sigla` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipamento_sigla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escolaridade`
--

DROP TABLE IF EXISTS `escolaridade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escolaridade` (
  `idEscolaridade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`idEscolaridade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='35 - Escolaridade';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escolaridade`
--

LOCK TABLES `escolaridade` WRITE;
/*!40000 ALTER TABLE `escolaridade` DISABLE KEYS */;
/*!40000 ALTER TABLE `escolaridade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etnia`
--

DROP TABLE IF EXISTS `etnia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etnia` (
  `idEtnia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idEtnia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='39 - Cor/Raca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etnia`
--

LOCK TABLES `etnia` WRITE;
/*!40000 ALTER TABLE `etnia` DISABLE KEYS */;
/*!40000 ALTER TABLE `etnia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faixa_etaria`
--

DROP TABLE IF EXISTS `faixa_etaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faixa_etaria` (
  `idFaixaEtaria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `inicioFaixaEtaria` int(3) NOT NULL,
  `fimFaixaEtaria` int(3) NOT NULL,
  `dataValidade` date DEFAULT NULL,
  `idCategoriaEtaria` int(10) unsigned NOT NULL,
  `publicado` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`idFaixaEtaria`),
  KEY `faixaetaria_categoriaetaria_fk_idx` (`idCategoriaEtaria`),
  CONSTRAINT `faixaetaria_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='37 - Faixa Etaria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faixa_etaria`
--

LOCK TABLES `faixa_etaria` WRITE;
/*!40000 ALTER TABLE `faixa_etaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `faixa_etaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_contratacao`
--

DROP TABLE IF EXISTS `forma_contratacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_contratacao` (
  `idFormaContratacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idFormaContratacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='24 - Forma de Contratacao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_contratacao`
--

LOCK TABLES `forma_contratacao` WRITE;
/*!40000 ALTER TABLE `forma_contratacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `forma_contratacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcao`
--

DROP TABLE IF EXISTS `funcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcao` (
  `idFuncao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idFuncao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='26 - Funcao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcao`
--

LOCK TABLES `funcao` WRITE;
/*!40000 ALTER TABLE `funcao` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionalidades_acesso`
--

DROP TABLE IF EXISTS `funcionalidades_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionalidades_acesso` (
  `idFuncionalidadesAcesso` int(10) unsigned NOT NULL,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idFuncionalidadesAcesso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52.2 - Funcionalidades de Acesso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionalidades_acesso`
--

LOCK TABLES `funcionalidades_acesso` WRITE;
/*!40000 ALTER TABLE `funcionalidades_acesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionalidades_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionamento`
--

DROP TABLE IF EXISTS `funcionamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funcionamento` (
  `idFuncionamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `segunda` tinyint(1) NOT NULL DEFAULT '0',
  `terca` tinyint(1) NOT NULL DEFAULT '0',
  `quarta` tinyint(1) NOT NULL DEFAULT '0',
  `quinta` tinyint(1) NOT NULL DEFAULT '0',
  `sexta` tinyint(1) NOT NULL DEFAULT '0',
  `sabado` tinyint(1) NOT NULL DEFAULT '0',
  `domingo` tinyint(1) NOT NULL DEFAULT '0',
  `horaInicial` time DEFAULT NULL,
  `horaFinal` time DEFAULT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idFuncionamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.1 - Funcionamento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionamento`
--

LOCK TABLES `funcionamento` WRITE;
/*!40000 ALTER TABLE `funcionamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legislacao`
--

DROP TABLE IF EXISTS `legislacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legislacao` (
  `idLegislacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idLegislacaoTipo` int(10) unsigned NOT NULL,
  `numero` int(5) NOT NULL,
  `ano` int(4) NOT NULL,
  `ementa` longtext CHARACTER SET latin1,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`idLegislacao`),
  KEY `legislacao_legislacaotipo_fk_idx` (`idLegislacaoTipo`),
  CONSTRAINT `legislacao_legislacaotipo_fk` FOREIGN KEY (`idLegislacaoTipo`) REFERENCES `legislacao_tipo` (`idLegislacaoTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='21 - Legislacao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legislacao`
--

LOCK TABLES `legislacao` WRITE;
/*!40000 ALTER TABLE `legislacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `legislacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legislacao_equipamento`
--

DROP TABLE IF EXISTS `legislacao_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legislacao_equipamento` (
  `idLegislacaoEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `idLegislacao` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idLegislacaoEquipamento`),
  KEY `legislacaoequipamento_equipamento_fk_idx` (`idEquipamento`),
  KEY `legislacaoequipamento_legislacao_fk_idx` (`idLegislacao`),
  CONSTRAINT `legislacaoequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `legislacaoequipamento_legislacao_fk` FOREIGN KEY (`idLegislacao`) REFERENCES `legislacao` (`idLegislacao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='04 - Legislacao do Equipamento\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legislacao_equipamento`
--

LOCK TABLES `legislacao_equipamento` WRITE;
/*!40000 ALTER TABLE `legislacao_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `legislacao_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legislacao_tipo`
--

DROP TABLE IF EXISTS `legislacao_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `legislacao_tipo` (
  `idLegislacaoTipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Lei, Decreto ou Portaria',
  PRIMARY KEY (`idLegislacaoTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='21.1 - Tipo Legislacao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legislacao_tipo`
--

LOCK TABLES `legislacao_tipo` WRITE;
/*!40000 ALTER TABLE `legislacao_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `legislacao_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `macrorregiao`
--

DROP TABLE IF EXISTS `macrorregiao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `macrorregiao` (
  `idMacrorregiao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Centro - Noroeste - Norte - Leste 1 - Leste 2 - Leste 3 - Sul 1 - Sul 2, Sudoeste, Sudeste, Leste 4',
  PRIMARY KEY (`idMacrorregiao`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='30 - Macrorregiao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `macrorregiao`
--

LOCK TABLES `macrorregiao` WRITE;
/*!40000 ALTER TABLE `macrorregiao` DISABLE KEYS */;
INSERT INTO `macrorregiao` VALUES (1,'Centro'),(2,'Noroeste'),(3,'Norte'),(4,'Leste 1'),(5,'Leste 2'),(6,'Leste 3'),(7,'Leste 4'),(8,'Sul 1'),(9,'Sul 2'),(10,'Sudoeste'),(11,'Sudeste');
/*!40000 ALTER TABLE `macrorregiao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material` (
  `idMaterial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='41 - Material';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_tipo`
--

DROP TABLE IF EXISTS `material_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `material_tipo` (
  `idTipoMaterial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idTipoMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='42 - Tipo de Material';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_tipo`
--

LOCK TABLES `material_tipo` WRITE;
/*!40000 ALTER TABLE `material_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matricula_importada_alexandria`
--

DROP TABLE IF EXISTS `matricula_importada_alexandria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matricula_importada_alexandria` (
  `idMatriculaImportadaAlexandria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `data` date DEFAULT NULL,
  `qtdMatriculasNovas` int(5) DEFAULT NULL,
  `qtdMatriculasRenovadas` int(5) DEFAULT NULL,
  PRIMARY KEY (`idMatriculaImportadaAlexandria`),
  KEY `matriculaalexandria_equipamento_fk_idx` (`idEquipamento`),
  CONSTRAINT `matriculaalexandria_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='48 - Matricula Importada do Alexandria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matricula_importada_alexandria`
--

LOCK TABLES `matricula_importada_alexandria` WRITE;
/*!40000 ALTER TABLE `matricula_importada_alexandria` DISABLE KEYS */;
/*!40000 ALTER TABLE `matricula_importada_alexandria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_02_07_144747_create_permission_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,1,'Simbi\\User'),(2,2,'Simbi\\User'),(3,3,'Simbi\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_acesso`
--

DROP TABLE IF EXISTS `nivel_acesso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel_acesso` (
  `idNivelAcesso` int(10) unsigned NOT NULL,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idNivelAcesso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='52.1 - Nivel de Acesso';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_acesso`
--

LOCK TABLES `nivel_acesso` WRITE;
/*!40000 ALTER TABLE `nivel_acesso` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivel_acesso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencia_equipamento`
--

DROP TABLE IF EXISTS `ocorrencia_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ocorrencia_equipamento` (
  `idOcorrenciaEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date NOT NULL,
  `ocorrencia` longtext CHARACTER SET latin1 NOT NULL,
  `observacao` longtext CHARACTER SET latin1,
  PRIMARY KEY (`idOcorrenciaEquipamento`),
  KEY `ocorrenciaequipamento_equipamento_fk_idx` (`idEquipamento`),
  CONSTRAINT `ocorrenciaequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='03 - Ocorrencia Equipamento\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencia_equipamento`
--

LOCK TABLES `ocorrencia_equipamento` WRITE;
/*!40000 ALTER TABLE `ocorrencia_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `ocorrencia_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padrao`
--

DROP TABLE IF EXISTS `padrao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `padrao` (
  `idPadrao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Janio Novo ou Janio Antigo',
  PRIMARY KEY (`idPadrao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.5 - Padrao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padrao`
--

LOCK TABLES `padrao` WRITE;
/*!40000 ALTER TABLE `padrao` DISABLE KEYS */;
/*!40000 ALTER TABLE `padrao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Administrador','web','2018-03-02 16:19:05','2018-03-02 16:19:05'),(2,'Coordenador','web','2018-03-02 16:19:44','2018-03-02 16:19:44'),(3,'Funcionario','web','2018-03-02 16:19:52','2018-03-02 16:19:52');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porte`
--

DROP TABLE IF EXISTS `porte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porte` (
  `idPorte` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Grande, Medio ou Pequeno',
  PRIMARY KEY (`idPorte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.4 - Porte';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porte`
--

LOCK TABLES `porte` WRITE;
/*!40000 ALTER TABLE `porte` DISABLE KEYS */;
/*!40000 ALTER TABLE `porte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacao_cultural`
--

DROP TABLE IF EXISTS `programacao_cultural`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacao_cultural` (
  `idProgramacaoCultural` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `idTipoEvento` int(10) unsigned NOT NULL,
  `idFormaContratacao` int(10) unsigned NOT NULL,
  `rfFuncionario` char(9) CHARACTER SET latin1 NOT NULL,
  `nomeAcao` longtext CHARACTER SET latin1,
  `custo` decimal(10,2) DEFAULT NULL,
  `eventoInterno` tinyint(1) DEFAULT '0',
  `idProjetoEspecial` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idProgramacaoCultural`),
  KEY `programacaocultural_equipamento_fk_idx` (`idEquipamento`),
  KEY `programacaocultural_tipoevento_fk_idx` (`idTipoEvento`),
  KEY `programacaocultural_formacontratacao_fk_idx` (`idFormaContratacao`),
  KEY `programacaocultural_projetoespecial_fk_idx` (`idProjetoEspecial`),
  KEY `programacaocultural_servidor_idx` (`rfFuncionario`),
  CONSTRAINT `programacaocultural_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaocultural_formacontratacao_fk` FOREIGN KEY (`idFormaContratacao`) REFERENCES `forma_contratacao` (`idFormaContratacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaocultural_projetoespecial_fk` FOREIGN KEY (`idProjetoEspecial`) REFERENCES `projeto_especial` (`idProjetoEspecial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaocultural_servidor` FOREIGN KEY (`rfFuncionario`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaocultural_tipoevento_fk` FOREIGN KEY (`idTipoEvento`) REFERENCES `tipo_evento` (`idTipoEvento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='13 - Cadastro Programacao Cultural';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacao_cultural`
--

LOCK TABLES `programacao_cultural` WRITE;
/*!40000 ALTER TABLE `programacao_cultural` DISABLE KEYS */;
/*!40000 ALTER TABLE `programacao_cultural` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacao_cultural_data`
--

DROP TABLE IF EXISTS `programacao_cultural_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacao_cultural_data` (
  `idProgramacaoCulturalData` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProgramacaoCultural` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  PRIMARY KEY (`idProgramacaoCulturalData`),
  KEY `programacaoculturaldata_programacaocultural_fk_idx` (`idProgramacaoCultural`),
  CONSTRAINT `programacaoculturaldata_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='14 - Data da Programacao Cultural';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacao_cultural_data`
--

LOCK TABLES `programacao_cultural_data` WRITE;
/*!40000 ALTER TABLE `programacao_cultural_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `programacao_cultural_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacao_cultural_frequencia`
--

DROP TABLE IF EXISTS `programacao_cultural_frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacao_cultural_frequencia` (
  `idProgramacaoCulturalFrequencia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProgramacaoCulturalData` int(10) unsigned NOT NULL,
  `idProgramacaoCultural` int(10) unsigned NOT NULL,
  `idCategoriaEtaria` int(10) unsigned NOT NULL,
  `frequenciaQuantidade` int(3) DEFAULT NULL,
  PRIMARY KEY (`idProgramacaoCulturalFrequencia`),
  KEY `programacaoculturalfrequencia_programacaoculturaldata_fk_idx` (`idProgramacaoCulturalData`),
  KEY `programacaoculturalfrequencia_programacaocultural_fk_idx` (`idProgramacaoCultural`),
  KEY `programacaoculturalfrequencia_categoriaetaria_fk_idx` (`idCategoriaEtaria`),
  CONSTRAINT `programacaoculturalfrequencia_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaoculturalfrequencia_programacaocultural_fk` FOREIGN KEY (`idProgramacaoCultural`) REFERENCES `programacao_cultural` (`idProgramacaoCultural`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `programacaoculturalfrequencia_programacaoculturaldata_fk` FOREIGN KEY (`idProgramacaoCulturalData`) REFERENCES `programacao_cultural_data` (`idProgramacaoCulturalData`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='15 - Frequencia da Programacao Cultural';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacao_cultural_frequencia`
--

LOCK TABLES `programacao_cultural_frequencia` WRITE;
/*!40000 ALTER TABLE `programacao_cultural_frequencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `programacao_cultural_frequencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projeto_especial`
--

DROP TABLE IF EXISTS `projeto_especial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projeto_especial` (
  `idProjetoEspecial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idProjetoEspecial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='22 - Projeto Especial';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projeto_especial`
--

LOCK TABLES `projeto_especial` WRITE;
/*!40000 ALTER TABLE `projeto_especial` DISABLE KEYS */;
/*!40000 ALTER TABLE `projeto_especial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiao`
--

DROP TABLE IF EXISTS `regiao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regiao` (
  `idRegiao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Norte, Sul, Leste, Centro, Oeste',
  PRIMARY KEY (`idRegiao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='28 - Regiao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiao`
--

LOCK TABLES `regiao` WRITE;
/*!40000 ALTER TABLE `regiao` DISABLE KEYS */;
INSERT INTO `regiao` VALUES (1,'Norte'),(2,'Sul'),(3,'Leste'),(4,'Oeste'),(5,'Centro');
/*!40000 ALTER TABLE `regiao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regional`
--

DROP TABLE IF EXISTS `regional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regional` (
  `idRegional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Leste-1, Norte, Sul, Leste-2, Oeste, Centro',
  PRIMARY KEY (`idRegional`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='29 - Regional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regional`
--

LOCK TABLES `regional` WRITE;
/*!40000 ALTER TABLE `regional` DISABLE KEYS */;
INSERT INTO `regional` VALUES (1,'Norte'),(2,'Sul'),(3,'Leste 1'),(4,'Leste 2'),(5,'Oeste'),(6,'Centro');
/*!40000 ALTER TABLE `regional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsavel_equipamento`
--

DROP TABLE IF EXISTS `responsavel_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsavel_equipamento` (
  `idResponsavelEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `rfFuncionario` char(9) CHARACTER SET latin1 NOT NULL,
  `dataInicio` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `idTipoResponsabilidade` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idResponsavelEquipamento`),
  KEY `responsavelequipamento_equipamento_fk_idx` (`idEquipamento`),
  KEY `responsavelequipamento_responsabilidadetipo_fk_idx` (`idTipoResponsabilidade`),
  KEY `responsavelequipamento_servidor_fk_idx` (`rfFuncionario`),
  CONSTRAINT `responsavelequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `responsavelequipamento_responsabilidadetipo_fk` FOREIGN KEY (`idTipoResponsabilidade`) REFERENCES `tipo_responsabilidade` (`idTipoResponsabilidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `responsavelequipamento_servidor_fk` FOREIGN KEY (`rfFuncionario`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='02 - Responsavel pelo Equipamento\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsavel_equipamento`
--

LOCK TABLES `responsavel_equipamento` WRITE;
/*!40000 ALTER TABLE `responsavel_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsavel_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(2,2),(3,1),(3,2),(3,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','web','2018-03-02 16:18:52','2018-03-02 16:18:52'),(2,'Coordenador','web','2018-03-02 16:19:23','2018-03-02 16:19:23'),(3,'Funcionario','web','2018-03-02 16:19:29','2018-03-02 16:19:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretaria`
--

DROP TABLE IF EXISTS `secretaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretaria` (
  `idSecretaria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sigla` varchar(6) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idSecretaria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='33 - Secretaria';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretaria`
--

LOCK TABLES `secretaria` WRITE;
/*!40000 ALTER TABLE `secretaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico_extensao`
--

DROP TABLE IF EXISTS `servico_extensao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico_extensao` (
  `idServicoExtensao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `idCategoriaEtaria` int(10) unsigned NOT NULL,
  `quantidadeAtendimento` int(3) DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `dataAtual` datetime NOT NULL,
  PRIMARY KEY (`idServicoExtensao`),
  KEY `servicoextensao_equipamento_fk_idx` (`idEquipamento`),
  KEY `servicoextensao_categoriaetaria_fk_idx` (`idCategoriaEtaria`),
  KEY `servicoextensao_servidor_idx` (`rfOperador`),
  CONSTRAINT `servicoextensao_categoriaetaria_fk` FOREIGN KEY (`idCategoriaEtaria`) REFERENCES `categoria_etaria` (`idCategoriaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servicoextensao_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servicoextensao_servidor` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='09 - Servico Extensao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico_extensao`
--

LOCK TABLES `servico_extensao` WRITE;
/*!40000 ALTER TABLE `servico_extensao` DISABLE KEYS */;
/*!40000 ALTER TABLE `servico_extensao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico_tipo`
--

DROP TABLE IF EXISTS `servico_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico_tipo` (
  `idTipoServico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'CSMB - Bosque da Leitura, Ponto de Leitura, Onibus Biblioteca, Caixa - Estante, Feira de Troca',
  PRIMARY KEY (`idTipoServico`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='44 - Tipo do Servico';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico_tipo`
--

LOCK TABLES `servico_tipo` WRITE;
/*!40000 ALTER TABLE `servico_tipo` DISABLE KEYS */;
INSERT INTO `servico_tipo` VALUES (1,'Bibliotecas CSMB'),(2,'Bosque da Leitura'),(3,'Ponto de Leitura'),(4,'Ônibus Biblioteca'),(5,'Caixa'),(6,'Estante'),(7,'Feira de Troca');
/*!40000 ALTER TABLE `servico_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidor`
--

DROP TABLE IF EXISTS `servidor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidor` (
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `idCargo` int(10) unsigned NOT NULL,
  `idFuncao` int(10) unsigned NOT NULL,
  `idEscolaridade` int(10) unsigned NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `aposentadoriaMes` int(2) NOT NULL,
  `aposentadoriaAno` int(4) NOT NULL,
  `idSecretaria` int(10) unsigned NOT NULL,
  `idSubordinacaoAdministrativa` int(10) unsigned NOT NULL,
  `publicado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`rfServidor`),
  KEY `servidor_cargo_fk_idx` (`idCargo`),
  KEY `servidor_funcao_fk_idx` (`idFuncao`),
  KEY `servidor_escolaridade_fk_idx` (`idEscolaridade`),
  KEY `servidor_secretaria_fk_idx` (`idSecretaria`),
  KEY `servidor_subordinacaoadministrativa_fk_idx` (`idSubordinacaoAdministrativa`),
  CONSTRAINT `servidor_cargo_fk` FOREIGN KEY (`idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidor_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidor_funcao_fk` FOREIGN KEY (`idFuncao`) REFERENCES `funcao` (`idFuncao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidor_secretaria_fk` FOREIGN KEY (`idSecretaria`) REFERENCES `secretaria` (`idSecretaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidor_subordinacaoadministrativa_fk` FOREIGN KEY (`idSubordinacaoAdministrativa`) REFERENCES `subordinacao_administrativa` (`idSubordinacaoAdministrativa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='16 - Cadastro de Servidor';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidor`
--

LOCK TABLES `servidor` WRITE;
/*!40000 ALTER TABLE `servidor` DISABLE KEYS */;
/*!40000 ALTER TABLE `servidor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidor_convocado`
--

DROP TABLE IF EXISTS `servidor_convocado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidor_convocado` (
  `idServidorConvocado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  `dataReferencia` date DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idServidorConvocado`),
  KEY `servidorconvocado_equipamento_fk_idx` (`idEquipamento`),
  KEY `servidorconvocado_servidor_fk_idx` (`rfServidor`),
  KEY `servidorconvocado_servidoroperador_fk_idx` (`rfOperador`),
  CONSTRAINT `servidorconvocado_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidorconvocado_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidorconvocado_servidoroperador_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='18 - Servidor Convocado';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidor_convocado`
--

LOCK TABLES `servidor_convocado` WRITE;
/*!40000 ALTER TABLE `servidor_convocado` DISABLE KEYS */;
/*!40000 ALTER TABLE `servidor_convocado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidor_lotado_equipamento`
--

DROP TABLE IF EXISTS `servidor_lotado_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidor_lotado_equipamento` (
  `idServidorLotadoEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `rfServidor` char(9) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idServidorLotadoEquipamento`),
  KEY `servidorlotadoequipamento_equipamento_fk_idx` (`idEquipamento`),
  KEY `servidorlotadoequipamento_servidor_fk_idx` (`rfServidor`),
  CONSTRAINT `servidorlotadoequipamento_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servidorlotadoequipamento_servidor_fk` FOREIGN KEY (`rfServidor`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='17 - Servidor Lotado no Equipamento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidor_lotado_equipamento`
--

LOCK TABLES `servidor_lotado_equipamento` WRITE;
/*!40000 ALTER TABLE `servidor_lotado_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `servidor_lotado_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sexo`
--

DROP TABLE IF EXISTS `sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sexo` (
  `idSexo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1) CHARACTER SET latin1 NOT NULL,
  `descricao` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `publicado` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='36 - Sexo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sexo`
--

LOCK TABLES `sexo` WRITE;
/*!40000 ALTER TABLE `sexo` DISABLE KEYS */;
/*!40000 ALTER TABLE `sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_equipamento`
--

DROP TABLE IF EXISTS `status_equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_equipamento` (
  `idStatusEquipamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idStatusEquipamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='01.2 - Status do Equipamento';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_equipamento`
--

LOCK TABLES `status_equipamento` WRITE;
/*!40000 ALTER TABLE `status_equipamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subordinacao_administrativa`
--

DROP TABLE IF EXISTS `subordinacao_administrativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subordinacao_administrativa` (
  `idSubordinacaoAdministrativa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idSubordinacaoAdministrativa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='34 - Subordinacao Administrativa';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subordinacao_administrativa`
--

LOCK TABLES `subordinacao_administrativa` WRITE;
/*!40000 ALTER TABLE `subordinacao_administrativa` DISABLE KEYS */;
INSERT INTO `subordinacao_administrativa` VALUES (1,'CAF'),(2,'CSMB');
/*!40000 ALTER TABLE `subordinacao_administrativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subprefeitura`
--

DROP TABLE IF EXISTS `subprefeitura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subprefeitura` (
  `idSubPrefeitura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idSubPrefeitura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='32 - Subprefeitura';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subprefeitura`
--

LOCK TABLES `subprefeitura` WRITE;
/*!40000 ALTER TABLE `subprefeitura` DISABLE KEYS */;
/*!40000 ALTER TABLE `subprefeitura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terceirizada_quantidade`
--

DROP TABLE IF EXISTS `terceirizada_quantidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terceirizada_quantidade` (
  `idTerceirizadaQuantidade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `idTipoTerceirizada` int(10) unsigned NOT NULL,
  `quantidade` int(3) NOT NULL,
  PRIMARY KEY (`idTerceirizadaQuantidade`),
  KEY `terceirizadaquantidade_equipamento_fk_idx` (`idEquipamento`),
  KEY `terceirizadaquantidade_terceirizadatipo_fk_idx` (`idTipoTerceirizada`),
  CONSTRAINT `terceirizadaquantidade_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `terceirizadaquantidade_terceirizadatipo_fk` FOREIGN KEY (`idTipoTerceirizada`) REFERENCES `terceirizada_tipo` (`idTerceirizadaTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='19 - Quantidade Terceirizada';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terceirizada_quantidade`
--

LOCK TABLES `terceirizada_quantidade` WRITE;
/*!40000 ALTER TABLE `terceirizada_quantidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `terceirizada_quantidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terceirizada_tipo`
--

DROP TABLE IF EXISTS `terceirizada_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terceirizada_tipo` (
  `idTerceirizadaTipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idTerceirizadaTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='27 - Tipo de Terceirizada';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terceirizada_tipo`
--

LOCK TABLES `terceirizada_tipo` WRITE;
/*!40000 ALTER TABLE `terceirizada_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `terceirizada_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_evento`
--

DROP TABLE IF EXISTS `tipo_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_evento` (
  `idTipoEvento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idTipoEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='23 - Tipo do Evento da Programacao Cultural';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_evento`
--

LOCK TABLES `tipo_evento` WRITE;
/*!40000 ALTER TABLE `tipo_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_responsabilidade`
--

DROP TABLE IF EXISTS `tipo_responsabilidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_responsabilidade` (
  `idTipoResponsabilidade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idTipoResponsabilidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='02.1 Tipo de Responsabilidade';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_responsabilidade`
--

LOCK TABLES `tipo_responsabilidade` WRITE;
/*!40000 ALTER TABLE `tipo_responsabilidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_responsabilidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@exemplo.com','$2y$10$zGaLJXEq9WnpbpGXsmQbpOy/AWGxoSVk50sy2VfuGLvudq6rXc77m','1Af3zxid9amowcnaQB23vC6HFlgcLc2bvCjmipWmRf1prHPzUzalEZhLJFfN','2018-03-02 16:09:26','2018-03-02 16:09:26',1),(2,'Coordenador','coord@exemplo.com','$2y$10$1OjQ93gp9re3a0epbbwsxuw69w43LrReCa0YJQi3HSymq8AL4olA.','UfMpZsDJRlCJI7E7kWln9orYJ3ttnjHH27xL5UAAOU8TYiFdCo5k9dk4gaic','2018-03-02 16:09:57','2018-03-02 16:09:57',1),(3,'Funcionario','func@exemplo.com','$2y$10$xWyJfL32vB57NsL3ikRDd.G.yUq4nrGX13K2pz25vDnZmSwT1BUdS','FDvx92mNgnLuMMoSttKQYXctrzphIqqD06ah8RD0kursb83jyNqAgFnFBTl0','2018-03-02 16:10:17','2018-03-02 16:10:17',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `matriculaAlexandria` int(11) DEFAULT NULL,
  `idTipoDocumento` int(10) unsigned NOT NULL,
  `nome` varchar(150) CHARACTER SET latin1 NOT NULL,
  `nomeSocial` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `idSexo` int(10) unsigned NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `idEscolaridade` int(10) unsigned NOT NULL,
  `idEtnia` int(10) unsigned NOT NULL,
  `idDeficiencia` int(10) unsigned NOT NULL,
  `idFaixaEtaria` int(10) unsigned NOT NULL,
  `dataAtual` datetime DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `usuario_tipodocumento_fk_idx` (`idTipoDocumento`),
  KEY `usuario_sexo_fk_idx` (`idSexo`),
  KEY `usuario_escolaridade_fk_idx` (`idEscolaridade`),
  KEY `usuario_etnia_idx` (`idEtnia`),
  KEY `usuario_deficiencia_fk_idx` (`idDeficiencia`),
  KEY `usuario_faixaetaria_fk_idx` (`idFaixaEtaria`),
  KEY `usuario_servidor_fk_idx` (`rfOperador`),
  CONSTRAINT `usuario_deficiencia_fk` FOREIGN KEY (`idDeficiencia`) REFERENCES `deficiencia` (`idDeficiencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_documentotipo_fk` FOREIGN KEY (`idTipoDocumento`) REFERENCES `documento_tipo` (`idTipoDocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_escolaridade_fk` FOREIGN KEY (`idEscolaridade`) REFERENCES `escolaridade` (`idEscolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_etnia` FOREIGN KEY (`idEtnia`) REFERENCES `etnia` (`idEtnia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_faixaetaria_fk` FOREIGN KEY (`idFaixaEtaria`) REFERENCES `faixa_etaria` (`idFaixaEtaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_sexo_fk` FOREIGN KEY (`idSexo`) REFERENCES `sexo` (`idSexo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='06 - Cadastro Usuario\n1FN';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_servico`
--

DROP TABLE IF EXISTS `usuario_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_servico` (
  `idUsuarioServico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idEquipamento` int(10) unsigned NOT NULL,
  `data` date DEFAULT NULL,
  `rfOperador` char(9) CHARACTER SET latin1 NOT NULL,
  `diasAbertos` int(2) DEFAULT NULL,
  `idMatriculaImportadaAlexandria` int(10) unsigned NOT NULL,
  `servicoEspecial` tinyint(1) DEFAULT '0',
  `publicoTelecentros` int(5) DEFAULT NULL,
  `publicoSecaoTematica` int(5) DEFAULT NULL,
  `publicoSecaoBraile` int(5) DEFAULT NULL,
  PRIMARY KEY (`idUsuarioServico`),
  KEY `usuarioservico_equipamento_fk_idx` (`idEquipamento`),
  KEY `usuarioservico_matriculaalexandria_fk_idx` (`idMatriculaImportadaAlexandria`),
  KEY `usuarioservico_servidor_fk_idx` (`rfOperador`),
  CONSTRAINT `usuarioservico_equipamento_fk` FOREIGN KEY (`idEquipamento`) REFERENCES `equipamento` (`idEquipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarioservico_matriculaalexandria_fk` FOREIGN KEY (`idMatriculaImportadaAlexandria`) REFERENCES `matricula_importada_alexandria` (`idMatriculaImportadaAlexandria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuarioservico_servidor_fk` FOREIGN KEY (`rfOperador`) REFERENCES `servidor` (`rfServidor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='07 - Servico Usuario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_servico`
--

LOCK TABLES `usuario_servico` WRITE;
/*!40000 ALTER TABLE `usuario_servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilizacao`
--

DROP TABLE IF EXISTS `utilizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilizacao` (
  `idUtilizacao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Total ou Parcial',
  PRIMARY KEY (`idUtilizacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='05.3 - Utilizacao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilizacao`
--

LOCK TABLES `utilizacao` WRITE;
/*!40000 ALTER TABLE `utilizacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilizacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-09 12:29:43
