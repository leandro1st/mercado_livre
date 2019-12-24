-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Dez-2019 às 05:02
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

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
(1, 123, 'ESTEIRA PARA SUSHI', 3, 7.99, 23.97, 123456, 789123, 'Kit Sushi', 1),
(2, 456, 'VINAGRE DE ARROZ', 2, 15.9, 31.8, 123456, 0, 'Kit Sushi', 1),
(3, 1004, 'SUCO DE UVA', 12, 3.5, 42, 123456, 0, 'Kit Suco', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
