'use strict';

const nomeCliente     = document.getElementById('cliente');
const placaVeiculo    = document.getElementById('placa');
const modeloVeiculo   = document.getElementById('modelo');
const horarioCheckIn  = document.getElementById('cadastroDefinicaoHorarioCheckIn');
const horarioCheckOut = document.getElementById('cadastroDefinicaoHorarioCheckOut');
const botaoInserir    = document.querySelector('#botao');


//METODO POST
function criarCliente( cliente ) {
    const url = 'http://localhost/karina/Projeto_integrado_Marcel_Leonid/api/indexControleClientes.php/controleClientes';
    const options = {
      method: 'POST',
      headers: {

        'Content-Type':'application/json'

      },
      body: JSON.stringify(cliente)
     
    };
  
  fetch(url, options)
}

let cliente;
const inserirClientes = () => {
  cliente = {
    "nomeCliente"    : cliente.value,
    "placaVeiculo"   : placa.value,
    "modeloVeiculo"  : modelo.value,
    "horarioCheckIn" : cadastroDefinicaoHorarioCheckIn.value,   
    "horarioCheckOut": cadastroDefinicaoHorarioCheckOut.value   
  }
  criarCliente(cliente)
  location.reload()
};

botaoInserir.addEventListener('click', inserirClientes);
