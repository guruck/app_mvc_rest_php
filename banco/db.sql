CREATE DATABASE IF NOT EXISTS binguin DEFAULT CHARACTER SET utf8 COLLATE UTF8_UNICODE_CI;
USE binguin;
CREATE USER 'binguin'@'%' IDENTIFIED BY 'bingo@123';
GRANT ALTER, SHOW VIEW, SHOW DATABASES, SELECT, PROCESS, EXECUTE  ON *.* TO 'binguin'@'%';
FLUSH PRIVILEGES;

DROP TABLE IF EXISTS cadastro, working_hours, users, menus;

CREATE TABLE IF NOT EXISTS cadastro (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nascimento DATE,
    email VARCHAR(100) NOT NULL,
    site VARCHAR(100),
    filhos INT,
    salario FLOAT
    )CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE users (
    id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    is_admin BOOLEAN NOT NULL DEFAULT false
)CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE working_hours (
    id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    user_id INT(6),
    work_date DATE NOT NULL,
    time1 TIME,
    time2 TIME,
    time3 TIME,
    time4 TIME,
    worked_time INT,

    FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT cons_user_day UNIQUE (user_id, work_date)
)CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE menus (
    id INT(6) AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(50) NOT NULL,
    ico VARCHAR(50) NULL,
    elevate BOOLEAN NOT NULL DEFAULT false,
    page VARCHAR(50) NOT NULL,
    ativo BOOLEAN NOT NULL DEFAULT true,
    updated DATE
)CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Essa senha criptografada corresponde ao valor "a"
INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (1, 'Admin', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'admin@guruck.local', '2000-1-1', null, 1);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (2, 'Chaves', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'chaves@guruck.local', '2000-1-1', null, 1);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (3, 'Seu Barriga', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'barriga@guruck.local', '2000-1-1', null, 0);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (4, 'Seu Madruga', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'madruga@guruck.local', '2000-1-1', null, 0);

INSERT INTO users (id, name, password, email, start_date, end_date, is_admin)
VALUES (5, 'Quico', '$2y$10$/vC1UKrEJQUZLN2iM3U9re/4DQP74sXCOVXlYXe/j9zuv1/MHD4o.', 'quico@guruck.local', '2000-1-1', '2019-1-1', 0);

INSERT INTO menus (id, name, ico, elevate, page, ativo, updated)
VALUES
(1,'Gerenciar Menu','icofont-skull-danger',true,'batata',true,'2021-05-19'),
(2,'Registrar Ponto','icofont-ui-check',false,'day_records.php',true,'2021-05-18'),
(3,'Relatorio Mensal','icofont-ui-calendar',false,'monthly_report.php',true,'2021-05-18'),
(4,'Relatorio Gerencial','icofont-chart-histogram',true,'manager_report.php',true,'2021-05-18'),
(5,'Usuários','icofont-users',true,'accounts',true,'2021-05-18'),
(6,'Testes','icofont-test-tube-alt',false,'lista',true,'2021-05-18'),
(7,'Zerar Ponto do Dia','icofont-skull-danger',true,'data_generator.php',true,'2021-05-18');

INSERT INTO cadastro (nome, nascimento, email, site, filhos, salario)
VALUES ('Marieta Rodrigues','2005-11-20','marieta@rodrigues.com.br','https://www.marieta.rodrigues.com.br',0,2005.11),
('Manuela Beatriz Melissa de Paula','1998-11-01','manuelabeatrizmelissadepaula@cordeiromaquinas.com.br','https://www.cordeiromaquinas.com.br',3,1998.11),
('Luiz Cauã Diego Novaes','1958-03-22','luizcauadiegonovaes-94@mega-vale.com','https://www.mega-vale.com',5,1958.03),
('Luan Luís Mário Freitas','1996-08-14','lluanluismariofreitas@granvale.com.br','https://www.granvale.com.br',9,1996.08),
('Allana Fernanda Sarah Rezende','1986-08-03','allanafernandasarahrezende@bcconsult.com.br','https://www.bcconsult.com.br',7,1986.08),
('Thales Paulo Assunção','1958-04-17','thalespauloassuncao@avoeazul.com.br','https://www.avoeazul.com.br',1,1958.04),
('Esther Sueli Isis da Costa','1964-03-10','esthersueliisisdacosta-85@esctech.com.br','https://www.esctech.com.br',9,1964.03),
('Thiago Samuel Pinto','1949-07-13','thiagosamuelpinto-89@universo3d.com.br','https://www.universo3d.com.br',2,1949.07),
('Diogo Thales da Paz','1977-11-17','diogothalesdapaz_@sorocaba.com','https://www.sorocaba.com',9,1977.11),
('Mariana Sophia Alícia Nogueira','1990-09-13','mmarianasophiaalicianogueira@publicarbrasil.com.br','https://www.publicarbrasil.com.br',3,1990.09),
('Pedro Henrique Caleb Mendes','1955-06-21','pedrohenriquecalebmendes@nhrtaxiaereo.com','https://www.nhrtaxiaereo.com',8,1955.06);
