function buscaAgendamentos(cdAgendamento){
    var ddlHorarioDe = null;
    var ddlHorarioAte = null;
    var ddlAnimal = null;

    var txbData = $("#dtpAgendamento").val();

    if($("#ddlHorarioDe").text().trim() != $("#ddlHorarioDe").attr("name")){
        ddlHorarioDe = $("#ddlHorarioDe").text();
    }

    if($("#ddlHorarioAte").text().trim() != $("#ddlHorarioAte").attr("name")){
       ddlHorarioAte = $("#ddlHorarioAte").text();
    }
    if($("#ddlAnimal").text().trim() != $("#ddlAnimal").attr("name")){
        ddlAnimal = $("#ddlAnimal").val();
    }

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            codigo: cdAgendamento,
            data: txbData,
            horarioDe: ddlHorarioDe,
            horarioAte: ddlHorarioAte,
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

$("#document").ready(function() {
    $("#agendamentosform #btnCadastrar").click(function () {

        var txbData = $("#dtpAgendamento").val();
        var ddlHorarioDe = $("#ddlHorarioDe").text().trim();
        var ddlHorarioAte = $("#ddlHorarioAte").text().trim();
        var ddlTipoPagamento = $("#ddlPagamento").val();
        var ddlAnimal = $("#ddlAnimal").val();

        if(validaCampos(txbData, ddlHorarioDe,ddlHorarioAte,ddlAnimal) != ""){
            jbkrAlert.alerta('Alerta!',msgErro);
        }
        else{
            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    data: txbData,
                    horarioDe: ddlHorarioDe,
                    horarioAte: ddlHorarioAte,
                    tipoPagamento: ddlTipoPagamento,
                    animal: ddlAnimal,
                    action: "cadastrar"
                },

                url: "../controller/AgendamentoController.php",

                //Se der tudo ok no envio...
                success: function (dados) {
                    jbkrAlert.sucesso('Agendamentos', 'Agendamento cadastrado com sucesso!');
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
        var ddlHorarioDe = $("#ddlHorarioDe").text();
        var ddlHorarioAte = $("#ddlHorarioAte").text();
        var ddlTipoPagamento = $("#ddlPagamento").val();
        var ddlAnimal = $("#ddlAnimal").val();
        var cdAgendamento = $("#hdfcdAgendamento").val();

        if(validaCampos(txbData, ddlHorarioDe,ddlHorarioAte,ddlAnimal) != ""){
            jbkrAlert.alerta('Alerta!',msgErro);
        }
        else{
            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    data: txbData,
                    horarioDe: ddlHorarioDe,
                    horarioAte: ddlHorarioAte,
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

    $(function () {
        $('.datepicker').datepicker();
    });

    $("#ulHorarioDe li a").click(function(){
        if($("#ddlHorarioAte:first-child").text() <= $(this).text() && $("#ddlHorarioDe:first-child").text().trim() != "De"){
            jbkrAlert.alerta("Alerta", "Data 'De' deve ser maior que 'Até'");
        }
        else{
            $("#ddlHorarioDe:first-child").text($(this).text());
        }


    });

    $("#ulHorarioAte li a").click(function(){

        if($("#ddlHorarioDe:first-child").text() >= $(this).text() && $("#ddlHorarioAte:first-child").text().trim() != "Até"){
            jbkrAlert.alerta("Alerta", "Data 'De' deve ser maior que 'Até'");
        }
        else{
            $("#ddlHorarioAte:first-child").text($(this).text());
        }

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
