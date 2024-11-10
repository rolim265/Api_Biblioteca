-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Nov-2024 às 01:27
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id_emprestimo` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `status` enum('emprestado','devolvido') DEFAULT NULL,
  `fk_usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id_livro` int(11) NOT NULL,
  `capa_livro` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `quantidade_fisico` int(11) DEFAULT NULL,
  `url_ebook` varchar(255) NOT NULL,
  `tipo_livro` enum('fisico','ebook') NOT NULL,
  `editora` varchar(100) DEFAULT NULL,
  `ano_publicacao` int(4) NOT NULL,
  `fk_emprestimos_id_emprestimo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id_livro`, `capa_livro`, `titulo`, `autor`, `quantidade_fisico`, `url_ebook`, `tipo_livro`, `editora`, `ano_publicacao`, `fk_emprestimos_id_emprestimo`) VALUES
(3, 'https://m.media-amazon.com/images/I/71mWm5Oq7cL.jpg', 'As Armas da Persuasão', 'Robert B. Cialdini', 0, 'https://drive.google.com/file/d/17gBaCQMREg5gViaL2fDu6-UGZmNvZObf/view?usp=sharing', 'ebook', 'Sextante', 1984, NULL),
(9, 'https://m.media-amazon.com/images/I/617iS--XOQL._AC_UF1000,1000_QL80_.jpg', '48 Leis Do Poder', 'Robert Greene', 0, 'https://drive.google.com/file/d/14BpT6_rHs-IV-0lczhMjyregCMRWYi0Z/view?usp=sharing', 'ebook', 'Viking Press', 1998, NULL),
(10, 'https://m.media-amazon.com/images/I/61rQikkGR9L._AC_UF1000,1000_QL80_.jpg', 'A Arte da Sedução', 'Robert Greene', 0, 'https://drive.google.com/file/d/1igJzpBwZLhZLwScL0flfzktOpcvzFALD/view?usp=sharing', 'ebook', 'Viking Press', 2001, NULL),
(11, 'https://m.media-amazon.com/images/I/819ERrDHRcL._AC_UF1000,1000_QL80_.jpg', '+ Esperto que o Diabo', 'Napoleon Hill', 1, 'https://drive.google.com/file/d/1DIkl5CqsjGf_xhGbNFVp4Iv44Ohd2u9I/view?usp=sharing', 'ebook', 'Citadel', 2011, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_reserva` date DEFAULT NULL,
  `status` enum('ativa','cancelada','atendida') DEFAULT NULL,
  `fk_usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ter`
--

CREATE TABLE `ter` (
  `fk_reservas_id_reserva` int(11) DEFAULT NULL,
  `fk_livros_id_livro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `tipo_usuario` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `endereco`, `telefone`, `tipo_usuario`) VALUES
(1, 'Gabriel Rodrigues Rolim', 'rolim8096@gmail.com', '$2y$10$t2QLHKOnfDb93HpBuPp2/.tjZ8UIBKvC6pwuEWMu9SQp1Rg9yPzr.', 'Rua Alaska, Ribeirão Pires', '11930857242', 'admin'),
(6, 'Francinal Andrade Rolim', 'rolim109622@gmail.com', '$2y$10$7x5B1/XKGcKG8nOJnAhn9uRMarbkQJudgGVFcf0pKwu3JJljsoMwi', 'Rua Tóquio, Ribeirão Pires', '11971297437', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `FK_emprestimos_2` (`fk_usuario_id_usuario`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`),
  ADD KEY `FK_livros_2` (`fk_emprestimos_id_emprestimo`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_reservas_2` (`fk_usuario_id_usuario`);

--
-- Índices para tabela `ter`
--
ALTER TABLE `ter`
  ADD KEY `FK_ter_1` (`fk_reservas_id_reserva`),
  ADD KEY `FK_ter_2` (`fk_livros_id_livro`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `FK_emprestimos_2` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `FK_livros_2` FOREIGN KEY (`fk_emprestimos_id_emprestimo`) REFERENCES `emprestimos` (`id_emprestimo`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_reservas_2` FOREIGN KEY (`fk_usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `ter`
--
ALTER TABLE `ter`
  ADD CONSTRAINT `FK_ter_1` FOREIGN KEY (`fk_reservas_id_reserva`) REFERENCES `reservas` (`id_reserva`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_ter_2` FOREIGN KEY (`fk_livros_id_livro`) REFERENCES `livros` (`id_livro`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
