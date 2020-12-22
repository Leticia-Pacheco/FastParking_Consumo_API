create database dbEstacionamento;
use dbEstacionamento;

create table tblCategoriaVeiculos(
	idCategoriaVeiculo int not null auto_increment primary key,
    nomeCategoria varchar(25) not null
);

insert into tblCategoriaVeiculos (nomeCategoria) 
values ('Ônibus');

select * from tblCategoriaVeiculos;




create table tblVeiculos(
	idVeiculo int not null auto_increment primary key,
    idCategoriaVeiculo int not null,
    placa varchar(10),
    modelo varchar(45),
    cor varchar(30),
    constraint FK_veiculos_categoriaVeiculos
    foreign key (idCategoriaVeiculo)
    references tblCategoriaVeiculos(idCategoriaVeiculo)
);

insert into tblVeiculos(idCategoriaVeiculo, placa, modelo, cor)
values(2, 'ftp-7485', 'HB20', 'preto');

select * from tblVeiculos;





create table tblClientes (
	idCliente int not null auto_increment primary key,
	idVeiculo int not null,
    idHorarioDataEntrada int not null,
    idHorarioDataSaida int not null,
    nomeCliente varchar(50) not null,
    constraint FK_clientes_veiculo
    foreign key (idVeiculo)
    references tblVeiculos(idVeiculo),
    constraint FK_clientes_HorarioDataEntrada
    foreign key (idHorarioDataEntrada)
    references tblHorarioDataEntrada(idHorarioDataEntrada),
    constraint FK_clientes_HorarioDataSaida
    foreign key (idHorarioDataSaida)
    references tblHorarioDataSaida(idHorarioDataSaida)
);

insert into tblClientes(idVeiculo, idHorarioDataEntrada, idHorarioDataSaida, nomeCliente, cnhCliente)
values(1, 1, 1, 'Karina Soares', '4829573640');

select * from tblClientes;

ALTER TABLE tblClientes DROP COLUMN cnhCliente;

insert into tblClientes ( nomeCliente, idVeiculo, idHorarioDataEntrada, idHorarioDataSaida ) values ( 'Karina Soares', 'GHG-8955', 'Fiat Uno', '2020-12-17', '17:39', '2020-12-19', '17:39' );



create table tblHorarioDataEntrada(
	idHorarioDataEntrada int not null auto_increment primary key,
    dataEntrada varchar(12),
    horarioEntrada varchar(12)
);

insert into tblHorarioDataEntrada(dataEntrada, horarioEntrada)
values('2020-12-14', '15:45');

select * from tblHorarioDataEntrada;





create table tblComprovanteEntrada (
	idComprovanteEntrada int not null auto_increment primary key,
	idHorarioDataEntrada int not null,
    idCliente int not null,
    codigoComprovante varchar(30) not null,
    constraint FK_ComprovanteEntrada_HorarioDataEntrada
    foreign key (idHorarioDataEntrada)
    references tblHorarioDataEntrada(idHorarioDataEntrada),
    constraint FK_ComprovanteEntrada_Cliente
    foreign key (idCliente)
    references tblClientes(idCliente)
);

insert into tblComprovanteEntrada(idHorarioDataEntrada, idCliente, codigoComprovante)
values(1, 1, 'KDGH256302');

select * from tblComprovanteEntrada;




create table tblControleInformacoesClientes (
	idControleInformacoesClientes int not null auto_increment primary key,
	idComprovanteEntrada int not null,
    controleInfoClientes varchar(50) not null,
    constraint FK_ControleInformacoesClientes_ComprovanteEntrada
    foreign key (idComprovanteEntrada)
    references tblComprovanteEntrada(idComprovanteEntrada)
);

select * from tblControleInformacoesClientes;






#Lado DIREITO da tabela de clientes



create table tblHorarioDataSaida(
	idHorarioDataSaida int not null auto_increment primary key,
    idValorFinal int not null,
    dataSaida varchar(15),
    horarioSaida varchar(10),
    constraint FK_horarioDataSaida_valorFinal
    foreign key (idValorFinal)
    references tblValorFinal(idValorFinal)
);


insert into tblHorarioDataSaida(idValorFinal, dataSaida, horarioSaida)
values(1, '2020-12-14', '15:50');

select * from tblHorarioDataSaida;





create table tblValorFinal(
	idValorFinal int not null auto_increment primary key,
    idValor int,
    valorTotal varchar(10),
    constraint FK_valorFinal_valores
    foreign key (idValor)
    references tblValores(idValor)
);

insert into tblValorFinal(idValor, valorTotal)
values(1, 'R$15,00');

select * from tblValorFinal;





create table tblValores(
	idValor int not null auto_increment primary key,
    valor varchar(12) not null,
    idCobranca int,
    constraint FK_valores_tipoCobranca
    foreign key (idCobranca)
    references tblTipoCobranca(idCobranca)
);
    

insert into tblValores(valor, idCobranca)
values('R$ 10,00', 1);

select * from tblValores;



create table tblTipoCobranca(
	idCobranca int not null auto_increment primary key,
    tipoDeCobranca varchar(30) not null
);

insert into tblTipoCobranca(tipoDeCobranca) values('Diária');

select * from tblTipoCobranca;





create table tblRendimentoDiario(
	idRendimentoDiario int not null auto_increment primary key,
    valorRendimentoDiario varchar(20)
);

select * from tblrendimentodiario;






create table tblRendimentoMensal(
	idRendimentoMensal int not null auto_increment primary key,
    idRendimentoDiario int not null,
    valorRendimentoMensal varchar(20),
    constraint FK_RendimentoMensal_RendimentoDiario 
    foreign key (idRendimentoDiario )
    references tblRendimentoDiario (idRendimentoDiario)
);

select * from tblRendimentoMensal;






create table tblRendimentoAnual(
	idRendimentoAnual int not null auto_increment primary key,
    idRendimentoMensal int not null,
    valorRendimentoAnual varchar(20),
    constraint FK_RendimentoAnual_RendimentoMensal 
    foreign key (idRendimentoMensal )
    references tblRendimentoMensal (idRendimentoMensal )
);

select * from tblrendimentoanual;