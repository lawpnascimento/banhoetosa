$("#document").ready(function(){
    $("#btnCadastrar").click(function(){
        var div = $("#divMensagemCadastro");

        var mensagem = validaCampos();
        if(mensagem == ""){
            var txbUsuario = $("#txbUsuario").val();
            var txbSenhaCad = $("#txbSenhaCad").val();
            var txbEmail = $("#txbEmail").val();
            var txbNome = $("#txbNome").val();
            var txbSobrenome = $("#txbSobrenome").val();
            var txbCpf = $("#txbCpf").val();

            $.ajax({
                //Tipo de envio POST ou GET
                type: "POST",
                dataType: "text",
                data: {
                    login: txbUsuario,
                    senha: txbSenhaCad,
                    email: txbEmail,
                    nome: txbNome,
                    sobrenome: txbSobrenome,
                    cpf: txbCpf
                },

                url: "../controller/CadastroController.php",

                //Se der tudo ok no envio...
                success: function (dados) {

                    var json = $.parseJSON(dados);

                    if (json.status == 1 ||
                        json.status == 2 ||
                        json.status == 3) {
                        div.css("display", "block");
                        div.removeClass("alert alert-success col-sm-12");
                        div.addClass("alert alert-danger col-sm-12");
                        div.text(json.mensagem);
                    }
                    else {
                        div.css("display", "block");
                        div.removeClass("alert alert-danger col-sm-12");
                        div.addClass("alert alert-success col-sm-12");
                        div.text(json.mensagem);
                        limpaCampos($("#signupform"));
                    }
                }
            });
        }
        else{
            div.css("display", "block");
            div.html(mensagem);
        }

    });

    $("#signinlink").click(function(){
        $('#signupbox').hide();
        $('#loginbox').show();
        limpaCampos($("#signupform"));
        $("#divMensagemCadastro").css("display","none");
    });

    function validaCampos(){
        var txbUsuario = $("#txbUsuario");
        var txbSenhaCad = $("#txbSenhaCad");
        var txbEmail = $("#txbEmail");
        var txbNome = $("#txbNome");
        var txbSobrenome = $("#txbSobrenome");
        var txbCpf = $("#txbCpf");

        var mensagem = "";
        if(txbNome.val() == ""){
            mensagem = mensagem.concat("<i><b>Nome</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        if(txbSobrenome.val() == ""){
            mensagem = mensagem.concat("<i><b>Sobrenome</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        if(txbUsuario.val() == ""){
            mensagem = mensagem.concat("<i><b>Usuário</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        if(txbSenhaCad.val() == ""){
            mensagem = mensagem.concat("<i><b>Senha</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        if(txbEmail.val() == ""){
            mensagem = mensagem.concat("<i><b>E-mail</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        else if(!validaEmail(txbEmail.val())){
            mensagem = mensagem.concat("<i><b>E-mail</b> deve conter informações válidas</i><br/>");
        }
        if(txbCpf.val() == ""){
            mensagem = mensagem.concat("<i><b>CPF</b> é um campo de preenchimento obrigatório</i><br/>");
        }
        else if (!validaCpf(txbCpf.val())){
            mensagem = mensagem.concat("<i><b>CPF</b> deve conter informações válidas</i><br/>");
        }
        return mensagem;
    }

    if($("#loginbox").css("display") == "none"){
        //Valida se o cmapo cpf é número
        validaNumero($("#txbCpf")) ;
    }

});


