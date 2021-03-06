-- Database - FilaFacil
create database filafacil;

use filafacil;

create table funcionario (
	codfuncionario int auto_increment primary key,
	nome varchar(255) not null,
	status tinyint(1) not null default 0,
	email varchar(100) not n()ull,
	senha varchar(20) not null,
	descricao varchar(255),
	disponivel tinyint(1) not null default 0,
	dtcadastro datetime not null,
	tipo tinyint(1) not null default 0 -- 0 secretária / 1 atendente
);

create table fila (
	codfila int auto_increment primary key,
	codfuncionario int not null,
	ra varchar(20) not null,
	status tinyint(1) not null default 0, -- 0 aguardando / 1 andamento / 2 finalizado
	foreign key (codfuncionario) references funcionario(codfuncionario)
);

create table atendimentos (
	codatendimento int auto_increment primary key,
	codfila int not null,
	dtinicio datetime,
	dtfim datetime,
	observacao longtext,
	foreign key (codfila) references fila(codfila)
);
