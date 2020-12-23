'use strict';

const nomeCliente     = document.getElementById('cliente');
const horarioEntrada  = document.getElementById('cadastroDefinicaoHorarioCheckIn');
const horarioSaida = document.getElementById('cadastroDefinicaoHorarioCheckOut');

//METOTO GET
const getClientes = () =>{
    const url = `http://localhost/karina/Projeto_integrado_Marcel_Leonid/api/indexControleClientes.php/controleClientes`;
    fetch(url).then(response => response.json())
              .then(data =>  clientes(data));
}

const insertToElement = (element) => {
    const tr = document.createElement('tr');
    
    tr.classList.add('trFuncional');
    
    tr.innerHTML = `
        <td class="conteudoAzul rsNomeCliente">${element.nomeCliente}</td>
        <td class="conteudoAmarelo rsHorarioCheckIn">${element.horarioEntrada}</td>
        <td class="conteudoAzul rsHorarioCheckOut">${element.horarioSaida}</td>
    `;
    return tr;
}

const clientes = (data) => {
    const container = document.getElementById('tblControleClientes');
    data.forEach(element => {
        container.appendChild(insertToElement(element));
    });
}

getClientes();

