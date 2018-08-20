-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/08/2018 às 12:53
-- Versão do servidor: 5.7.23-0ubuntu0.16.04.1
-- Versão do PHP: 7.2.8-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cc_photos`
--

CREATE TABLE `cc_photos` (
  `id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `path` varchar(255) NOT NULL,
  `relative_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cc_ratings`
--

CREATE TABLE `cc_ratings` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cc_users`
--

CREATE TABLE `cc_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` text,
  `rule` enum('user','appraiser','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cc_votes`
--

CREATE TABLE `cc_votes` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cc_photos`
--
ALTER TABLE `cc_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cc_photos_cc_users_idx` (`user_id`);

--
-- Índices de tabela `cc_ratings`
--
ALTER TABLE `cc_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cc_ratings_cc_photos1_idx` (`photo_id`),
  ADD KEY `fk_cc_ratings_cc_users1_idx` (`user_id`);

--
-- Índices de tabela `cc_users`
--
ALTER TABLE `cc_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cc_votes`
--
ALTER TABLE `cc_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cc_votes_cc_photos1_idx` (`photo_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cc_photos`
--
ALTER TABLE `cc_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cc_ratings`
--
ALTER TABLE `cc_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cc_users`
--
ALTER TABLE `cc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cc_votes`
--
ALTER TABLE `cc_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cc_photos`
--
ALTER TABLE `cc_photos`
  ADD CONSTRAINT `fk_cc_photos_cc_users` FOREIGN KEY (`user_id`) REFERENCES `cc_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `cc_ratings`
--
ALTER TABLE `cc_ratings`
  ADD CONSTRAINT `fk_cc_ratings_cc_photos1` FOREIGN KEY (`photo_id`) REFERENCES `cc_photos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cc_ratings_cc_users1` FOREIGN KEY (`user_id`) REFERENCES `cc_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `cc_votes`
--
ALTER TABLE `cc_votes`
  ADD CONSTRAINT `fk_cc_votes_cc_photos1` FOREIGN KEY (`photo_id`) REFERENCES `cc_photos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
