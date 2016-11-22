var jbkrAlert = (function () {
    var criarModal = function () {
        var modal = $('<div class="modal modal-alerta"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div></div></div></div>');
        modal.modal('show').on('hidden', function () {
            $('.modal-alerta').remove();
        });
    };

    var exibirAlerta = function (titulo, mensagem) {
        criarModal();
        var conteudo = $('<div class="alert alert-warning"> <div style="background-color: #FFEED5">' +
        '<b><i class="icon-warning-sign"></i> ' + titulo + '</b></div></br>' +
        '' + mensagem + '' +
        '<button type="button" class="btn btn-warning" data-dismiss="modal">Fechar</button></div>');
        $('.modal-alerta .modal-body').html(conteudo);

    };

    var exibirErro = function (titulo, mensagem) {
        criarModal();
        var conteudo = $('<div class="alert alert-danger"><div style="background-color: #F5D2D2">' +
        '<b><i class="icon-exclamation-sign"></i> ' + titulo + '</b></div></br>' +
        '' + mensagem + '' +
        '<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button></div>');
        $('.modal-alerta .modal-body').html(conteudo);
    };

    var exibirSucesso = function (titulo, mensagem) {
        criarModal();
        var conteudo = $('<div class="alert alert-success"><div style="background-color: #D6EDCC">' +
        '<b><i class="icon-info-sign"></i> ' + titulo + '</b></div></br>' +
        '' + mensagem + '' +
        '<button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button></div>');
        $('.modal-alerta .modal-body').html(conteudo);
    };

    return {
        alerta: exibirAlerta,
        erro: exibirErro,
        sucesso: exibirSucesso
    };
})();
