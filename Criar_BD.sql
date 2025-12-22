
CREATE DATABASE if not exists db_printer3d default character set utf8 default collate utf8_general_ci;

use DB_PRINTER3D;

CREATE TABLE if not exists tb_clientes (
  id      int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  cpf     int, 
  nome    varchar(50) NOT NULL,
  email   varchar(60) NOT NULL UNIQUE,
  celular varchar(15) NOT NULL, 
  operador int ,
  datatual date
) default character set utf8 default collate utf8_general_ci;


CREATE TABLE if not exists tb_usuarios (
  id      int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome    VARCHAR(50) NOT NULL,
  login VARCHAR(10) NOT NULL,
  celular VARCHAR(15),
  senha   VARCHAR(8) NOT NULL,
  nivel   tinyint NOT NULL, 	  
  salario decimal(12,2) ,
  comissao decimal(5,2),
  operador int ,
  datatual date
 ) default character set utf8 default collate utf8_general_ci;

CREATE TABLE if not exists tb_niveis (
  id      int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descricao  VARCHAR(20) NOT NULL,
  operador int ,
  datatual date
 ) default character set utf8 default collate utf8_general_ci;



CREATE TABLE if not exists tb_lojas (
  id       int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome     VARCHAR(50) NOT NULL,
  endereco VARCHAR(100),
  CNPJ     VARCHAR(15),     
  operador int ,
  datatual date

 ) default character set utf8 default collate utf8_general_ci;


--
-- Estrutura da tabela  filamento 
--

CREATE TABLE if not exists   tb_filamentos  (
   id  int(11) NOT NULL,
   marca  varchar(100) DEFAULT NULL,
   tipo  varchar(100) DEFAULT NULL,
   cor  varchar(100) DEFAULT NULL,
   valor  decimal(10,0) NOT NULL,
   qtde_estoque  int(11) NOT NULL,
   operador int ,
   datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela  impressoras 
--

CREATE TABLE if not exists  tb_impressoras  (
   id  int(11) NOT NULL,
   marca  varchar(250) DEFAULT NULL,
   modelo  varchar(250) DEFAULT NULL,
   qtrolos  int(11) NOT NULL,
   ocupada  varchar(3) NOT NULL,
  operador int ,
  datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela  pedidos 
--

CREATE TABLE if not exists  tb_pedidos  (
   id_venda  int(11) NOT NULL,
   id_cliente  int(11) NOT NULL,
   descricao  varchar(250) NOT NULL,
   id_usuario  int(11) NOT NULL,
   preco  float NOT NULL,
   quantidade  int(11) NOT NULL,
   total_venda  float NOT NULL,
   status  int(11) NOT NULL,
   dataCompra  date NOT NULL,
   dataPrevisao  date NOT NULL,
   dataFinaliza  date NOT NULL,
   dataEntrega  date NOT NULL,
  operador int ,
  datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela  pedido_impressoras 
--

CREATE TABLE if not exists  tb_pedximpres  (
   id_pedido  int(11) NOT NULL,
   id_impressora  int(11) NOT NULL,
  operador int ,
  datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela  pedido_impressoras 
--

CREATE TABLE if not exists  tb_pedxfilamento  (
   id_pedido  int(11) NOT NULL,

   id_filamento  int(11) NOT NULL,
  operador int ,
  datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela  status 
--

CREATE TABLE if not exists  tb_status  (
   id_status  int(11) NOT NULL,
   descricao  varchar(10) NOT NULL,
   operador int ,
   datatual date

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Inserindo dados da tabela  niveis 
--

INSERT INTO  tb_niveis  ( id ,  descricao ) VALUES
(1, 'Administrador'),
(2, 'Operador');

--
-- Extraindo dados da tabela  status 
--

INSERT INTO  tb_status  ( id_status ,  descricao ) VALUES
(1, 'A iniciar'),
(2, 'Inciado'),
(3, 'Finalizado'),
(4, 'Entregue');

-- --------------------------------------------------------

-- INSERT INTO  usuarios  ( id ,  nome ,  user ,  email ,  senha ,  dataCaptura ) VALUES
-- (6, 'Hugo Freitas', 'hugofreitas', 'hugovasconcelosf@hotmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2018-05-17'),
-- (7, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2018-05-17');

--
-- Índices para tabelas despejadas
--
--
-- Índices para tabela  filamento 
--
ALTER TABLE  tb_filamentos 
  ADD PRIMARY KEY ( id );

--
-- Índices para tabela  impressoras 
--
ALTER TABLE  tb_impressoras 
  ADD PRIMARY KEY ( id );

--
-- Índices para tabela  pedidos 
--
ALTER TABLE  tb_pedidos 
  ADD PRIMARY KEY ( id_venda );

--
-- Índices para tabela  pedido_impressoras 
--
ALTER TABLE  tb_pedximpres 
  ADD KEY  id_pedimpress  ( id_pedido , id_impressora );

ALTER TABLE  tb_pedxfilamento 
  ADD KEY  id_pedfilamento  ( id_pedido , id_filamento );

--
-- Índices para tabela  status 
--
ALTER TABLE  tb_status 
  ADD PRIMARY KEY ( id_status );

--
-- AUTO_INCREMENT de tabela  impressoras 
--
ALTER TABLE  tb_impressoras 
  MODIFY  id  int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela  pedidos 
--
ALTER TABLE  tb_pedidos 
  MODIFY  id_venda  int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela  status 
--
ALTER TABLE  tb_status 
  MODIFY  id_status  int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

 INSERT INTO  tb_clientes  ( id , cpf_cnpj, nome ,  usuario ,  email , celular ,  operador ) VALUES
 (1, '11111111111', 'Reinert', 'usuario','fabio@hotmail.com', '(11) 111111111', 1),
 (2, '22222222222', 'Reinert2', 'usuario2','fabio2@hotmail.com', '(11) 222222222', 1),
 (3, '33333333333', 'Reinert3', 'usuario3','fabio3@hotmail.com', '(11) 333333333', 1),
 (4, '44444444444', 'Reinert4', 'usuario4','fabio4@hotmail.com', '(11) 444444444', 1),
 (5, '55555555555', 'Reinert5', 'usuario5','fabio5@hotmail.com', '(11) 555555555', 1),
 (6, '66666666666', 'Reinert6', 'usuario6','fabio6@hotmail.com', '(11) 666666666', 1),
 (7, '77777777777', 'Reinert7', 'usuario7','fabio7@hotmail.com', '(11) 777777777', 1),
 (8, '88888888888', 'Reinert8', 'usuario8','fabio8@hotmail.com', '(11) 888888888', 1),
 (9, '99999999999', 'Reinert9', 'usuario9','fabio9@hotmail.com', '(11) 999999999', 1);

