-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Nov-2022 às 01:15
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(3, 'gustavo', '8cb2237d0679ca88db6464eac60da96345513964'),
(4, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `pages` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_status` enum('0','1') CHARACTER SET utf8 NOT NULL COMMENT '0-ativo,1-inativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `pages`, `price`, `image`, `product_status`) VALUES
(16, 'O DUQUE E EU', 'Romance', 'Simon Basset, o irresistível duque de Hastings, acaba de retornar a Londres depois de seis anos viajando pelo mundo. Rico, bonito e solteiro, ele é um prato cheio para as mães da alta sociedade, que só pensam em arrumar um bom partido para suas filhas. ', 401, 19, 'livro1.png', '0'),
(17, 'A RAZÃO DO AMOR', 'Romance', 'A carreira de Bee Königswasser está indo de mal a pior. Quando surge um processo seletivo para liderar um projeto de neuroengenharia da Nasa, ela se faz a pergunta que sempre guiou sua vida: o que Marie Curie faria? Participaria, é claro. Depois de conquistar a vaga, Bee descobre que precisará trabalhar com Levi Ward – um desafio que a mãe da física moderna nunca precisou enfrentar.', 336, 33, 'livro2.png', '0'),
(18, 'O QUARTO DIA', 'Terror', 'Janeiro de 2017. Após cinco dias desaparecido, o navio O Belo Sonhador é encontrado à deriva no golfo do México. Poderia ser só mais um caso de falha de comunicação e pane mecânica... se não fosse por um detalhe: não há uma pessoa viva sequer no cruzeiro.', 352, 30, 'livro3.png', '0'),
(19, 'A ESTRADA DA NOITE', 'Suspense', 'Uma lenda do rock pesado, o cinqüentão Judas Coyne coleciona objetos macabros: um livro de receitas para canibais, uma confissão de uma bruxa de de 300 anos atrás, um laço usado num enforcamento, uma fita com cenas reais de assassinato. Por isso, quando fica sabendo de um estranho leilão na internet, ele não pensa duas vezes antes de fazer uma oferta.', 256, 20, 'livro4.png', '0'),
(22, 'O PACTO', 'Terror', '&#34;O pacto é bom como o diabo! Joe Hill é um escritor excepcional, com uma incrível imaginação. Ele tem o talento especial de conduzir os personagens e os leitores a situações sobrenaturais.&#34; - USA Today', 320, 29, 'livro6.png', '0'),
(23, 'BATMAN-CRIATURAS DA NOITE', 'Ficção científica', 'Bruce Wayne está prestes a completar 18 anos e herdar a fortuna de sua família, além do controle das indústrias Wayne. No entanto, no dia do seu aniversário, ele faz uma escolha impulsiva e é condenado a prestar serviço comunitário no Asilo Arkham, uma mescla de prisão e hospital psiquiátrico onde estão detidos os criminosos mais desequilibrados da cidade.', 256, 40, 'livro5.png', '0'),
(24, 'RAINHA DAS CHAMAS', 'Fantasia', 'A princesa Theodosia foi prisioneira em seu próprio país por mais de uma década, humilhada pelo kaiser e por sua corte. Porém, mesmo usando uma coroa de cinzas, o fogo nunca deixou seu sangue. Como herdeira legítima do trono de Astrea, Theo sabe que uma rainha não se acovarda jamais.', 384, 59, 'zyro-image.png', '0'),
(25, 'NÃO FALE COM ESTRANHOS', 'Policial', 'Adam levava uma vida dos sonhos ao lado da esposa, Corinne, e dos dois filhos. Quando o estranho o aborda para contar um segredo estarrecedor sobre sua esposa, ele percebe a fragilidade do sonho que construiu: teria sido tudo uma grande mentira?', 304, 54, 'zyro-image (5).png', '0'),
(26, 'O HOMEM INOCENTE', 'Não ficção', 'Em 1971, aos 18 anos, Ron Williamson tinha uma carreira promissora como atleta. Acabara de assinar contrato com um time grande de beisebol e de se despedir de Ada, sua cidade natal, para ir em busca do sucesso. Seis anos depois, estava de volta com os sonhos destruídos por um braço lesionado e o vício em bebidas e drogas. Foi morar com a mãe e passava vinte horas por dia dormindo no sofá.', 336, 60, 'zyro-image (8).png', '0'),
(28, 'MENTIRAS PERDOÁVEIS', 'Mistério', 'Em seu leito de morte, lady Agnes Lawton faz um último pedido ao marido, sir Cecil: ele deve descobrir o paradeiro do filho deles, Ralph. Segundo os documentos do governo britânico, o jovem teria morrido na Primeira Guerra, mas Agnes acredita que ele ainda está vivo, convencida por médiuns charlatões.', 352, 54, 'zyro-image (10).png', '0'),
(30, 'A GRANDE ILUSÃO', 'Ação', 'Maya Stern é uma ex-piloto de operações especiais que voltou recentemente da guerra. Um dia, ela vê uma imagem impensável capturada pela câmera escondida em sua casa: a filha de 2 anos brincando com Joe, seu falecido marido, brutalmente assassinado duas semanas antes. ', 304, 49, 'zyro-image (14).png', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'gustavo', 'gus.cianci@hotmail.com', '4499742820', '7c4a8d09ca3762af61e59520943dc26494f8941b', '324324, serra dos dourados, umaurama, PR - 8155230'),
(2, 'eduardo', 'eduardo.scara@hotmail.com', '3213213213', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', ''),
(4, 'ewqe', 'gus.cianci18@hotmail.com', '2233122322', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '323, dsadsad, dasdas, PR - 3232132');

-- --------------------------------------------------------

--
-- Estrutura da tabela `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
