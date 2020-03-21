-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Mar-2020 às 18:46
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mercado_livre`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `kits`
--

CREATE TABLE `kits` (
  `id` int(11) NOT NULL,
  `cod_athos` varchar(200) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` double NOT NULL,
  `preco_total` double NOT NULL,
  `ncm` varchar(100) NOT NULL,
  `cest` int(11) NOT NULL,
  `kit_nome` varchar(300) NOT NULL,
  `id_kit` int(11) NOT NULL,
  `hora_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `kits`
--

INSERT INTO `kits` (`id`, `cod_athos`, `nome`, `quantidade`, `preco`, `preco_total`, `ncm`, `cest`, `kit_nome`, `id_kit`, `hora_cadastro`) VALUES
(1, '2502', 'ARROZ GUIN 1KG', 1, 8.54, 8.54, '10063021', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(2, '3354', 'NORI HANARO 10 FOLHAS', 1, 9.66, 9.66, '12122100', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(3, '3', 'TEMPERO SUSHI AZUMA 750ML', 1, 11.79, 11.79, '21039021', 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(4, '555', 'SHOYU SAKURA 150ML', 1, 3.78, 3.78, '21031010', 1703600, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(5, '824/3732\r\n', 'ESTEIRA BAMBU', 1, 6.62, 6.62, '4612100', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(6, '2213', 'PANKO ALFA 200G', 1, 8.18, 8.18, '19019090', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(7, '1524', 'BARCO ISOPOR C/ TAMPA M', 1, 3.43, 3.43, '39239000', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(8, '1092', 'WASABI EM PASTA GLOBO', 1, 10.23, 10.23, '21039021', 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(9, '35', 'SUSHI KATA', 1, 4.92, 4.92, '39241000', 1400600, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(10, '2299', 'HASHI DE BAMBU C/50', 1, 8.02, 8.02, '44191200', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(11, '1215', 'MOLHEIRA DESCARTÃVEL C/10', 1, 1.68, 1.68, '39241000', 1400601, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(12, '347', 'MOLHO TARÃŠ SAKURA', 1, 7.11, 7.11, '21039091', 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(13, '27', 'GERGELIM PRETO TORRADO', 1, 7.11, 7.11, '12074090', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(14, '21', 'GERGELIM BRANCO TORRADO', 1, 5.56, 5.56, '12074090', 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(15, '3372', 'ESCORREDOR TELA PARA LAMEN INOX FL03-14 SHIKI', 1, 64.75, 64.75, '73239300', 0, 'ESCORREDOR TELA PARA LAMEN, MACARRÃƒO, MASSA AÃ‡O INOX 13,5CM', 2, '2020-03-16 16:54:19'),
(16, '2502', 'ARROZ GUIN 1KG', 1, 10.44, 10.44, '10063021', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(17, '3354', 'NORI HANARO 10 FOLHAS', 1, 9.64, 9.64, '12122100', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(18, '3', 'TEMPERO SUSHI AZUMA 750ML', 1, 11.77, 11.77, '21039021', 1703500, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(19, '555', 'SHOYU SAKURA 150ML', 1, 4.14, 4.14, '21031010', 1703600, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(20, '824/3732', 'ESTEIRA BAMBU', 1, 6.6, 6.6, '46012100', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(21, '2213', 'PANKO ALFA 200G', 1, 8.16, 8.16, '19019090', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(22, '1092', 'WASABI EM PASTA GLOBO', 1, 10.21, 10.21, '21039021', 1703500, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(23, '35', 'SUSHI KATA', 1, 5.21, 5.21, '39241000', 1400600, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(24, '2299', 'HASHI DE BAMBU C/50', 1, 7.99, 7.99, '44191200', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(25, '1215', 'MOLHEIRA DESCARTÃVEL C/10', 1, 1.65, 1.65, '39241000', 1400601, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(26, '347', 'MOLHO TARÃŠ SAKURA', 1, 7.34, 7.34, '21039091/21031010 TAKAKI\r\n', 1703500, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(27, '27', 'GERGELIM PRETO TORRADO', 1, 7.67, 7.67, '12074090', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04'),
(28, '21', 'GERGELIM BRANCO TORRADO', 1, 6.19, 6.19, '12074090', 0, 'KIT SUSHI / HOT ROLL 4 - COMPLETO SEM BARCO', 3, '2020-03-16 17:18:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kits`
--
ALTER TABLE `kits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kits`
--
ALTER TABLE `kits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
