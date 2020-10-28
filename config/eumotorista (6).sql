-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 16-Out-2018 às 10:24
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eumotorista`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT 'none',
  `username` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(150) NOT NULL DEFAULT '123',
  `birthDate` date NOT NULL DEFAULT '1900-01-01',
  `description` varchar(45) NOT NULL DEFAULT 'Estou aprendendo com o EuMotorista',
  `avatar_avatarId` int(11) NOT NULL DEFAULT '1',
  `theme` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `avatar_avatarId` (`avatar_avatarId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `account`
--

INSERT INTO `account` (`id`, `name`, `username`, `email`, `password`, `birthDate`, `description`, `avatar_avatarId`, `theme`) VALUES
(1, 'administrator', 'admin', 'admin@eumotorista.com', '123', '0000-00-00', 'Administrador padrão do EuMotorista', 1, NULL),
(2, 'Guilherme Neubaner', 'guiwortis', 'gui@hotmail.com', '123', '2000-09-03', 'Estou aprendendo com o EuMotorista', 1, 1),
(3, 'Ymir Fritz', 'Ymir', 'fritz.ymir@hotmail.com', '123', '1994-07-12', 'Estou aprendendo com o EuMotorista', 1, 1),
(12, 'Jackson Ramalho', 'Goku', 'jack-ten@hotmail.com', '123', '1998-02-12', 'Estou aprendendo com o EuMotorista', 1, 1),
(16, 'you', 'jackao', 'ramalho@hotmail.com', '123', '2018-10-05', 'Estou aprendendo com o EuMotorista', 1, 2),
(17, 'Irani', 'Nini', 'irani-3@hotmail.com', '123', '2018-10-04', 'Estou aprendendo com o EuMotorista', 1, 1),
(18, 'Jackson', 'GATSU', 'berserk@hotmail.com', '123', '1996-02-07', 'Estou aprendendo com o EuMotorista', 1, 2),
(19, 'Jackson', 'Guts', 'berserker@hotmail.com', '321', '2018-10-06', 'Estou aprendendo com o EuMotorista', 1, NULL),
(20, 'Jackson', 'GATSU2', 'jack-2ten@hotmail.com', '321', '2018-10-01', 'Estou aprendendo com o EuMotorista', 1, 2);

--
-- Acionadores `account`
--
DROP TRIGGER IF EXISTS `dropAccount`;
DELIMITER $$
CREATE TRIGGER `dropAccount` BEFORE DELETE ON `account` FOR EACH ROW delete from scoretable where account_id = OLD.id
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `newScoreTable`;
DELIMITER $$
CREATE TRIGGER `newScoreTable` AFTER INSERT ON `account` FOR EACH ROW BEGIN
		declare i int default 2;
        declare maxSubject INT;
        set maxSubject = (select max(subjectId) from `subject` LIMIT 1);
        WHILE i <= maxSubject do
			IF (SELECT EXISTS(select * from `subject` where subjectId=i)) THEN
				insert into scoretable (account_id,subject_subjectId,score) values(new.id,i,0);
			END IF;
            SET i = i+1;
		END WHILE;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `account_id` int(11) NOT NULL,
  `adminLevel` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`account_id`, `adminLevel`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avatar`
--

DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
  `avatarId` int(11) NOT NULL AUTO_INCREMENT,
  `avatarFilePath` varchar(45) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`avatarId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avatar`
--

INSERT INTO `avatar` (`avatarId`, `avatarFilePath`, `description`) VALUES
(1, NULL, 'default avatar id');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `exerciseId` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL DEFAULT '0000-00-00',
  `subject_subjectId` int(11) NOT NULL DEFAULT '1',
  `exerciseTitle` varchar(45) NOT NULL DEFAULT 'Novo exercício',
  `experienceProvided` int(11) NOT NULL DEFAULT '0',
  `admin_account_id` int(11) NOT NULL DEFAULT '1',
  `correctAnswer` tinyint(4) NOT NULL DEFAULT '1',
  `exercisePath` varchar(45) DEFAULT NULL,
  `description` varchar(45) NOT NULL DEFAULT 'exercise',
  PRIMARY KEY (`exerciseId`),
  KEY `admin_account_id` (`admin_account_id`),
  KEY `subject_subjectId` (`subject_subjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `exercise`
--

INSERT INTO `exercise` (`exerciseId`, `creationDate`, `subject_subjectId`, `exerciseTitle`, `experienceProvided`, `admin_account_id`, `correctAnswer`, `exercisePath`, `description`) VALUES
(1, '2018-10-11', 2, 'Placas de Sinalização', 10, 1, 3, './content/2/exercise/2_1/2_1.json', ''),
(2, '2018-10-11', 2, 'Placas de Sinalização', 10, 1, 3, NULL, ''),
(3, '2018-10-11', 2, 'Placas de Sinalização', 10, 1, 2, './content/2/exercise/2_3/2_3.json', ''),
(4, '2018-10-12', 4, 'Teste', 20, 1, 2, './content/4/exercise/4_4/4_4.json', 'nop');

-- --------------------------------------------------------

--
-- Estrutura da tabela `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `schoolId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `creationDate` date DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`schoolId`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `school`
--

INSERT INTO `school` (`schoolId`, `name`, `creationDate`, `description`) VALUES
(1, 'EuMotorista', '2018-09-22', 'Curso padrao EuMotorista');

-- --------------------------------------------------------

--
-- Estrutura da tabela `scoretable`
--

