-- --- --- --- --- --- --- --- --- --- ---
-- Banco de dados
-- --- --- --- --- --- --- --- --- --- ---

DROP DATABASE IF EXISTS tracker;
CREATE DATABASE IF NOT EXISTS tracker
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE tracker;


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
    hash          CHAR(60)    NOT NULL,
    criado_em     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (nome),
    UNIQUE (hash)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS modelo;
CREATE TABLE IF NOT EXISTS modelo
(
    id            INT         NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(60) NOT NULL,
    conteudo      TEXT        NOT NULL,
    criado_em     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (nome)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS canal;
CREATE TABLE IF NOT EXISTS canal
(
    id            INT         NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(40) NOT NULL,
    criado_em     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (nome)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS arquivo;
CREATE TABLE IF NOT EXISTS arquivo
(
    id        INT         NOT NULL AUTO_INCREMENT,
    hash      VARCHAR(60) NOT NULL,
    criado_em TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS arquivo_coluna;
CREATE TABLE IF NOT EXISTS arquivo_coluna
(
    id         INT         NOT NULL AUTO_INCREMENT,
    arquivo_id INT         NOT NULL,
    nome       VARCHAR(30) NOT NULL,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS arquivo_linha;
CREATE TABLE IF NOT EXISTS arquivo_linha
(
    id         INT NOT NULL AUTO_INCREMENT,
    arquivo_id INT NOT NULL,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS arquivo_linha_valor;
CREATE TABLE IF NOT EXISTS arquivo_linha_valor
(
    id                INT  NOT NULL AUTO_INCREMENT,
    arquivo_linha_id  INT  NOT NULL,
    arquivo_coluna_id INT  NOT NULL,
    valor             TEXT NULL,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS mala_direta;
CREATE TABLE IF NOT EXISTS mala_direta
(
    id                  INT       NOT NULL AUTO_INCREMENT,
    modelo_id           INT       NOT NULL,
    arquivo_id          INT       NOT NULL,
    unidade_interessada INT       NOT NULL,
    ativa               BOOLEAN   NOT NULL DEFAULT TRUE,
    criada_em           TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS status;
CREATE TABLE IF NOT EXISTS status
(
    id            INT         NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(30) NOT NULL,
    criado_em     TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP   NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (nome)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS rastreamento;
CREATE TABLE IF NOT EXISTS rastreamento
(
    id               INT       NOT NULL AUTO_INCREMENT,
    mala_direta_id   INT       NOT NULL,
    canal_id         INT       NOT NULL,
    arquivo_linha_id INT       NOT NULL,
    status_id        INT       NOT NULL,
    hash             CHAR(60)  NOT NULL,
    criado_em        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE (hash)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS rastreamento_notifica;
CREATE TABLE IF NOT EXISTS rastreamento_notifica
(
    id              INT       NOT NULL AUTO_INCREMENT,
    rastreamento_id INT       NOT NULL,
    notifica_id     INT       NOT NULL,
    criado_em       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;

DROP TABLE IF EXISTS leitura;
CREATE TABLE IF NOT EXISTS leitura
(
    id              INT       NOT NULL AUTO_INCREMENT,
    rastreamento_id INT       NOT NULL,
    criado_em       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE = InnoDB
  DEFAULT CHARSET utf8mb4;


-- --- --- --- --- --- --- --- --- --- ---
-- Chave estrangeira
-- --- --- --- --- --- --- --- --- --- ---

ALTER TABLE arquivo_coluna
    ADD FOREIGN KEY (arquivo_id) REFERENCES arquivo (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE arquivo_linha
    ADD FOREIGN KEY (arquivo_id) REFERENCES arquivo (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE arquivo_linha_valor
    ADD FOREIGN KEY (arquivo_linha_id) REFERENCES arquivo_linha (id)
        ON UPDATE NO ACTION ON DELETE CASCADE,
    ADD FOREIGN KEY (arquivo_coluna_id) REFERENCES arquivo_coluna (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE mala_direta
    ADD FOREIGN KEY (modelo_id) REFERENCES modelo (id)
        ON UPDATE NO ACTION ON DELETE CASCADE,
    ADD FOREIGN KEY (arquivo_id) REFERENCES arquivo (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE rastreamento
    ADD FOREIGN KEY (mala_direta_id) REFERENCES mala_direta (id)
        ON UPDATE NO ACTION ON DELETE CASCADE,
    ADD FOREIGN KEY (canal_id) REFERENCES canal (id)
        ON UPDATE NO ACTION ON DELETE CASCADE,
    ADD FOREIGN KEY (arquivo_linha_id) REFERENCES arquivo_linha (id)
        ON UPDATE NO ACTION ON DELETE CASCADE,
    ADD FOREIGN KEY (status_id) REFERENCES status (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE rastreamento_notifica
    ADD FOREIGN KEY (rastreamento_id) REFERENCES rastreamento (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE leitura
    ADD FOREIGN KEY (rastreamento_id) REFERENCES rastreamento (id)
        ON UPDATE NO ACTION ON DELETE CASCADE;


-- --- --- --- --- --- --- --- --- --- ---
-- Insere dados
-- --- --- --- --- --- --- --- --- --- ---

INSERT INTO usuario_api (nome, senha, hash)
VALUES ('onlinemaceio',
        '$2y$10$p0cJEOIk4bq2n1EVsS8rVumozbEG90RkgGCv5Js8DVhbXQJ/2UT5y',
        'DfIvBlyPITTsZNXYRPpH5u7en./ezxkvnPgks4L3goPaIIojK3uze');

INSERT INTO canal (nome)
VALUES ('Web'),
       ('E-mail pessoal'),
       ('E-mail GovBR'),
       ('Notificação por aplicativo GovBR'),
       ('SMS GovBR');

INSERT INTO status (nome)
VALUES ('Enviado'),
       ('Entregue'),
       ('Não entregue'),
       ('Lido');
