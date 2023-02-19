-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Fev-2023 às 15:59
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
  `foto` varchar(220) NOT NULL,
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

INSERT INTO `funcionario` (`cod_funcionario_pk`, `nome`, `sobrenome`, `email`, `senha`, `contato`, `CPF`, `RG`, `funcao`, `contrato`, `nascimento`, `foto`, `CEP`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `cadastro`) VALUES
(6, 'Mauricio', 'Dos Santo França', 'mauriciodossantosfranca@hotmail.com', '1234', '74981293068', '86136254522', '12345678910', 'fiscal', 1, '1996-08-03', 'img/funcionario/Mauricio.jpg', '48914056', 'Q:28', 12, 'Joao Paulo ll', 'Juazeiro', 'BA', '2023-02-12 16:49:43'),
(7, 'Bianca', 'Souza Gomes', 'bia@hotmail.com', '1234', '748958645', '12345678', '12345678910', 'usuario', 1, '2000-01-01', 'img/funcionario/Bianca.jpg', '48759562', 'rua monteiro lobato', 43, 'Area Branca', 'Petrolina', 'PE', '2023-02-12 17:05:45');

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
(1, 1, 1, 'testede deda linha'),
(1, 1, 2, 'teste de descrição de linha');

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
(2, 'Descricao do lote 2'),
(3, 'teste de lote 3');

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
(17, 'Mauricio Dos Santo França', 7, 1, 1, 'Pulverização', 'dasdadecdefqaerre', 34, 0, '2023-02-18 13:37:16'),
(18, 'Mauricio Dos Santo França', 7, 2, 1, 'Atividades', 'dgfsdgdgsdgsdgsdgfew', 0, 0, '2023-02-18 13:42:34'),
(19, 'Mauricio Dos Santo França', 7, 1, 1, 'Adubação', 'sadsadsadsa', 34, 0, '2023-02-18 13:43:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cod_produto_pk` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  `tamanho` varchar(220) NOT NULL,
  `tipo_unidade` varchar(60) NOT NULL,
  `valor_unidade` float NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cod_produto_pk`, `descricao`, `tamanho`, `tipo_unidade`, `valor_unidade`, `valor_unitario`, `quantidade_estoque`) VALUES
(16, 'fertilizante', 'Geral', 'Unidade', 1, '54.89', 3),
(17, 'fsfsfsf', 'Geral', 'Litro', 10, '0.00', 6);

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
  ADD PRIMARY KEY (`cod_funcionario_pk`),
  ADD UNIQUE KEY `CPF` (`CPF`(11)) USING BTREE;

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
  MODIFY `cod_funcionario_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `cod_os_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_produto_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produto_os`
--
ALTER TABLE `produto_os`
  MODIFY `cod_produto_os_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
