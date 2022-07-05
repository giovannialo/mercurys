-- --- --- --- --- --- --- --- --- --- ---
-- Banco de dados
-- --- --- --- --- --- --- --- --- --- ---

DROP DATABASE IF EXISTS supe;
CREATE DATABASE IF NOT EXISTS supe
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE supe;


-- --- --- --- --- --- --- --- --- --- ---
-- Configuração
-- --- --- --- --- --- --- --- --- --- ---

# SET FOREIGN_KEY_CHECKS = 0;


-- --- --- --- --- --- --- --- --- --- ---
-- Tabela
-- --- --- --- --- --- --- --- --- --- ---

DROP TABLE IF EXISTS usuario_api;
CREATE TABLE IF NOT EXISTS usuario_api
(
    id            INT         NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(30) NOT NULL,
    senha         VARCHAR(60) NOT NULL,
    hash          VARCHAR(60) NOT NULL,
    criado_em     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (nome),
    UNIQUE (hash)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;


-- --- --- --- --- --- --- --- --- --- ---
-- Insere dados
-- --- --- --- --- --- --- --- --- --- ---

INSERT INTO usuario_api (nome, senha, hash)
VALUES ('onlinemaceio',
        '$2y$10$p0cJEOIk4bq2n1EVsS8rVumozbEG90RkgGCv5Js8DVhbXQJ/2UT5y',
        'DfIvBlyPITTsZNXYRPpH5u7en./ezxkvnPgks4L3goPaIIojK3uze');