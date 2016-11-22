var grid = "";

$(document).ready(function(){
  $('input[type="date"]').change(function(){

    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "buscahoraparametrizada"
        },

        url: "../controller/PrincipalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);
            var hrInicial = 0;
            var hrFinal = 0;

            for (var i = 0; i < json.length; i++) {

                var parametrizacao = json[i];
                hrInicial = parametrizacao.hrInicial;
                hrFinal   = parametrizacao.hrFinal;

            }


            //Busca a hora inicial e a hora final parametrizada e faz um loop
            for (var j = hrInicial; j <= parseInt(hrFinal) - 1; j++){
                validaHorarioAgendamento(j, parseInt(j) + 1, $('input[type="date"]').val());
            }


        }

    });

  });

  function validaHorarioAgendamento(horarioDe, horarioAte, data){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            data: data,
            horarioDe: horarioDe,
            horarioAte: horarioAte,
            action: "validahorarioagendamento"
        },

        url: "../controller/PrincipalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          if(dados == 1){
              grid = grid + "<tr style='background-color:red'>";
              grid = grid + "<td>" + horarioDe + "</td>";
              grid = grid + "</tr>";
          }
          else if(dados == 2){
              grid = grid + "<tr style='background-color:green'>";
              grid = grid + "<td>" + horarioDe + "</td>";
              grid = grid + "</tr>";
          }

          $("#grdPrincipal").html(grid);
        }

    });
  }

  $("#btnAnimais").click(function(){
      $.ajax({

          type: "POST",
          dataType: "text",

          url: "AnimaisView.php",

          success: function(dados){
              $("#main").html(dados);
              buscaAnimais();
              buscaPorteDropdown();
              buscaAnimais();
          }
      });
  });

  $("#btnAgendamentos").click(function(){
      $.ajax({

          type: "POST",
          dataType: "text",

          url: "AgendamentosView.php",

          success: function(dados){
              $("#main").html(dados);
              buscaAgendamentos();
              buscaAnimaisDropDown();
          }
      });
  });

  $("#btnPerfil").click(function(){
      $.ajax({

          type: "POST",
          dataType: "text",

          url: "PerfilView.php",

          success: function(dados){
              $("#main").html(dados);
          }
      });
  });

  $("#btnMudarFoto").click(function(){
      $.ajax({

          type: "POST",
          dataType: "text",

          url: "FotoPerfilView.php",

          success: function(dados){
              $("#main").html(dados);
          }
      });
  });

  $("#btnAvaliacao").click(function(){
      $.ajax({
          type: "POST",
          dataType: "text",

          url: "AvaliacaoView.php",

          success: function(dados){
              $("#main").html(dados);
              buscaAgendamentos();
          }
    });

  });

  $("#btnParametrizacao").click(function(){
      $.ajax({
          type: "POST",
          dataType: "text",

          url: "ParametrizacaoView.php",

          success: function(dados){
              $("#main").html(dados);
              buscaUsuariosDropdown();
              buscaPerfisDropdown();
              buscaSituacoesDropdown();
          }
    });

  });


  $("#btnAjuda").click(function(){
      $.ajax({
          type: "POST",
          dataType: "text",

          url: "AjudaView.php",

          success: function(dados){
              $("#main").html(dados);
          }
    });

  });

  $("#btnCliente").click(function(){
      $.ajax({
          type: "POST",
          dataType: "text",

          url: "ClienteView.php",

          success: function(dados){
              $("#main").html(dados);
              buscaClientes();
          }
    });

  });
});
