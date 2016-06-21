function buscaClientes(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "buscar"
        },

        url: "../controller/ClienteController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            //Carregando a grid
            var grid = "";
            for (var i = 0; i < json.length; i++) {
                var cliente = json[i];


                grid = grid + "<tr>";
                grid = grid + "<td>" + cliente.cdUsuario + "</td>";
                grid = grid + "<td>" + cliente.dsNome + "</td>";
                grid = grid + "<td>" + cliente.dsEmail + "</td>";
                grid = grid + "<td>" + cliente.nrCpf + "</td>";
                grid = grid + "<td>" + cliente.nrTelefone + "</td>";
                grid = grid + "<td>" + cliente.dsPerfil + "</td>";
                /*grid = grid + "<td style='width: 75px'; href='javascript:void(0);' onClick='aprovarAgendamento(" + agendamento.cdAgendamento + ")'><a style='color:green;'>Tornar Atendente</a></td>";
                grid = grid + "<td style='width: 75px'; href='javascript:void(0);' onClick='reprovarAgendamento(" + agendamento.cdAgendamento + ")'><a style='color:red;'>Tornar Cliente</a></td>";*/
                grid = grid + "</tr>";
            }
            $("#tbCliente").html(grid);
        }
    });

};