DROP TABLE IF EXISTS `scoretable`;
CREATE TABLE IF NOT EXISTS `scoretable` (
  `account_id` int(11) NOT NULL,
  `subject_subjectId` int(11) NOT NULL DEFAULT '1',
  `score` int(11) NOT NULL DEFAULT '0',
  KEY `account_id` (`account_id`),
  KEY `subject_subjectId` (`subject_subjectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `scoretable`
--

INSERT INTO `scoretable` (`account_id`, `subject_subjectId`, `score`) VALUES
(2, 1, 0),
(3, 1, 0),
(12, 1, 0),
(16, 1, 0),
(2, 2, 0),
(3, 2, 0),
(12, 2, 0),
(16, 2, 0),
(2, 3, 0),
(3, 3, 0),
(12, 3, 0),
(16, 3, 0),
(2, 4, 0),
(3, 4, 0),
(12, 4, 0),
(16, 4, 0),
(17, 2, 0),
(17, 3, 0),
(17, 4, 0),
(18, 2, 0),
(18, 3, 0),
(18, 4, 0),
(19, 2, 0),
(19, 3, 0),
(19, 4, 0),
(20, 2, 0),
(20, 3, 0),
(20, 4, 0),
(1, 2, 45),
(1, 2, 45),
(2, 2, 20),
(12, 2, 10),
(12, 2, 40),
(12, 2, 10),
(12, 2, 10),
(12, 2, 50),
(12, 2, 50),
(12, 2, 120),
(12, 2, 10),
(12, 2, 10),
(12, 2, 40),
(12, 2, 50),
(12, 2, 50),
(12, 2, 170),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 10),
(12, 2, 40),
(12, 2, 90),
(12, 2, 10),
(12, 2, 40);

-- --------------------------------------------------------

--
-- Estrutura da tabela `studymaterial`
--

DROP TABLE IF EXISTS `studymaterial`;
CREATE TABLE IF NOT EXISTS `studymaterial` (
  `studymaterialId` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` date NOT NULL DEFAULT '0000-00-00',
  `subject_subjectId` int(11) NOT NULL DEFAULT '1',
  `studymaterialTitle` varchar(45) NOT NULL DEFAULT 'Novo material de estudo',
  `admin_account_id` int(11) NOT NULL DEFAULT '1',
  `studymaterialPath` varchar(45) DEFAULT NULL,
  `description` varchar(45) NOT NULL DEFAULT 'study material',
  PRIMARY KEY (`studymaterialId`),
  KEY `admin_account_id` (`admin_account_id`),
  KEY `subject_subjectId` (`subject_subjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `studymaterial`
--

INSERT INTO `studymaterial` (`studymaterialId`, `creationDate`, `subject_subjectId`, `studymaterialTitle`, `admin_account_id`, `studymaterialPath`, `description`) VALUES
(1, '0000-00-00', 1, 'default', 1, NULL, 'this is the default studymaterial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subjectId` int(11) NOT NULL AUTO_INCREMENT,
  `school_schoolId` int(11) NOT NULL DEFAULT '1',
  `subjectName` varchar(45) NOT NULL DEFAULT 'newSubject',
  `creationDate` date NOT NULL DEFAULT '1001-01-01',
  `admin_account_id` int(11) NOT NULL DEFAULT '1',
  `description` varchar(45) NOT NULL DEFAULT 'Novo módulo do EuMotorista',
  `introduction` varchar(3000) DEFAULT 'Confira os temas da atividade a ser trabalhada e comece quando estiver pronto',
  PRIMARY KEY (`subjectId`),
  KEY `school_schoolId` (`school_schoolId`),
  KEY `admin_account_id` (`admin_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subject`
--

INSERT INTO `subject` (`subjectId`, `school_schoolId`, `subjectName`, `creationDate`, `admin_account_id`, `description`, `introduction`) VALUES
(1, 1, 'none', '1001-01-01', 1, 'default subject(DO NOT REMOVE IT!)', 'Observe o conteúdo do módulo a ser trabalhado e comece quando quiser'),
(2, 1, 'Sinalização', '2018-09-22', 1, 'Módulo de sinalização', 'Observe o conteúdo do módulo a ser trabalhado e comece quando quiser'),
(3, 1, 'Segurança', '2018-09-22', 1, 'Módulo de segurança', 'Observe o conteúdo do módulo a ser trabalhado e comece quando quiser'),
(4, 1, 'Direção defensiva', '2018-09-23', 1, 'Módulo de direção segura', 'Observe o conteúdo do módulo a ser trabalhado e comece quando quiser');

--
-- Acionadores `subject`
--
DROP TRIGGER IF EXISTS `dropSubject`;
DELIMITER $$
CREATE TRIGGER `dropSubject` BEFORE DELETE ON `subject` FOR EACH ROW delete from scoretable where subject_subjectId = old.subjectId
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `newScoreTableBySubject`;
DELIMITER $$
CREATE TRIGGER `newScoreTableBySubject` AFTER INSERT ON `subject` FOR EACH ROW BEGIN
		declare i int default 2;
        declare maxAccount INT;
        set maxAccount = (select max(id) from `account` LIMIT 1);
        WHILE i <= maxAccount do
			IF (SELECT EXISTS(select * from `account` where id=i)) THEN
				insert into scoretable (account_id,subject_subjectId,score) values(i,new.subjectId,0);
			END IF;
            SET i = i+1;
		END WHILE;
	END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`avatar_avatarId`) REFERENCES `avatar` (`avatarId`);

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`admin_account_id`) REFERENCES `admin` (`account_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exercise_ibfk_2` FOREIGN KEY (`subject_subjectId`) REFERENCES `subject` (`subjectId`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `scoretable`
--
ALTER TABLE `scoretable`
  ADD CONSTRAINT `scoretable_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `scoretable_ibfk_2` FOREIGN KEY (`subject_subjectId`) REFERENCES `subject` (`subjectId`);

--
-- Limitadores para a tabela `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`school_schoolId`) REFERENCES `school` (`schoolId`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`admin_account_id`) REFERENCES `admin` (`account_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
