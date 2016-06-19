

function buscaAgendamentos(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "buscar"
        },

        url: "../controller/AvaliacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            //Carregando a grid
            var grid = "";
            for (var i = 0; i < json.length; i++) {
                var agendamento = json[i];


                grid = grid + "<tr>";
                grid = grid + "<td>" + agendamento.dtAgendamento + "</td>";
                grid = grid + "<td>" + agendamento.hrInicial + "</td>";
                grid = grid + "<td>" + agendamento.hrFinal + "</td>";
                grid = grid + "<td>" + agendamento.nmUsuario + "</td>";
                grid = grid + "<td>" + agendamento.nmAnimal + "</td>";
                grid = grid + "<td style='width: 75px'; href='javascript:void(0);' onClick='aprovarAgendamento(" + agendamento.cdAgendamento + ")'><a style='color:green;'>Aprovar</a></td>";
                grid = grid + "<td style='width: 75px'; href='javascript:void(0);' onClick='reprovarAgendamento(" + agendamento.cdAgendamento + ")'><a style='color:red;'>Reprovar</a></td>";
                grid = grid + "</tr>";
            }
            $("#tbAvaliacaoAgendamento").html(grid);
        }
    });

};


function aprovarAgendamento(cdAgendamento)
{
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            agendamento: cdAgendamento,
            action: "aprovaragendamento"
        },

          url: "../controller/AvaliacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            jbkrAlert.sucesso('Agendamentos', 'Agendamento aprovado com sucesso!');
            buscaAgendamentos();
        }
    });
}

function reprovarAgendamento(cdAgendamento)
{
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            agendamento: cdAgendamento,
            action: "reprovaragendamento"
        },

          url: "../controller/AvaliacaoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            jbkrAlert.sucesso('Agendamentos', 'Agendamento reprovado com sucesso!');
            buscaAgendamentos();
        }
    });
}
