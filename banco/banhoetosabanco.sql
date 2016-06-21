-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.6.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para dbbanhotosa
CREATE DATABASE IF NOT EXISTS `dbbanhotosa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `dbbanhotosa`;


-- Copiando estrutura para tabela dbbanhotosa.tbagendamento
CREATE TABLE IF NOT EXISTS `tbagendamento` (
  `cdAgendamento` int(11) NOT NULL AUTO_INCREMENT,
  `cdUsuario` int(11) NOT NULL,
  `cdSituacao` int(11) NOT NULL,
  `cdAnimal` int(11) NOT NULL,
  `hrInicial` time NOT NULL,
  `hrFinal` time NOT NULL,
  `dtAgendamento` date NOT NULL,
  PRIMARY KEY (`cdAgendamento`),
  KEY `fk_agendamento_usuario` (`cdUsuario`),
  KEY `fk_agendamento_animal` (`cdAnimal`),
  KEY `fk_agendamento_situacao` (`cdSituacao`),
  CONSTRAINT `fk_agendamento_animal` FOREIGN KEY (`cdAnimal`) REFERENCES `tbanimal` (`cdAnimal`),
  CONSTRAINT `fk_agendamento_usuario` FOREIGN KEY (`cdUsuario`) REFERENCES `tbusuario` (`cdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbagendamento: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tbagendamento` DISABLE KEYS */;
INSERT INTO `tbagendamento` (`cdAgendamento`, `cdUsuario`, `cdSituacao`, `cdAnimal`, `hrInicial`, `hrFinal`, `dtAgendamento`) VALUES
	(1, 1, 3, 1, '12:00:00', '04:00:00', '2016-06-10'),
	(2, 1, 2, 1, '11:00:00', '10:00:00', '2016-06-02'),
	(3, 1, 1, 1, '10:00:00', '11:00:00', '2016-06-01');
/*!40000 ALTER TABLE `tbagendamento` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbanimal
CREATE TABLE IF NOT EXISTS `tbanimal` (
  `cdAnimal` int(11) NOT NULL AUTO_INCREMENT,
  `dsNome` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `dsRaca` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `nrIdade` int(2) NOT NULL DEFAULT '0',
  `cdPorte` int(11) NOT NULL DEFAULT '0',
  `cdUsuario` int(11) NOT NULL,
  PRIMARY KEY (`cdAnimal`),
  KEY `fk_animal_usuario` (`cdUsuario`),
  KEY `fk_animal_porte` (`cdPorte`),
  CONSTRAINT `fk_animal_porte` FOREIGN KEY (`cdPorte`) REFERENCES `tbporte` (`cdPorte`),
  CONSTRAINT `fk_animal_usuario` FOREIGN KEY (`cdUsuario`) REFERENCES `tbusuario` (`cdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbanimal: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tbanimal` DISABLE KEYS */;
INSERT INTO `tbanimal` (`cdAnimal`, `dsNome`, `dsRaca`, `nrIdade`, `cdPorte`, `cdUsuario`) VALUES
	(1, 'Toto', 'Pitbull', 4, 3, 1),
	(8, 'teste', 'teste', 12, 2, 1);
/*!40000 ALTER TABLE `tbanimal` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbperfil
CREATE TABLE IF NOT EXISTS `tbperfil` (
  `cdPerfil` int(1) NOT NULL,
  `dsPerfil` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cdPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbperfil: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tbperfil` DISABLE KEYS */;
INSERT INTO `tbperfil` (`cdPerfil`, `dsPerfil`) VALUES
	(1, 'Cliente'),
	(2, 'Atendente'),
	(3, 'Administrador');
/*!40000 ALTER TABLE `tbperfil` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbporte
CREATE TABLE IF NOT EXISTS `tbporte` (
  `cdPorte` int(11) NOT NULL AUTO_INCREMENT,
  `dsPorte` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cdPorte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbporte: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tbporte` DISABLE KEYS */;
INSERT INTO `tbporte` (`cdPorte`, `dsPorte`) VALUES
	(1, 'Grande'),
	(2, 'Medio'),
	(3, 'Pequeno');
/*!40000 ALTER TABLE `tbporte` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbsituacao
CREATE TABLE IF NOT EXISTS `tbsituacao` (
  `cdSituacao` int(11) NOT NULL AUTO_INCREMENT,
  `dsSituacao` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cdSituacao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbsituacao: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tbsituacao` DISABLE KEYS */;
INSERT INTO `tbsituacao` (`cdSituacao`, `dsSituacao`) VALUES
	(1, 'Em Analise'),
	(2, 'Reprovado'),
	(3, 'Aprovado');
/*!40000 ALTER TABLE `tbsituacao` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbtipopagamento
CREATE TABLE IF NOT EXISTS `tbtipopagamento` (
  `cdPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `dsPagamento` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`cdPagamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbtipopagamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbtipopagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbtipopagamento` ENABLE KEYS */;


-- Copiando estrutura para tabela dbbanhotosa.tbusuario
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `cdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `dsLogin` varchar(50) COLLATE utf8_bin NOT NULL,
  `dsSenha` varchar(20) COLLATE utf8_bin NOT NULL,
  `dsEmail` varchar(50) COLLATE utf8_bin NOT NULL,
  `nrCpf` varchar(50) COLLATE utf8_bin NOT NULL,
  `dsNome` varchar(50) COLLATE utf8_bin NOT NULL,
  `dsSobrenome` varchar(50) COLLATE utf8_bin NOT NULL,
  `nrTelefone` varchar(11) COLLATE utf8_bin NOT NULL,
  `cdPerfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`cdUsuario`),
  KEY `fk_tbusuario_tbporte` (`cdPerfil`),
  CONSTRAINT `fk_tbusuario_tbporte` FOREIGN KEY (`cdPerfil`) REFERENCES `tbperfil` (`cdPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela dbbanhotosa.tbusuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `tbusuario` DISABLE KEYS */;
INSERT INTO `tbusuario` (`cdUsuario`, `dsLogin`, `dsSenha`, `dsEmail`, `nrCpf`, `dsNome`, `dsSobrenome`, `nrTelefone`, `cdPerfil`) VALUES
	(1, 'admin', 'admin', 'kelvinott3112@gmail.com', '09303566912', 'kelvin', 'ott', '33873429', 2);
/*!40000 ALTER TABLE `tbusuario` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
