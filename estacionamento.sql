-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/10/2024 às 04:40
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacionamento`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_usuario` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_criacao`, `tipo_usuario`) VALUES
(1, 'geg', 'greg@c.com', '$2y$10$Wsj9SldsDxjI0FlraOaA6.5k8SAA0syxzHIDsHFykSwpDO.NzRAyW', '2024-10-09 20:20:14', 'usuario'),
(2, 'guilherme', 'santanagui@gmail.com', '$2y$10$rDZJBB85WxmTINwXtIo0nOrOUrlVNidVO/F8g1qZ7terr.QqZdjme', '2024-10-10 01:49:02', 'usuario'),
(5, 'guilherme', 'santanag1231ui@gmail.com', '$2y$10$67QyHl6G8qHWI/rWmsV0E.rNWyx27ek98QaeMt9LHrcOHWNCmyncC', '2024-10-10 01:53:04', 'usuario'),
(6, 'guilherme', 'gui@gmail.com', '$2y$10$MCb59B7iC1zRftst0/WdN.IEVOHjBJETQcI.C.ZkOjhCUHGUJY41m', '2024-10-10 01:53:54', 'usuario'),
(7, '123', '123@test.com', '$2y$10$BBeSo0rBN/USoOEOMDzgAer8YixPxWl2C8YnmeV6Vt/8mp6jys.oK', '2024-10-10 01:59:46', 'usuario'),
(8, '321', '312@cd12.com', '$2y$10$D/3KkUWBiWb0FFxh9uvAr.xTEKIGQ8XVwMX2AuHdPYFL83rpbk7YO', '2024-10-10 02:08:20', 'usuario'),
(9, 'guilherme', 'botrenan@gmail.com', '$2y$10$RdJwVFd8qxHdoV99fgivhuZLu5/bv9rzhAMViNKTtUd0.W/8EiW4W', '2024-10-10 02:35:40', 'usuario'),
(10, 'teste01', 'teste01@gmail.com', '$2y$10$bQAR.8pRJajSeEhWghlwDe2AZr7NoMfInJAQtbabxQc77Z5su5rI2', '2024-10-10 02:37:06', 'usuario');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `marca`, `modelo`, `ano`, `placa`) VALUES
(1, 'aa', 'aa', 1234, 'aa1a'),
(2, 'aa', 'asa', 12344, 'asdsa'),
(3, 'fiat', 'argo', 2020, 'as1321');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
