const valor = document.getElementById(inserirValorPorHora);
const tipoCobranca = document.getElementById(inserirTipoCobranca);
const botaoInserir = document.querySelector('#cadastrarValorPorHora');


//FUNCTION CMS PREÇO GET

const getPrecos = () =>{
    const url = `http://localhost/Leticia/KARINA_Projeto_integrado_Marcel_Leonid/api/indexPrecos.php/precos`;
    fetch(url).then(response => response.json())
              .then(data =>  calcPreco(data));
}

const insertToElement = (element) => {
    const tr = document.createElement('tr');
    
    tr.classList.add('trFuncional');
    
    tr.innerHTML = `
        <td class="rsValor">${element.valor}</td>
        <td class="rsTipoCobranca">${element.tipoDeCobranca}</td>
    `;
    return tr;
}

const calcPreco = (data) => {
    const container = document.getElementById('table');
    data.forEach(element => {
        container.appendChild(insertToElement(element));
    });
}

getPrecos();

//FUNCTION CMS PREÇO POST

function createEntrada(entrada) {
    const url = 'http://localhost/Leticia/KARINA_Projeto_integrado_Marcel_Leonid/api/indexPrecos.php/precos';
    
    const options = {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(entrada)
    };
    
    fetch(url, options);
}

let entrada;

const getDados = () => {
    entrada = {
        "valor": valor.value,
        "tipoCobranca": tipoCobranca.value
    }
    
    createEntrada(entrada);
}

botaoInserir.addEventListener('click', getDados);
createEntrada(entrada);