-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Mar-2020 às 20:34
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
  `ncm` int(11) NOT NULL,
  `cest` int(11) NOT NULL,
  `kit_nome` varchar(300) NOT NULL,
  `id_kit` int(11) NOT NULL,
  `hora_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `kits`
--

INSERT INTO `kits` (`id`, `cod_athos`, `nome`, `quantidade`, `preco`, `preco_total`, `ncm`, `cest`, `kit_nome`, `id_kit`, `hora_cadastro`) VALUES
(1, '2502', 'ARROZ GUIN 1KG', 1, 8.54, 8.54, 10063021, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(2, '3354', 'NORI HANARO 10 FOLHAS', 1, 9.66, 9.66, 12122100, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(3, '3', 'TEMPERO SUSHI AZUMA 750ML', 1, 11.79, 11.79, 21039021, 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(4, '555', 'SHOYU SAKURA 150ML', 1, 3.78, 3.78, 21031010, 1703600, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(5, '824/3732\r\n', 'ESTEIRA BAMBU', 1, 6.62, 6.62, 4612100, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(6, '2213', 'PANKO ALFA 200G', 1, 8.18, 8.18, 19019090, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(7, '1524', 'BARCO ISOPOR C/ TAMPA M', 1, 3.43, 3.43, 39239000, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(8, '1092', 'WASABI EM PASTA GLOBO', 1, 10.23, 10.23, 21039021, 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(9, '35', 'SUSHI KATA', 1, 4.92, 4.92, 39241000, 1400600, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(10, '2299', 'HASHI DE BAMBU C/50', 1, 8.02, 8.02, 44191200, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(11, '1215', 'MOLHEIRA DESCARTÃVEL C/10', 1, 1.68, 1.68, 39241000, 1400601, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(12, '347', 'MOLHO TARÃŠ SAKURA', 1, 7.11, 7.11, 21039091, 1703500, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(13, '27', 'GERGELIM PRETO TORRADO', 1, 7.11, 7.11, 12074090, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51'),
(14, '21', 'GERGELIM BRANCO TORRADO', 1, 5.56, 5.56, 12074090, 0, 'KIT SUSHI HOT ROLL I - BOAT', 1, '2020-03-09 15:44:51');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
