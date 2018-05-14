-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.31-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela dbsimbi.macrorregiao
CREATE TABLE IF NOT EXISTS `macrorregiao` (
  `idMacrorregiao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Centro - Noroeste - Norte - Leste 1 - Leste 2 - Leste 3 - Sul 1 - Sul 2, Sudoeste, Sudeste, Leste 4',
  PRIMARY KEY (`idMacrorregiao`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='30 - Macrorregiao';

-- Copiando dados para a tabela dbsimbi.macrorregiao: ~11 rows (aproximadamente)
DELETE FROM `macrorregiao`;
/*!40000 ALTER TABLE `macrorregiao` DISABLE KEYS */;
INSERT INTO `macrorregiao` (`idMacrorregiao`, `descricao`) VALUES
	(1, 'Centro'),
	(2, 'Noroeste'),
	(3, 'Norte'),
	(4, 'Leste 1'),
	(5, 'Leste 2'),
	(6, 'Leste 3'),
	(7, 'Leste 4'),
	(8, 'Sul 1'),
	(9, 'Sul 2'),
	(10, 'Sudoeste'),
	(11, 'Sudeste');
/*!40000 ALTER TABLE `macrorregiao` ENABLE KEYS */;

-- Copiando estrutura para tabela dbsimbi.regiao
CREATE TABLE IF NOT EXISTS `regiao` (
  `idRegiao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Norte, Sul, Leste, Centro, Oeste',
  PRIMARY KEY (`idRegiao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='28 - Regiao';

-- Copiando dados para a tabela dbsimbi.regiao: ~5 rows (aproximadamente)
DELETE FROM `regiao`;
/*!40000 ALTER TABLE `regiao` DISABLE KEYS */;
INSERT INTO `regiao` (`idRegiao`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste'),
	(4, 'Oeste'),
	(5, 'Centro');
/*!40000 ALTER TABLE `regiao` ENABLE KEYS */;

-- Copiando estrutura para tabela dbsimbi.regional
CREATE TABLE IF NOT EXISTS `regional` (
  `idRegional` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'Leste-1, Norte, Sul, Leste-2, Oeste, Centro',
  PRIMARY KEY (`idRegional`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='29 - Regional';

-- Copiando dados para a tabela dbsimbi.regional: ~6 rows (aproximadamente)
DELETE FROM `regional`;
/*!40000 ALTER TABLE `regional` DISABLE KEYS */;
INSERT INTO `regional` (`idRegional`, `descricao`) VALUES
	(1, 'Norte'),
	(2, 'Sul'),
	(3, 'Leste 1'),
	(4, 'Leste 2'),
	(5, 'Oeste'),
	(6, 'Centro');
/*!40000 ALTER TABLE `regional` ENABLE KEYS */;

-- Copiando estrutura para tabela dbsimbi.servico_tipo
CREATE TABLE IF NOT EXISTS `servico_tipo` (
  `idTipoServico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT 'CSMB - Bosque da Leitura, Ponto de Leitura, Onibus Biblioteca, Caixa - Estante, Feira de Troca',
  PRIMARY KEY (`idTipoServico`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='44 - Tipo do Servico';

-- Copiando dados para a tabela dbsimbi.servico_tipo: ~7 rows (aproximadamente)
DELETE FROM `servico_tipo`;
/*!40000 ALTER TABLE `servico_tipo` DISABLE KEYS */;
INSERT INTO `servico_tipo` (`idTipoServico`, `descricao`) VALUES
	(1, 'Bibliotecas CSMB'),
	(2, 'Bosque da Leitura'),
	(3, 'Ponto de Leitura'),
	(4, 'Ônibus Biblioteca'),
	(5, 'Caixa'),
	(6, 'Estante'),
	(7, 'Feira de Troca');
/*!40000 ALTER TABLE `servico_tipo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
