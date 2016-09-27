$("#animaisform #btnAtualizar").click(function () {

    var txbNome = $("#txbNome").val();
    var txbRaca = $("#txbRaca").val();
    var txbIdade = $("#txbIdade").val();
    var ddlPorte = $("#ddlPorte").val();
    var cdAnimal = $("#hdfcdAnimal").val();

    if(validaCampos(txbNome, txbRaca, ddlPorte) != ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                nome: txbNome,
                raca: txbRaca,
                idade: txbIdade,
                porte: ddlPorte,
                codigo: cdAnimal,
                action: "atualizar"
            },

            url: "../controller/AnimalController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                jbkrAlert.sucesso('Animais', 'Animal atualizado com sucesso!');
                $("#animaisform #btnCancelar").trigger("click");
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

        url: "../controller/parametrizacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var usuario = json[i];

                dropdown = dropdown + '<li class="liUsuarios" role="presentation" value="' + usuario.cdUsuario  + '"><a role="menuitem" tabindex="-1" href="#">' + usuario.dsNome + '</a></li>';

            }
            $("#ulUsuarios").html(dropdown);

            $("#ulUsuarios li a").click(function(){

                $("#ddlUsuarios:first-child").text($(this).text());

                $("#ulUsuarios li").each(function(){

                    if ($(this).text() == $("#ddlUsuarios").text().trim()){
                        $("#ddlUsuarios").val($(this).val());
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
function cliqueDropDownUsuarios()
{
  $("#ulUsuarios li a").click(function(){

    $("#ulUsuarios li").each(function(){

        if ($(this).text() == $("#ddlUsuarios").text().trim()){
          buscaPerfisDropdownUsuario($(this).val());
          buscaSituacaoDropdownUsuario($(this).val());
        }
    });

  });

}
