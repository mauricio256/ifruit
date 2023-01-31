-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Jan-2023 às 17:50
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifruit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cod_funcionario_pk` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `sobrenome` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `contato` varchar(120) NOT NULL,
  `CPF` varchar(120) NOT NULL,
  `RG` varchar(120) NOT NULL,
  `funcao` varchar(120) NOT NULL,
  `contrato` tinyint(1) DEFAULT NULL,
  `nascimento` date NOT NULL,
  `CEP` varchar(120) NOT NULL,
  `endereco` varchar(120) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(120) NOT NULL,
  `cidade` varchar(120) NOT NULL,
  `estado` varchar(120) NOT NULL,
  `cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cod_funcionario_pk`, `nome`, `sobrenome`, `email`, `senha`, `contato`, `CPF`, `RG`, `funcao`, `contrato`, `nascimento`, `CEP`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `cadastro`) VALUES
(1, 'Mauricio', 'Dos Santos França', 'mauricio_franca@hotmail.com', '1234', '74981293008', '86136254522', '12345678', 'fiscal', 1, '1996-08-03', '48914052', 'Quadra 28', 15, 'Joao paulo ll', 'Juazeiro', 'BA', '2023-01-25 13:21:54'),
(2, 'Lucas', 'De Souza Matos', 'lucas@hotmail.com', '1234', '74981254569', '777', '12345678', 'usuario', 1, '1995-05-02', '48652365', 'Rua aprigio do arte', 70, 'Areia branca', 'petrolina', 'PE', '2023-01-25 17:27:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha`
--

