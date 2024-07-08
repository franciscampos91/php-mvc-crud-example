
-- Criar banco de dados
CREATE DATABASE vendas;
USE vendas;

-- Tabela de Clientes
CREATE TABLE Clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20),
    endereco VARCHAR(150),
    cidade VARCHAR(50),
    uf VARCHAR(2)
);

-- Tabela de Produtos
CREATE TABLE Produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL
);

-- Tabela de Pedidos
CREATE TABLE Pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente)
);

-- Tabela de Itens do Pedido
CREATE TABLE ItensPedido (
    id_item_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    quantidade INT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_produto) REFERENCES Produtos(id_produto)
);



-- Inserir clientes de exemplo
INSERT INTO Clientes (nome, email, telefone, endereco, cidade, uf) VALUES
('João Silva', 'joao.silva@example.com', '123456789', 'Rua A, 123', 'São Paulo', 'SP'),
('Maria Oliveira', 'maria.oliveira@example.com', '987654321', 'Rua B, 456', 'Rio de Janeiro', 'RJ'),
('Carlos Pereira', 'carlos.pereira@example.com', '456123789', 'Rua C, 789', 'Belo Horizonte', 'MG'),
('Ana Souza', 'ana.souza@example.com', '321654987', 'Rua D, 101', 'Curitiba', 'PR'),
('Rafaela Lima', 'rafaela.lima@example.com', '555444333', 'Rua E, 567', 'Fortaleza', 'CE'),
('Gustavo Rodrigues', 'gustavo.rodrigues@example.com', '222333444', 'Rua F, 890', 'Manaus', 'AM'),
('Juliana Pereira', 'juliana.pereira@example.com', '666777888', 'Avenida G, 234', 'Florianópolis', 'SC'),
('Roberto Ferreira', 'roberto.ferreira@example.com', '777111222', 'Rua H, 345', 'Brasília', 'DF'),
('Camila Santos', 'camila.santos@example.com', '999333444', 'Avenida I, 678', 'Vitória', 'ES'),
('Lucas Oliveira', 'lucas.oliveira@example.com', '555888999', 'Rua J, 901', 'João Pessoa', 'PB'),
('Patrícia Silva', 'patricia.silva@example.com', '333777888', 'Rua K, 234', 'Natal', 'RN');


-- Inserir produtos de informática
INSERT INTO Produtos (nome, descricao, preco) VALUES
('Mouse Gamer', 'Mouse óptico gamer com alta precisão e iluminação LED.', 59.99),
('Teclado Mecânico', 'Teclado mecânico com switches de alta durabilidade.', 149.90),
('Monitor LED 24"', 'Monitor LED de 24 polegadas com resolução Full HD.', 699.99),
('Headset Gamer', 'Headset com som surround 7.1 e microfone ajustável.', 199.50),
('Placa de Vídeo', 'Placa de vídeo de última geração com 8GB de memória.', 2500.00),
('SSD 1TB', 'SSD de 1TB com alta velocidade de leitura e gravação.', 399.00),
('Memória RAM 16GB', 'Kit de memória RAM de 16GB DDR4.', 349.99),
('Processador Intel i7', 'Processador Intel Core i7 de 10ª geração.', 1500.75),
('Placa Mãe', 'Placa mãe compatível com processadores Intel e AMD.', 599.90),
('Fonte 750W', 'Fonte de alimentação com 750W de potência e certificação 80 Plus.', 350.49),
('Mousepad Gamer', 'Mousepad com superfície de tecido e base emborrachada.', 29.90),
('Webcam Full HD', 'Webcam com resolução Full HD e microfone embutido.', 199.90),
('Impressora Multifuncional', 'Impressora multifuncional com scanner e copiadora.', 450.00),
('Roteador Wi-Fi', 'Roteador Wi-Fi de alta performance com 4 antenas.', 299.99),
('HD Externo 2TB', 'HD externo portátil com 2TB de capacidade.', 499.99),
('Cadeira Gamer', 'Cadeira ergonômica gamer com ajuste de altura e reclinação.', 899.90),
('Microfone USB', 'Microfone USB para gravação de alta qualidade.', 249.90),
('Ventoinha RGB', 'Ventoinha com iluminação RGB para gabinetes.', 79.90),
('Gabinete Mid Tower', 'Gabinete Mid Tower com painel lateral em vidro temperado.', 299.00),
('Hub USB 3.0', 'Hub USB 3.0 com 4 portas de alta velocidade.', 99.90);
