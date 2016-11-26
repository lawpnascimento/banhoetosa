var grid = "";

$(document).ready(function(){
  var now = new Date();
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);

  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

  $('input[type="date"]').val(today);

  buscaHorario();

  $('input[type="date"]').change(function(){
    buscaHorario();


  });

  function buscaHorario(){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            data: $('input[type="date"]').val(),
            action: "buscahoraparametrizada"
        },

        url: "../controller/PrincipalController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
          $("#grdPrincipal").html(dados);

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
              buscaUsuario();
              buscaEmpresa();
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
