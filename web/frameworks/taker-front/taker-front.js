function getBody() {
    return document.getElementsByTagName('body')[0];
}

function criaModal(conteudo) {
    body = getBody();

    strModal = '<div class="modal-bg" onclick="fechaModal()"></div>';

    strModal += '<div class="modal">';
        strModal += conteudo;
    strModal += '</div>';

    body.insertAdjacentHTML('beforeend', strModal);
}

function fechaModal() {
    document.getElementsByClassName('modal')[0].remove();
    document.getElementsByClassName('modal-bg')[0].remove();
}