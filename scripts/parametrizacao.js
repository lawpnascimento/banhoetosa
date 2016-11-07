$("#parametrizacaoForm #btnAtualizar").click(function () {
    var txbEmpresa = $("#txbEmpresa").val();
    var ddlUsuario = $("#ddlUsuario").val();
    var ddlPerfil = $("#ddlPerfil").val();
    var ddlSituacao = $("#ddlSituacao").val();
    var txbHorarioDe = $("#txbHorarioDe").val();
    var txbHorarioAte = $("#txbHorarioAte").val();

    validaCampos(txbEmpresa, ddlUsuario, ddlPerfil, ddlSituacao, txbHorarioDe, txbHorarioAte);

    if(msgErro != "")
        jbkrAlert.alerta('Alerta!',msgErro);
    else{
        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                empresa: txbEmpresa,
                usuario: ddlUsuario,
                perfil: ddlPerfil,
                situacao: ddlSituacao,
                horarioDe: txbHorarioDe,
                horarioAte: txbHorarioAte,
                action: "atualizar"
            },

            url: "../controller/ParametrizacaoController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                jbkrAlert.sucesso('Animais', 'Animal atualizado com sucesso!');
                $("#parametrizacaoForm #btnCancelar").trigger("click");
            }

        });
    }
});

function buscaUsuariosDropdown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "usuariosdropdown"
        },

        url: "../controller/ParametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var usuario = json[i];

                dropdown = dropdown + '<li class="liUsuarios" role="presentation" value="' + usuario.cdUsuario  + '"><a role="menuitem" tabindex="-1" href="#">' + usuario.dsNome + '</a></li>';

            }
            $("#ulUsuario").html(dropdown);

            $("#ulUsuario li a").click(function(){

                $("#ddlUsuario:first-child").text($(this).text());

                $("#ulUsuario li").each(function(){

                    if ($(this).text() == $("#ddlUsuario").text().trim()){
                        $("#ddlUsuario").val($(this).val());
                    }
                });

            });

            cliqueDropDownUsuarios();
        }

    });
}

function buscaPerfisDropdown(){


    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "perfisdropdown"
        },

        url: "../controller/parametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var perfil = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + perfil.cdPerfil  + '"><a role="menuitem" tabindex="-1" href="#">' + perfil.dsPerfil + '</a></li>';

            }
            $("#ulPerfil").html(dropdown);

            $("#ulPerfil li a").click(function(){

                $("#ddlPerfil:first-child").text($(this).text());

                $("#ulPerfil li").each(function(){

                    if ($(this).text() == $("#ddlPerfil").text().trim()){
                        $("#ddlPerfil").val($(this).val());
                    }
                });

            });
        }

    });
}

function buscaPerfisDropdownUsuario(usuario){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            usuario: usuario,
            action: "perfisdropdownusuario"
        },

        url: "../controller/parametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";

            for (var i = 0; i < json.length; i++) {

                var perfil = json[i];

                $("#ddlPerfil:first-child").text(perfil.dsPerfil);
                $("#ddlPerfil:first-child").val(perfil.cdPerfil);

            }

        }

    });
}

function buscaSituacaoDropdownUsuario(usuario){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            usuario: usuario,
            action: "situacaodropdownusuario"
        },

        url: "../controller/parametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";

            for (var i = 0; i < json.length; i++) {

                var situacao = json[i];

                $("#ddlSituacao:first-child").text(situacao.dsConstante);
                $("#ddlSituacao:first-child").val(situacao.cdConstante);

            }

        }

    });
}

function buscaSituacoesDropdown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "situacoesdropdown"
        },

        url: "../controller/parametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {

            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var situacao = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + situacao.cdSituacao  + '"><a role="menuitem" tabindex="-1" href="#">' + situacao.dsSituacao + '</a></li>';

            }
            $("#ulSituacao").html(dropdown);

            $("#ulSituacao li a").click(function(){

                $("#ddlSituacao:first-child").text($(this).text());

                $("#ulSituacao li").each(function(){

                    if ($(this).text() == $("#ddlSituacao").text().trim()){
                        $("#ddlSituacao").val($(this).val());
                    }
                });

            });
        }

    });
  }

/*Função deve ser chamada dentro da função que carrega a dropdown assim é possível realizar um onclick dos itens da dropdown*/
function cliqueDropDownUsuarios(){
  $("#ulUsuario li a").click(function(){

    $("#ulUsuario li").each(function(){

        if ($(this).text() == $("#ddlUsuario").text().trim()){
          buscaPerfisDropdownUsuario($(this).val());
          buscaSituacaoDropdownUsuario($(this).val());
        }
    });

  });

}

function validaCampos(empresa, usuario, perfil, situacao, horarioDe, horarioAte){
    var msgErro = "";
    if(empresa == ""){
        msgErro = msgErro + "<b>Empresa</b> e um campo de preenchimento obrigatorio";
    }
    if(horarioDe == ""){
        msgErro = msgErro + "</br><b>Horario De</b> e um campo de preenchimento obrigatorio";
    }
    if(horarioAte == ""){
        msgErro = msgErro + "</br><b>Horario Ate</b> e um campo de preenchimento obrigatorio";
    }

    return msgErro;

}

function buscaParametrizacao(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: cdAnimal,
            nome: txbNome,
            raca: txbRaca,
            idade: txbIdade,
            porte: ddlPorte,
            action: "buscar"
        },

        url: "../controller/ParametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            for (var i = 0; i < json.length; i++) {
                var animal = json[i];

                $("#txbNome").val(animal.dsNome);
                $("#txbRaca").val(animal.dsRaca);
                $("#txbIdade").val(animal.nrIdade);

                $("#ddlPorte:first-child").text(animal.dsPorte);
                $("#ddlPorte:first-child").val(animal.cdPorte);
                $("#hdfcdAnimal").val(animal.cdAnimal);
                }
        }
    });

};
