-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/07/2023 às 20:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `app`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `descricao` varchar(70) NOT NULL,
  `valor` float NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome`, `descricao`, `valor`, `quantidade`) VALUES
(1, 'Camiseta', 'Camiseta de algodão preta', 29.99, 50),
(3, 'Tênis', 'Tênis esportivo preto e branco', 79.99, 20),
(4, 'Bolsa', 'Bolsa de couro marrom', 59.99, 15),
(5, 'Relógio', 'Relógio analógico dourado', 99.99, 15),
(7, 'Celular', 'Smartphone Android', 499.99, 5),
(8, 'Notebook', 'Notebook de última geração', 999.99, 3),
(9, 'Tablet', 'Tablet com tela de alta definição', 299.99, 8),
(10, 'Câmera', 'Câmera digital de 20 megapixels', 199.99, 12),
(11, 'Fones de ouvido', 'Fones de ouvido sem fio', 79.99, 15),
(12, 'Mouse', 'Mouse óptico para computador', 19.99, 30),
(13, 'Teclado', 'Teclado mecânico para jogos', 49.99, 20),
(14, 'Monitor', 'Monitor LED de 24 polegadas', 199.99, 10),
(15, 'Impressora', 'Impressora multifuncional', 149.99, 8),
(16, 'Cadeira', 'Cadeira ergonômica para escritório', 149.99, 10),
(17, 'Mesa', 'Mesa de madeira para computador', 99.99, 15),
(18, 'Tapete', 'Tapete decorativo para sala', 29.99, 20),
(19, 'Quadro', 'Quadro abstrato para decoração', 39.99, 10),
(20, 'Luminária', 'Luminária de mesa com LED', 19.99, 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Matheus', 'matheus@teste.com', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
