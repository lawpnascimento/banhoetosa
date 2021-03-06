$("#document").ready(function() {
    $("#animaisform #btnCadastrar").click(function () {

	      var txbNome = $("#txbNome").val();
        var txbRaca = $("#txbRaca").val();
        var txbIdade = $("#txbIdade").val();
        var ddlPorte = $("#ddlPorte").val();

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
                    action: "cadastrar"
                },

                url: "../controller/AnimalController.php",

                //Se der tudo ok no envio...
                success: function (dados) {
                    jbkrAlert.sucesso('Animal', 'Animal cadastrado com sucesso!');
                    $("#animaisform #btnCancelar").trigger("click");
                }
            });
        }
    });

    $("#animaisform #btnBuscar").click(function () {
      buscaAnimais();

    });

    $("#animaisform #btnCancelar").click(function(){
        limpaCampos($(this).closest("form"));
        formularioModoInserir();
        buscaAnimais();
    });

    $("#animaisform #btnExcluir").click(function () {

        var cdAnimal = $("#hdfcdAnimal").val();

        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                codigo: cdAnimal,
                action: "excluir"
            },

            url: "../controller/AnimalController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                var json = $.parseJSON(dados);
                jbkrAlert.sucesso('Animal', json[0].mensagem);
                $("#animaisform #btnCancelar").trigger("click");
            }
        });

    });

    $("#animaisform #btnAtualizar").click(function () {

        var txbNome = $("#txbNome").val();
        var txbRaca = $("#txbRaca").val();
        var txbIdade = $("#txbIdade").val();
        var ddlPorte = $("#ddlPorte").val();
        var cdAnimal = $("#hdfcdAnimal").val();

        var msgErro = validaCampos(txbNome, txbRaca, ddlPorte);

        if(msgErro != ""){
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
});

function buscaPorteDropdown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "portedropdown"
        },

        url: "../controller/AnimalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var porte = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + porte.cdPorte  + '"><a role="menuitem" tabindex="-1" href="#">' + porte.dsPorte + '</a></li>';

            }
            $("#ulPorte").html(dropdown);

            $("#ulPorte li a").click(function(){

                $("#ddlPorte:first-child").text($(this).text());

                $("#ulPorte li").each(function(){

                    if ($(this).text() == $("#ddlPorte").text().trim()){
                        $("#ddlPorte").val($(this).val());
                    }
                });

            });
        }

    });
}

function validaCampos(nome, raca, porte){
    msgErro = "";
    if(nome == ""){
        msgErro = msgErro + "<b>Nome</b> e um campo de preenchimento obrigatorio";
    }
    if(raca == ""){
        msgErro = msgErro + "</br><b>Raca</b> e um campo de preenchimento obrigatorio";
    }
    if(porte == ""){
        msgErro = msgErro + "</br><b>Porte</b> e um campo de preenchimento obrigatorio";
    }

    return msgErro;

}

function buscaAnimais(cdAnimal){
    var txbNome = $('#txbNome').val();
    var txbRaca =  $('#txbRaca').val();
    var txbIdade =  $('#txbIdade').val();

    if($("#ddlPorte").text().trim() != $("#ddlPorte").attr("name")){
        ddlPorte = $("#ddlPorte").val();
    }
    else {
      ddlPorte = "";
    }

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

        url: "../controller/AnimalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {

            var json = $.parseJSON(dados);
            var animal = null;
            //Carregando a grid
            if(cdAnimal == null){

                var grid = "";
                for (var i = 0; i < json.length; i++) {
                    animal = json[i];

                    grid = grid + "<tr>";
                    grid = grid + "<td>" + animal.dsNome + "</td>";
                    grid = grid + "<td>" + animal.dsRaca + "</td>";
                    grid = grid + "<td>" + animal.nrIdade + "</td>";
                    grid = grid + "<td>" + animal.dsPorte + "</td>";
                    grid = grid + "<td href='javascript:void(0);' onClick='buscaAnimais(" + animal.cdAnimal + ")'><a>Editar</a></td>";
                    grid = grid + "</tr>";
                }

                $("#tbanimal").html(grid);
            }
            //Carregando valor para atualizar
            else
            {
                formularioModoAtualizar();
                for (var j = 0; j < json.length; j++) {
                    animal = json[j];

                    $("#txbNome").val(animal.dsNome);
                    $("#txbRaca").val(animal.dsRaca);
                    $("#txbIdade").val(animal.nrIdade);

                    $("#ddlPorte:first-child").text(animal.dsPorte);
                    $("#ddlPorte:first-child").val(animal.cdPorte);
                    $("#hdfcdAnimal").val(animal.cdAnimal);
                }
            }
        }
    });

}

/*function validaExclusao(){
    var cdAnimal = $("#hdfcdAnimal").val();

    var retorno = "";
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: cdAnimal,
            action: "validaexclusao"
        },

        url: "../controller/AnimalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {

            var json = $.parseJSON(dados);

            var retorno = null;

            for (var i = 0; i < json.length; i++) {
                retorno = json[i];
            }
            return retorno.idExclusao;

        }

    });


}*/
