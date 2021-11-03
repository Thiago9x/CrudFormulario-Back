create database dbcontatos20212t;

show databases;

use dbcontatos20212t;

create table tblcliente (
	idclient int not null auto_increment primary key,
    nome varchar(100) not null,
    rg varchar(17) not null,
    cpf varchar(17) not null,
    telefone varchar(17),
    celular varchar(17),
    email varchar(60),
    obs text
);

select * from tblestado; 


select tblcliente.*,tblEstado.sigla from tblcliente
	inner join tblEstado
		on tblEstado.idEstado = tblCliente.idEstado;

