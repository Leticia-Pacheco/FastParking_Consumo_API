create database dbFastParking;
use dbFastParking;

show tables;



create table tblClientes (
	idCliente int not null auto_increment primary key,
    idValor int not null,
	nomeCliente varchar(50) not null,
    placaVeiculo varchar(10) not null,
    modeloVeiculo varchar(45) not null,
    corVeiculo varchar(20) not null,
    tipoVeiculo varchar(15) not null,
    horarioEntrada datetime,
    dataEntrada datetime,
    horarioSaida datetime,
    dataSaida datetime,
    
    constraint FK_entradaClientevalor
    foreign key (idValor)
    references tblValores(idValor)
);

insert into tblClientes(idValor, nomeCliente, placaVeiculo, modeloVeiculo, corVeiculo, tipoVeiculo, horarioEntrada, 
dataEntrada, horarioSaida,dataSaida)
values(1, 'Alfredo', 'SDF-0261', 'Corsa', 'Prata', 'Carro', current_time(), current_date(), null, null);

select * from tblClientes;

show tables;

select tblClientes.idCliente, tblClientes.nomeCliente, tblClientes.placaVeiculo, tblClientes.modeloVeiculo, 
tblClientes.corVeiculo, tblClientes.tipoVeiculo, tblClientes.horarioEntrada, tblClientes.dataSaida
        from tblClientes;

select tblClientes.idCliente, tblClientes.nomeCliente, tblClientes.placaVeiculo, tblClientes.modeloVeiculo, 
tblClientes.corVeiculo, tblClientes.tipoVeiculo, tblClientes.horarioEntrada, tblClientes.dataSaida
        from tblClientes;
						   

insert into tblClientes 
                    (
						idValor,
                        nomeCliente,
                        placaVeiculo,
                        modeloVeiculo,
                        corVeiculo,
                        tipoVeiculo
                    )
                    values
                    (
						'R$ 15,00',
						'Luana',
                        'IHB-6516',
                        'WRV',
                        'Verde',
						'Carro'
                    );


create table tblComprovanteEntrada (
	idComprovanteEntrada int not null auto_increment primary key,
	idCliente int not null,
    codigoComprovante varchar(30) not null,
    constraint FK_ComprovanteEntrada_Cliente
    foreign key (idCliente)
    references tblClientes(idCliente)
);

select * from tblComprovanteEntrada;




#Segmento DIREITO da tabela de clientes






create table tblValores(
	idValor int not null auto_increment primary key,
    valor varchar(12) not null,
    idCobranca int,
    constraint FK_valores_tipoCobranca
    foreign key (idCobranca)
    references tblTipoCobranca(idCobranca)
);

select tblValores.idValor, tblValores.valor, tblTipoCobranca.tipoDeCobranca
from tblValores, tblTipoCobranca
where tblValores.idCobranca = tblTipoCobranca.idCobranca;

insert into tblValores(valor, idCobranca)
values('R$ 98,00', 2);


create table tblTipoCobranca(
	idCobranca int not null auto_increment primary key,
    tipoDeCobranca varchar(30) not null
);

insert into tblTipoCobranca(tipoDeCobranca) values('Horas adicionais');

select * from tblTipoCobranca;

select tblTipoCobranca.idCobranca, tblTipoCobranca.tipoDeCobranca from tblTipoCobranca where tblTipoCobranca.idCobranca=2;











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