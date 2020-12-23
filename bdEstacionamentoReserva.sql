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
dataEntrada, horarioSaida, dataSaida)
values(1, 'Alfredo', 'SDF-0261', 'Corsa', 'Prata', 'Carro', current_time(), current_date(), null, null);


#PARA VERIFICAR A DIFERENÇA DE HORAS QUE O CLIENTE FICOU NO ESTACIONAMENTO
#O número foi negativo pois a entrada foi num dia e a saída foi em outro, por isso usamos o datetime.
select (timediff(horarioSaida, horarioEntrada) <= 1) as horas from tblClientes;

select *, timediff(dataSaida, dataEntrada) as tempoPermanencia from tblClientes;



#PARA ATUALIZAR AS INFORMAÇÕES DA TABELA
UPDATE `tblClientes` SET `horarioSaida` = current_time(), `dataSaida` = current_date()
WHERE `idCliente` = 1;




show tables;

select tblClientes.idCliente, tblClientes.nomeCliente, tblClientes.placaVeiculo, tblClientes.modeloVeiculo, 
tblClientes.corVeiculo, tblClientes.tipoVeiculo, tblClientes.horarioEntrada, tblClientes.dataEntrada,
tblClientes.horarioSaida, tblClientes.dataSaida
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
select tblClientes.*, tblValores.valor
from tblClientes, tblValores
where tblClientes.idValor = tblValores.idValor;

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

select hour(timediff(horarioEntrada,horarioSaida)) as diferenca
                from tblClientes
                where idCliente = 1;





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

select valor from tblValores where idValor = 1;

insert into tblValores(valor, idCobranca)
values('R$ 120,00', 9);

UPDATE `tblValores` SET `valor` = "R$ 120,00", `idCobranca` = 3
WHERE `idValor` = 5;

delete from tblValores where idValor = 5;


create table tblTipoCobranca(
	idCobranca int not null auto_increment primary key,
    tipoDeCobranca varchar(30) not null
);

insert into tblTipoCobranca(tipoDeCobranca) values('Diária');

select * from tblTipoCobranca;

select tblTipoCobranca.idCobranca, tblTipoCobranca.tipoDeCobranca from tblTipoCobranca where tblTipoCobranca.idCobranca=2;


delete from tbltipocobranca where idCobranca >2 and idCobranca <9;








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