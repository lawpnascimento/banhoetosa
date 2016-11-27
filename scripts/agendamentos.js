function buscaAgendamentos(cdAgendamento){
    var txbData = $("#dtpAgendamento").val();
    var txbHorarioDe = $("#txbHorarioDe").val();
    var txbHorarioAte = $("#txbHorarioAte").val();
    var ddlTipoPagamento = $("#ddlPagamento").val();
    var ddlAnimal = $("#ddlAnimal").val();

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: cdAgendamento,
            data: txbData,
            horarioDe: txbHorarioDe,
            horarioAte: txbHorarioAte,
            tipoPagamento: ddlTipoPagamento,
            animal: ddlAnimal,
            action: "buscar"
        },

        url: "../controller/AgendamentoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            //Carregando a grid
            if(cdAgendamento == null){

                var grid = "";
                for (var i = 0; i < json.length; i++) {
                    var agendamento = json[i];

                    grid = grid + "<tr>";
                    grid = grid + "<td>" + agendamento.dtAgendamento + "</td>";
                    grid = grid + "<td>" + agendamento.hrInicial + "</td>";
                    grid = grid + "<td>" + agendamento.hrFinal + "</td>";
                    grid = grid + "<td>" + agendamento.nmAnimal + "</td>";
                    grid = grid + "<td>" + agendamento.dsPagamento + "</td>";
                    grid = grid + "<td>" + agendamento.dsSituacao + "</td>";
                    grid = grid + "<td href='javascript:void(0);' onClick='buscaAgendamentos(" + agendamento.cdAgendamento + ")'><a>Editar</a></td>";
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

                    var partes = agendamento.dtAgendamento.split('/');
                    //please put attention to the month (parts[0]), Javascript counts months from 0:
                    // January - 0, February - 1, etc
                    var data = partes[2] + "-" + partes[1] + "-" + partes[0];

                    $("#dtpAgendamento").val(data);
                    $("#txbHorarioDe").val(agendamento.hrInicial);
                    $("#txbHorarioAte").val(agendamento.hrFinal);
                    $("#ddlAnimal:first-child").text(agendamento.nmAnimal);
                    $("#ddlAnimal:first-child").val(agendamento.cdAnimal);
                    $("#ddlPagamento:first-child").val(agendamento.cdPagamento);
                    $("#ddlPagamento:first-child").text(agendamento.dsPagamento);
                    $("#hdfcdAgendamento").val(agendamento.cdAgendamento);
                }
            }
        }
    });

};

function buscaAnimaisDropDown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "animaldropdown"
        },

        url: "../controller/AgendamentoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var animais = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + animais.cdAnimal  + '"><a role="menuitem" tabindex="-1" href="#">' + animais.dsNome + '</a></li>';

            }
            $("#ulAnimal").html(dropdown);

            $("#ulAnimal li a").click(function(){

                $("#ddlAnimal:first-child").text($(this).text());

                $("#ulAnimal li").each(function(){

                    if ($(this).text() == $("#ddlAnimal").text().trim()){
                        $("#ddlAnimal").val($(this).val());
                    }
                });

            });
        }

    });
}

function buscaTipoPagamentoDropDown(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "tipopagamentodropdown"
        },

        url: "../controller/AgendamentoController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            var dropdown = "";
            for (var i = 0; i < json.length; i++) {

                var tipoPagamento = json[i];

                dropdown = dropdown + '<li role="presentation" value="' + tipoPagamento.cdPagamento  + '"><a role="menuitem" tabindex="-1" href="#">' + tipoPagamento.dsPagamento + '</a></li>';

            }
            $("#ulPagamento").html(dropdown);

            $("#ulPagamento li a").click(function(){

                $("#ddlPagamento:first-child").text($(this).text());

                $("#ulPagamento li").each(function(){

                    if ($(this).text() == $("#ddlPagamento").text().trim()){
                        $("#ddlPagamento").val($(this).val());
                    }
                });

            });
        }

    });
}

