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
        }
  });

});
