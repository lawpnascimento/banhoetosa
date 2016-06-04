$("#document").ready(function() {
    $("#animaisform #btnCadastrar").click(function () {

		    var txbNome = $("#txbNome").val();
        var txbRaca = $("#txbRaca").val();
        var txbIdade = $("#txbIdade").val();
        var txbPorte = $("#txbPorte").val();

        if(validaCampos(txbNome, txbRaca,txbPorte) != ""){
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
                    porte: txbPorte,
                    action: "cadastrar"
                },

                url: "../controller/AnimalController.php",

                //Se der tudo ok no envio...
                success: function (dados) {
                    jbkrAlert.sucesso('Animais', 'Animais cadastrado com sucesso!');
                    $("#animaisform #btnCancelar").trigger("click");
                }
            });
        }
	});
});

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