$("#document").ready(function() {
     $('#txbHorarioDe').mask('00:00:00');
     $('#txbHorarioAte').mask('00:00:00');
    $("#agendamentosform #btnCadastrar").click(function () {

        var txbData = $("#dtpAgendamento").val();
        var txbHorarioDe = $("#txbHorarioDe").val();
        var txbHorarioAte = $("#txbHorarioAte").val();
        var ddlTipoPagamento = $("#ddlPagamento").val();
        var ddlAnimal = $("#ddlAnimal").val();

        if(validaCampos(txbData, txbHorarioDe,txbHorarioAte,ddlAnimal) != ""){
            jbkrAlert.alerta('Alerta!',msgErro);
        }
        else{
            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    data: txbData,
                    horarioDe: txbHorarioDe,
                    horarioAte: txbHorarioAte,
                    tipoPagamento: ddlTipoPagamento,
                    animal: ddlAnimal,
                    action: "cadastrar"
                },

                url: "../controller/AgendamentoController.php",

                //Se der tudo ok no envio...
                success: function (dados) {

                    var json = $.parseJSON(dados);

                    //Erro horario
                    if (json.status == 1)
                      jbkrAlert.sucesso('Agendamentos', json.mensagem);
                    else
                      jbkrAlert.alerta('Alerta', json.mensagem);

                    $("#agendamentosform #btnCancelar").trigger("click");
                }
            });
        }
    });

    $("#agendamentosform #btnBuscar").click(function(){

        buscaAgendamentos();

    });

    $("#agendamentosform #btnCancelar").click(function(){
        limpaCampos($("#btnCancelar").closest("form"));
        formularioModoInserir();
        buscaAgendamentos();
    });

    $("#agendamentosform #btnAtualizar").click(function () {

        var txbData = $("#dtpAgendamento").val();
        var txbHorarioDe = $("#txbHorarioDe").val();
        var txbHorarioAte = $("#txbHorarioAte").val();
        var ddlTipoPagamento = $("#ddlPagamento").val();
        var ddlAnimal = $("#ddlAnimal").val();
        var cdAgendamento = $("#hdfcdAgendamento").val();

        if(validaCampos(txbData, txbHorarioDe,txbHorarioAte,ddlAnimal) != ""){
            jbkrAlert.alerta('Alerta!',msgErro);
        }
        else{
            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    data: txbData,
                    horarioDe: txbHorarioDe,
                    horarioAte: txbHorarioAte,
                    tipoPagamento: ddlTipoPagamento,
                    animal: ddlAnimal,
                    codigo: cdAgendamento,
                    action: "atualizar"
                },

                url: "../controller/AgendamentoController.php",

                //Se der tudo ok no envio...
                success: function (dados) {
                    jbkrAlert.sucesso('Agendamentos', 'Agendamento atualizado com sucesso!');
                    $("#agendamentosform #btnCancelar").trigger("click");
                }
            });
        }
    });

    $("#agendamentosform #btnExcluir").click(function () {

        var cdAgendamento = $("#hdfcdAgendamento").val();

        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                codigo: cdAgendamento,
                action: "excluir"
            },

            url: "../controller/AgendamentoController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                jbkrAlert.sucesso('Agendamentos', 'Agendamento excluído com sucesso!');
                $("#agendamentosform #btnCancelar").trigger("click");
            }
        });

        $("#ulHorarioDe li a").click(function(){
            $("#ddlHorarioDe:first-child").text($(this).text());
        });

        $("#ulHorarioAte li a").click(function(){
            $("#ddlHorarioAte:first-child").text($(this).text());
        });

        $("#ulPagamento li a").click(function(){
            $("#ddlPagamento:first-child").text($(this).text());

            $("#ulPagamento li").each(function(){

                if ($(this).text() == $("#ddlPagamento").text().trim()){
                    $("#ddlPagamento").val($(this).val());
                }
            });
        });

        $("#ulAnimal li a").click(function(){
            $("#ddlAnimal:first-child").text($(this).text());

            $("#ulAnimal li").each(function(){

                if ($(this).text() == $("#ddlAnimal").text().trim()){
                    $("#ddlAnimal").val($(this).val());
                }
            });

        });
    });

    $("#ulPagamento li a").click(function(){

        $("#ddlPagamento:first-child").text($(this).text());

        $("#ulPagamento li").each(function(){

            if ($(this).text() == $("#ddlPagamento").text().trim()){
                $("#ddlPagamento").val($(this).val());
            }
        });
    });

});

function validaCampos(data, horarioDe, horarioAte, animal){
    msgErro = "";
    if(data == ""){
        msgErro = msgErro + "<b>Data</b> é um campo de preenchimento obrigatório";
    }
    if(horarioDe.trim() == "De"){
        msgErro = msgErro + "</br><b>Horário De</b> é um campo de preenchimento obrigatório";
    }
    if(horarioAte.trim() == "Até"){
        msgErro = msgErro + "</br><b>Horário Até</b> é um campo de preenchimento obrigatório";
    }
    if(animal == ""){
        msgErro = msgErro + "</br><b>Animal</b> é um campo de preenchimento obrigatório";
    }

    return msgErro;

}
