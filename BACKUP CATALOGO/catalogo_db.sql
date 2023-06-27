-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jun-2023 às 00:05
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `catalogo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `quantidade` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `quantidade`) VALUES
(1, '1'),
(2, '2'),
(3, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Roupas'),
(2, 'Acessórios'),
(3, 'Calçados'),
(4, 'Moletom');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `frete` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `preco`, `descricao`, `frete`, `status`, `categoria_id`, `imagem`) VALUES
(7, 'Camiseta', '29.99', 'Camiseta de Banda 😎', 5, 'Em loja', 1, '6494b08d0bd2d.png'),
(12, 'Boné', '19.99', 'Boné com chifre 😒', 7, 'Em loja', 2, '6494b15601a9a.png'),
(18, 'Calça Cargo', '79.99', 'Uma Calça Cargo👍', 10, 'Em loja', 1, '649a0c9ebeebd.png'),
(19, 'Anel Olho de Dragão', '49.99', 'Anel muito zica🤣', 5, 'Em loja', 2, '649a0cd7bc34b.png'),
(20, 'Adi 2000', '129.99', 'Tênis Lindo❤️', 39, 'Em loja', 3, '649a0f68843f4.png'),
(21, 'Camiseta Dragão', '79.99', 'Dragão🐉', 10, 'Em loja', 1, '649a0fab6e56c.png'),
(22, 'Moletom Verde', '89.99', 'Moletom Muito Show😍', 7, 'Em loja', 4, '649a0fe553460.png'),
(23, 'Camiseta Caveira', '19.99', 'Caveira💀', 5, 'Em loja', 1, '649a10143c916.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_carrinho`
--

CREATE TABLE `produto_carrinho` (
  `id` int(11) NOT NULL,
  `quantidade` varchar(45) DEFAULT NULL,
  `carrinho_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto_carrinho`
--

INSERT INTO `produto_carrinho` (`id`, `quantidade`, `carrinho_id`, `produto_id`) VALUES
(1, '2', 1, 1),
(2, '1', 1, 2),
(3, '3', 2, 1),
(4, '2', 2, 3),
(5, '1', 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhos`
--

CREATE TABLE `tamanhos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `modelagem` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tamanhos`
--

INSERT INTO `tamanhos` (`id`, `nome`, `modelagem`) VALUES
(1, 'P', '1'),
(2, 'M', '1'),
(3, 'G', '1'),
(4, '38', '2'),
(5, '40', '2'),
(6, '42', '2'),
(7, 'Único', '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhos_has_produto`
--

CREATE TABLE `tamanhos_has_produto` (
  `tamanhos_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tamanhos_has_produto`
--

INSERT INTO `tamanhos_has_produto` (`tamanhos_id`, `produto_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `carrinho_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `CPF`, `telefone`, `endereco`, `carrinho_id`) VALUES
(4, 'João da Silva', 'joao@example.com', '123456', '12345678901', '999999999', 'Rua A, 123', 1),
(5, 'Maria Souza', 'maria@example.com', 'abcdef', '98765432101', '888888888', 'Avenida B, 456', 2),
(6, 'Carlos Santos', 'carlos@example.com', 'qwerty', '54321678901', '777777777', 'Praça C, 789', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_categoria1_idx` (`categoria_id`);

--
-- Índices para tabela `produto_carrinho`
--
ALTER TABLE `produto_carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto carrinho_carrinho1_idx` (`carrinho_id`),
  ADD KEY `fk_produto carrinho_produto1_idx` (`produto_id`);

--
-- Índices para tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tamanhos_has_produto`
--
ALTER TABLE `tamanhos_has_produto`
  ADD PRIMARY KEY (`tamanhos_id`,`produto_id`),
  ADD KEY `fk_tamanhos_has_produto_produto1_idx` (`produto_id`),
  ADD KEY `fk_tamanhos_has_produto_tamanhos1_idx` (`tamanhos_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_carrinho_idx` (`carrinho_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `produto_carrinho`
--
ALTER TABLE `produto_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto_carrinho`
--
ALTER TABLE `produto_carrinho`
  ADD CONSTRAINT `fk_produto carrinho_carrinho1` FOREIGN KEY (`carrinho_id`) REFERENCES `carrinho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto carrinho_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tamanhos_has_produto`
--
ALTER TABLE `tamanhos_has_produto`
  ADD CONSTRAINT `fk_tamanhos_has_produto_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tamanhos_has_produto_tamanhos1` FOREIGN KEY (`tamanhos_id`) REFERENCES `tamanhos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_carrinho` FOREIGN KEY (`carrinho_id`) REFERENCES `carrinho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
