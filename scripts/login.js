$(document).ready(function(){
		$("#txbLogin").focus();
	});

	$("#loginform #txbSenha").keyUp(function(event){
	    if(event.keyCode == 13){
	        $("#btnLogin").click();
	    }
	});

$("#loginform #btnLogin").click(function(){
    var txbLogin = $("#txbLogin").val();
    var txbSenha = $("#txbSenha").val();
    var div =  $("#divErro");
    var mensagem = validaCamposLogin();
    if(mensagem == "") {
        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {login: txbLogin, senha: txbSenha},

            url: "../controller/LoginController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                var json = $.parseJSON(dados);

                if (json.status == 1 || json.status == 2) {
                    div.css("display", "block");
                    div.text(json.mensagem);
                }
                else {
                    $(location).attr('href', 'principal.php');
                }
            }
        });
    }
    else{
        div.css("display", "block");
        div.html(mensagem);
    }
});

$("#btnCadastro").click(function(){
    $('#loginbox').hide();
    $('#signupbox').show();
    limpaCampos($("#loginform"));
    $("#divErro").css("display","none");

});

function validaCamposLogin(){
    var txbLogin = $("#txbLogin");
    var txbSenha = $("#txbSenha");

    var mensagem = "";
    if(txbLogin.val() == ""){
        mensagem = mensagem.concat("<i>Informe o <b>Usuário</b></i><br/>");
    }
    if(txbSenha.val() == ""){
        mensagem = mensagem.concat("<i>Informe a <b>Senha</b></i>");
    }

    return mensagem;
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
