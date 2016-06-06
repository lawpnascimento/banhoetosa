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
                  alert(dados);
                    jbkrAlert.sucesso('Animais', 'Animais cadastrado com sucesso!');
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

function buscaAgendamentos(cdAnimal){
    var txbNome = $('#txbNome').text();
    var txbRaca =  $('#txbRaca').text();
    var txbIdade =  $('#txbIdade').text();

    if($("#ddlPorte").text().trim() != $("#ddlPorte").attr("name")){
        ddlPorte = $("#ddlPorte").val();
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

            //Carregando a grid
            if(cdAnimal == null){

                var grid = "";
                for (var i = 0; i < json.length; i++) {
                    var animal = json[i];

                    grid = grid + "<tr>";
                    grid = grid + "<td>" + animal.nome + "</td>";
                    grid = grid + "<td>" + animal.raca + "</td>";
                    grid = grid + "<td>" + animal.idade + "</td>";
                    grid = grid + "<td>" + animal.porte + "</td>";
                    grid = grid + "<td href='javascript:void(0);' onClick='buscaAgendamentos(" + animal.cdAnimal + ")'><a>Editar</a></td>";
                    grid = grid + "</tr>";
                }
                $("#tbdUsuarioAgendamento").html(grid);
            }
            //Carregando valor para atualizar
            else
            {
                formularioModoAtualizar();
                for (var i = 0; i < json.length; i++) {
                    var agendamento = json[i];

                    $("#dtpAgendamento").val(agendamento.dtAgendamento);
                    $("#ddlHorarioDe:first-child").text(agendamento.hrInicial);
                    $("#ddlHorarioAte:first-child").text(agendamento.hrFinal);
                    $("#ddlAnimal:first-child").text(agendamento.nmAnimal);
                    $("#ddlAnimal:first-child").val(agendamento.cdAnimal);
                    $("#hdfcdAgendamento").val(agendamento.cdAgendamento);
                }
            }
        }
    });

};
