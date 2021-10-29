use dbcontatos20212t;

show tables;

create table tblEstado (
	idEstado int not null auto_increment primary key,
    sigla varchar(2) not null,
    nome varchar(20) not null,
    unique index(idEstado)
);

alter table tblcliente 
	add column idEstado int not null,
	add constraint FK_Estado_Cliente
		foreign key (idEstado)
        references tblEstado(idEstado);
    

delete from tblcliente where idcliente > 0;

select tblcliente.*, tblEstado.sigla 
	from tblcliente
	inner join tblEstado 
		on tblEstado.idEstado = tblCliente.idEstado;


insert into tblEstado (sigla, nome)
		values ('RJ', 'Rio de Janeiro');



