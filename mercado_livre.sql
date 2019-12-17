-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Dez-2019 às 22:49
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
  `cod_athos` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` double NOT NULL,
  `preco_total` double NOT NULL,
  `ncm` int(11) NOT NULL,
  `cest` int(11) NOT NULL,
  `kit_nome` varchar(300) NOT NULL,
  `id_kit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `kits`
--

INSERT INTO `kits` (`id`, `cod_athos`, `nome`, `quantidade`, `preco`, `preco_total`, `ncm`, `cest`, `kit_nome`, `id_kit`) VALUES
(18, 0, 'suco uva', 0, 10, 0, 0, 0, 'Kit 1', 1),
(19, 0, 'moringa', 0, 46.54, 0, 0, 0, 'Kit 1', 1),
(25, 0, '1234', 0, 4.56, 0, 0, 0, 'kit 2', 2),
(26, 0, '1234', 0, 4.56, 0, 0, 0, 'teste', 3),
(27, 0, 'teaeas', 0, 2.13, 0, 0, 0, 'teste', 3),
(28, 0, 'adafq', 0, 2132.13, 0, 0, 0, 'teste', 3),
(29, 0, 'Suco melancia', 0, 10.24, 0, 0, 0, 'Kit 3', 4),
(30, 123, 'suco limao', 4, 12.34, 0, 45455, 0, 'Kit 2', 5),
(31, 123, 'suco limao', 4, 12.34, 49.36, 45455, 0, 'Kit 2', 6),
(32, 123, 'suco limao', 4, 12.34, 49.36, 45455, 0, 'Kit 2', 7),
(33, 456, 'Lapis', 4, 12.59, 50.36, 78213, 1101, 'Kit 2', 7),
(34, 2853, 'VINAGRE DE CALDO DE CANA-DE-ACUCAR ORGÃ‚NICO 500ML', 1, 12.48, 12.48, 22090000, 0, 'KIT NOVO', 8),
(35, 2853, 'VINAGRE DE MAÃ‡A ORGÃ‚NICO 500ML sÃ£o franscisco', 1, 124.78, 124.78, 22090000, 220900045, 'kit novo 2', 9),
(36, 12, 'SUCO LIMÃƒO', 12, 1.2, 14.4, 123456, 456789, 'outro kit', 10),
(37, 1, '1', 1, 0.01, 0.01, 1, 1, 'outro kit', 10),
(38, 0, 'K', 6, 0.87, 5.22, 7, 0, 'rf', 11),
(39, 213, '123', 123, 1.23, 151.29, 312, 0, '213', 12),
(40, 0, 'JKL', 89, 9.8, 872.2, 1, 0, 'asd', 13),
(41, 0, 'JKLASDJK', 789, 8.79, 6935.31, 0, 0, 'asjkl', 14),
(45, 0, '', 0, 0, 0, 0, 0, 'teste', 18);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