CREATE TABLE `linha` (
  `cod_lote_fk` int(11) NOT NULL,
  `cod_valvula_fk` int(11) NOT NULL,
  `cod_linha_pk` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `linha`
--

INSERT INTO `linha` (`cod_lote_fk`, `cod_valvula_fk`, `cod_linha_pk`, `descricao`) VALUES
(1, 1, 1, 'Linha pronta para poda'),
(2, 2, 2, 'teste de descricao de linha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote`
--

CREATE TABLE `lote` (
  `cod_lote_pk` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lote`
--

INSERT INTO `lote` (`cod_lote_pk`, `descricao`) VALUES
(1, 'lote com Uvas vitoria'),
(2, 'Descricao do lote 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `cod_os_pk` int(11) NOT NULL,
  `fiscal` varchar(120) NOT NULL,
  `cod_funcionario_fk` int(11) NOT NULL,
  `cod_lote_fk` int(11) NOT NULL,
  `cod_valvula_fk` int(11) NOT NULL,
  `tipo_os` varchar(60) NOT NULL,
  `conteudo` varchar(120) NOT NULL,
  `meta` int(11) NOT NULL,
  `colhida` int(11) NOT NULL,
  `data_criacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem_servico`
--

INSERT INTO `ordem_servico` (`cod_os_pk`, `fiscal`, `cod_funcionario_fk`, `cod_lote_fk`, `cod_valvula_fk`, `tipo_os`, `conteudo`, `meta`, `colhida`, `data_criacao`) VALUES
(1, 'Mauricio Dos santos França', 2, 1, 1, 'Atividades', 'Livramento de todas as plantas da válvula', 10, 0, '2023-01-27 23:15:40'),
(2, 'Mauricio Dos santos França', 2, 1, 1, 'Pulverização', 'Pulverizar todas as plantas da válvula', 0, 0, '2023-01-27 23:15:40'),
(3, 'Maurício Dos Santos Franca', 2, 1, 1, 'Adubação', 'Adubar toda a válvula', 0, 0, '2023-01-27 23:15:40'),
(4, 'Mauricio França', 2, 2, 2, 'Atividades', 'Retirar a proteção plástica das uvas', 10, 0, '2023-01-27 23:15:40'),
(5, 'Mauricio França', 2, 2, 2, 'Atividades', 'Coletar todas as caixas de uvas ja colhidas', 30, 0, '2023-01-27 23:15:40'),
(6, 'Mauricio França', 2, 1, 1, 'Atividades', 'Testde de conteudo 3', 0, 0, '2023-01-27 23:15:40'),
(7, 'Mauricio Francã', 2, 2, 2, 'Atividades', 'Teste de conteudo 4', 0, 0, '2023-01-27 23:15:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cod_produto_pk` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `tamanho` float NOT NULL,
  `tipo_unidade` varchar(60) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod_produto_pk`, `descricao`, `tamanho`, `tipo_unidade`, `valor_unitario`, `quantidade_estoque`) VALUES
(1, 'Tesoura de poda', 0, 'unidade', '25.80', 30),
(2, 'Fertilizante', 5, 'kilo', '29.90', 10),
(3, 'Boba manual para irrigação', 0, 'unidade', '150.00', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_os`
--

CREATE TABLE `produto_os` (
  `cod_produto_os_pk` int(11) NOT NULL,
  `cod_os_fk` int(11) NOT NULL,
  `cod_produto_fk` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto_os`
--

INSERT INTO `produto_os` (`cod_produto_os_pk`, `cod_os_fk`, `cod_produto_fk`, `quantidade`) VALUES
(1, 1, 1, 1),
(2, 2, 3, 1),
(3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `valvula`
--

CREATE TABLE `valvula` (
  `cod_lote_fk` int(11) NOT NULL,
  `cod_valvula_pk` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  `variedade` varchar(120) NOT NULL,
  `numero_plantas` int(11) NOT NULL,
  `area` float NOT NULL,
  `escapamento` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `valvula`
--

INSERT INTO `valvula` (`cod_lote_fk`, `cod_valvula_pk`, `descricao`, `variedade`, `numero_plantas`, `area`, `escapamento`) VALUES
(1, 1, 'Valvula com uvas vitoria ainda em crescimento', 'variedade 1', 50, 50, 10),
(2, 2, 'descricao da valvula 2', 'descricao da variedade', 20, 50, 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cod_funcionario_pk`);

--
-- Índices para tabela `linha`
--
ALTER TABLE `linha`
  ADD PRIMARY KEY (`cod_linha_pk`),
  ADD KEY `cod_valvula_fk` (`cod_valvula_fk`),
  ADD KEY `cod_lote_fk` (`cod_lote_fk`);

--
-- Índices para tabela `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`cod_lote_pk`);

--
-- Índices para tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`cod_os_pk`),
  ADD KEY `cod_funcionario_fk` (`cod_funcionario_fk`),
  ADD KEY `cod_lote_fk` (`cod_lote_fk`),
  ADD KEY `cod_valvula_fk` (`cod_valvula_fk`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod_produto_pk`);

--
-- Índices para tabela `produto_os`
--
ALTER TABLE `produto_os`
  ADD PRIMARY KEY (`cod_produto_os_pk`),
  ADD KEY `cod_os_fk` (`cod_os_fk`),
  ADD KEY `cod_produto_fk` (`cod_produto_fk`);

--
-- Índices para tabela `valvula`
--
ALTER TABLE `valvula`
  ADD PRIMARY KEY (`cod_valvula_pk`),
  ADD KEY `cod_lote_fk` (`cod_lote_fk`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cod_funcionario_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `cod_os_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_produto_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produto_os`
--
ALTER TABLE `produto_os`
  MODIFY `cod_produto_os_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `linha`
--
ALTER TABLE `linha`
  ADD CONSTRAINT `cod_valvula` FOREIGN KEY (`cod_valvula_fk`) REFERENCES `valvula` (`cod_valvula_pk`),
  ADD CONSTRAINT `linha_ibfk_1` FOREIGN KEY (`cod_valvula_fk`) REFERENCES `valvula` (`cod_valvula_pk`),
  ADD CONSTRAINT `linha_ibfk_2` FOREIGN KEY (`cod_lote_fk`) REFERENCES `lote` (`cod_lote_pk`);

--
-- Limitadores para a tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD CONSTRAINT `ordem_servico_ibfk_1` FOREIGN KEY (`cod_funcionario_fk`) REFERENCES `funcionario` (`cod_funcionario_pk`),
  ADD CONSTRAINT `ordem_servico_ibfk_2` FOREIGN KEY (`cod_lote_fk`) REFERENCES `lote` (`cod_lote_pk`),
  ADD CONSTRAINT `ordem_servico_ibfk_3` FOREIGN KEY (`cod_funcionario_fk`) REFERENCES `funcionario` (`cod_funcionario_pk`),
  ADD CONSTRAINT `ordem_servico_ibfk_4` FOREIGN KEY (`cod_lote_fk`) REFERENCES `lote` (`cod_lote_pk`),
  ADD CONSTRAINT `ordem_servico_ibfk_5` FOREIGN KEY (`cod_valvula_fk`) REFERENCES `valvula` (`cod_valvula_pk`);

--
-- Limitadores para a tabela `produto_os`
--
ALTER TABLE `produto_os`
  ADD CONSTRAINT `produto_os_ibfk_1` FOREIGN KEY (`cod_os_fk`) REFERENCES `ordem_servico` (`cod_os_pk`),
  ADD CONSTRAINT `produto_os_ibfk_2` FOREIGN KEY (`cod_produto_fk`) REFERENCES `produto` (`cod_produto_pk`);

--
-- Limitadores para a tabela `valvula`
--
ALTER TABLE `valvula`
  ADD CONSTRAINT `cod_lote` FOREIGN KEY (`cod_lote_fk`) REFERENCES `lote` (`cod_lote_pk`),
  ADD CONSTRAINT `cod_lote_fk` FOREIGN KEY (`cod_lote_fk`) REFERENCES `lote` (`cod_lote_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
