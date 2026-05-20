CREATE DATABASE IF NOT EXISTS poc_financeiro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE poc_financeiro;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR (100) UNIQUE NOT NULL,
    senha VARCHAR (250) NOT NULL
);

CREATE TABLE transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    descricao TEXT NOT NULL,
    valor DECIMAL (10,2) NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);