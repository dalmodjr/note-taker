-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela notetaker.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioid` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cor` varchar(6) DEFAULT NULL,
  `posicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkcategoriausuarioid` (`usuarioid`),
  CONSTRAINT `fkcategoriausuarioid` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela notetaker.nota
CREATE TABLE IF NOT EXISTS `nota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioid` int(11) NOT NULL DEFAULT 0,
  `titulo` varchar(255) NOT NULL DEFAULT '0',
  `texto` text NOT NULL,
  `urlimagem` varchar(255) NOT NULL DEFAULT '0',
  `cor` varchar(6) NOT NULL DEFAULT '0',
  `arquivada` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fknotausuarioid` (`usuarioid`),
  CONSTRAINT `fknotausuarioid` FOREIGN KEY (`usuarioid`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela notetaker.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
