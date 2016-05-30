$("#btnAnimais").click(function(){
    $.ajax({

        type: "POST",
        dataType: "text",

        url: "AnimaisView.php",

        success: function(dados){
            $("#main").html(dados);
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
