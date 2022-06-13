function mostrarNota(id) {
    if (id == 0) {
        criaModal(layoutNota());

        let tituloNota = document.getElementById('titulo-nota');

        if (tituloNota != undefined) {
            tituloNota.focus();
        }

        return;
    }

    let url = API + '?ac=notas';
    let headers = new Headers();
    headers.append("Content-Type", "application/json");

    let conteudo = {
        "usuarioid": usuarioId,
        "operacao": 'pesquisa',
        "id": id
    }

    let fetchData = {
        method: 'POST',
        body: JSON.stringify(conteudo),
        headers: headers
    }

    fetch(url, fetchData)
    .then((data) => data.json())
    .then(function(data) {
        criaModal(layoutNota(data[0].id, data[0].titulo, data[0].texto));

        let tituloNota = document.getElementById('titulo-nota');

        if (tituloNota != undefined) {
            tituloNota.focus();
        }
    });
}

function layoutNota(id = 0, titulo = '', texto = '') {
    let strConteudo = '<div class="modal-header">';
        strConteudo += '<input type="text" id="titulo-nota" placeholder="Digite o título" value="' + titulo  + '"/>';

        strConteudo += '<img class="salva-nota" onclick="salvarNota(' + id + ')" src="img/save.png"/>';
        strConteudo += '<img class="deleta-nota" onclick="deletarNota(' + id + ')" src="img/delete.png"/>';
    strConteudo += '</div>';

    strConteudo += '<textarea id="texto-nota" placeholder="Digite a descrição">' + texto  + '</textarea>';

    return strConteudo;
}

function novaNota() {
    mostrarNota(0);
}

function salvarNota(id) {
    let tituloNota = document.getElementById('titulo-nota').value;
    let textoNota = document.getElementById('texto-nota').value;

    let url = API + '?ac=notas';
    let headers = new Headers();
    headers.append("Content-Type", "application/json");

    let conteudo = {
        "usuarioid": usuarioId,
        "operacao": 'salvar',
        "id": id,
        "titulo": tituloNota,
        "texto": textoNota
    }

    let fetchData = {
        method: 'POST',
        body: JSON.stringify(conteudo),
        headers: headers
    }

    fetch(url, fetchData)
    /*.then((data) => data.json())
    .then(function(data) {
        fechaModal();
    });*/
    .then(
        function() {
            // fechaModal();
            location.href = "./";
        }
    );
}

function deletarNota(id) {
    let url = API + '?ac=notas';
    let headers = new Headers();
    headers.append("Content-Type", "application/json");

    let conteudo = {
        "usuarioid": usuarioId,
        "operacao": 'excluir',
        "id": id
    }

    let fetchData = {
        method: 'POST',
        body: JSON.stringify(conteudo),
        headers: headers
    }

    fetch(url, fetchData)
    /*.then((data) => data.json())
    .then(function(data) {
        fechaModal();
    });*/
    .then(
        function() {
            // fechaModal();
            location.href = "./";
        }
    );
}

function verOpcoes() {
    let body = getBody();

    body.classList.toggle('menu-opcoes-aberto');
}