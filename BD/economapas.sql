-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.23 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para economapas
CREATE DATABASE IF NOT EXISTS `economapas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `economapas`;

-- Copiando estrutura para tabela economapas.cidades
CREATE TABLE IF NOT EXISTS `cidades` (
  `id_cidade` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uf` varchar(3) NOT NULL,
  `capital` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela economapas.cidades: ~27 rows (aproximadamente)
DELETE FROM `cidades`;
/*!40000 ALTER TABLE `cidades` DISABLE KEYS */;
INSERT INTO `cidades` (`id_cidade`, `estado`, `uf`, `capital`) VALUES
	(1, 'Acre', 'AC', 'Rio Branco'),
	(2, 'Alagoas', 'AL', 'Maceió'),
	(3, 'Amazonas', 'AM', 'Manaus'),
	(4, 'Amapá', 'AP', 'Macapá'),
	(5, 'Bahia', 'BA', 'Salvador'),
	(6, 'Ceará', 'CE', 'Fortaleza'),
	(7, 'Distrito Federal', 'DF', 'Brasília'),
	(8, 'Espírito Santo', 'ES', 'Vitória'),
	(9, 'Goiás', 'GO', 'Goiânia'),
	(10, 'Maranhão', 'MA', 'São Luís'),
	(11, 'Minas Gerais', 'MG', 'Belo Horizonte'),
	(12, 'Mato Grosso do Sul', 'MS', 'Campo Grande'),
	(13, 'Mato Grosso', 'MT', 'Cuiabá'),
	(14, 'Pará', 'PA', 'Belém'),
	(15, 'Paraíba', 'PB', 'João Pessoa'),
	(16, 'Pernambuco', 'PE', 'Recife'),
	(17, 'Piauí', 'PI', 'Teresina'),
	(18, 'Paraná', 'PR', 'Curitiba'),
	(19, 'Rio de Janeiro', 'RJ', 'Rio de Janeiro'),
	(20, 'Rio Grande do Norte', 'RN', 'Natal'),
	(21, 'Rondônia', 'RO', 'Porto Velho'),
	(22, 'Roraima', 'RR', 'Boa Vista'),
	(23, 'Rio Grande do Sul', 'RS', 'Porto Alegre'),
	(24, 'Santa Catarina', 'SC', 'Florianópolis'),
	(25, 'Sergipe', 'SE', 'Aracaju'),
	(26, 'São Paulo', 'SP', 'São Paulo'),
	(27, 'Tocantis', 'TO', 'Palmas');
/*!40000 ALTER TABLE `cidades` ENABLE KEYS */;

-- Copiando estrutura para tabela economapas.grupocidade
CREATE TABLE IF NOT EXISTS `grupocidade` (
  `id_grupoCidade` int NOT NULL AUTO_INCREMENT,
  `id_grupo` int NOT NULL,
  `id_cidade` int NOT NULL,
  PRIMARY KEY (`id_grupoCidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela economapas.grupocidade: ~3 rows (aproximadamente)
DELETE FROM `grupocidade`;
/*!40000 ALTER TABLE `grupocidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupocidade` ENABLE KEYS */;

-- Copiando estrutura para tabela economapas.grupos
CREATE TABLE IF NOT EXISTS `grupos` (
  `id_grupo` int NOT NULL AUTO_INCREMENT,
  `grupo_nome` varchar(100) NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela economapas.grupos: ~3 rows (aproximadamente)
DELETE FROM `grupos`;
/*!40000 ALTER TABLE `grupos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupos` ENABLE KEYS */;

-- Copiando estrutura para tabela economapas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela economapas.usuarios: ~2 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `nome`, `login`, `senha`) VALUES
	(1, 'João', 'joao', '1234'),
	(2, 'Maria', 'maria', '5678');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
