CREATE DATABASE IF NOT EXISTS dbtestebanho /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE dbtestebanho;

-- Copiando estrutura para tabela dbbanhotosa.tbusuario
CREATE TABLE IF NOT EXISTS tbusuario (
  cdUsuario int(11) NOT NULL AUTO_INCREMENT,
  dsLogin varchar(50) COLLATE utf8_bin NOT NULL,
  dsSenha varchar(20) COLLATE utf8_bin NOT NULL,
  dsEmail varchar(50) COLLATE utf8_bin NOT NULL,
  nrCpf varchar(50) COLLATE utf8_bin NOT NULL,
  dsNome varchar(50) COLLATE utf8_bin NOT NULL,
  dsSobrenome varchar(50) COLLATE utf8_bin NOT NULL,
  nrTelefone varchar(11) COLLATE utf8_bin NOT NULL,
  cdPerfil int(11) DEFAULT NULL,
  PRIMARY KEY (cdUsuario),
  KEY fk_tbusuario_tbporte (cdPerfil),
  CONSTRAINT fk_tbusuario_tbporte FOREIGN KEY (cdPerfil) REFERENCES tbperfil (cdPerfil)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS tbperfil (
  cdPerfil int(1) NOT NULL,
  dsPerfil varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (cdPerfil)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS tbporte (
  cdPorte int(11) NOT NULL AUTO_INCREMENT,
  dsPorte varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (cdPorte)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando estrutura para tabela dbbanhotosa.tbtipopagamento
CREATE TABLE IF NOT EXISTS tbtipopagamento (
  cdPagamento int(11) NOT NULL AUTO_INCREMENT,
  dsPagamento varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (cdPagamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS tbsituacao (
  cdSituacao int(11) NOT NULL AUTO_INCREMENT,
  dsSituacao varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (cdSituacao)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS tbanimal (
  cdAnimal int(11) NOT NULL AUTO_INCREMENT,
  dsNome varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  dsRaca varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  nrIdade int(2) NOT NULL DEFAULT '0',
  cdPorte int(11) NOT NULL DEFAULT '0',
  cdUsuario int(11) NOT NULL,
  PRIMARY KEY (cdAnimal),
  KEY fk_animal_usuario (cdUsuario),
  KEY fk_animal_porte (cdPorte),
  CONSTRAINT fk_animal_porte FOREIGN KEY (cdPorte) REFERENCES tbporte (cdPorte),
  CONSTRAINT fk_animal_usuario FOREIGN KEY (cdUsuario) REFERENCES tbusuario (cdUsuario)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS tbagendamento (
  cdAgendamento int(11) NOT NULL AUTO_INCREMENT,
  cdUsuario int(11) NOT NULL,
  cdSituacao int(11) NOT NULL,
  cdAnimal int(11) NOT NULL,
  hrInicial time NOT NULL,
  hrFinal time NOT NULL,
  dtAgendamento date NOT NULL,
  PRIMARY KEY (cdAgendamento),
  KEY fk_agendamento_usuario (cdUsuario),
  KEY fk_agendamento_animal (cdAnimal),
  KEY fk_agendamento_situacao (cdSituacao),
  CONSTRAINT fk_agendamento_animal FOREIGN KEY (cdAnimal) REFERENCES tbanimal (cdAnimal),
  CONSTRAINT fk_agendamento_usuario FOREIGN KEY (cdUsuario) REFERENCES tbusuario (cdUsuario)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;






