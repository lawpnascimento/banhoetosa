buscaPerfil();

validaNumero($("#txbCpf"));

function buscaPerfil(cdPerfil){
    $.ajax({
        //Tipo de envio POST ou GET
        type: "POST",
        dataType: "text",
        data: {
            action: "buscar"
        },

        url: "../controller/PerfilController.php",

        //Se der tudo ok no envio...
        success: function (dados) {
            var json = $.parseJSON(dados);

            for (var i = 0; i < json.length; i++) {

                var perfil = json[i];

                $("#txbNome").val(perfil.dsNome);
                $("#txbSobrenome").val(perfil.dsSobrenome);
                $("#txbEmail").val(perfil.dsEmail);
                $("#txbCpf").val(perfil.nrCpf);
                $("#txbTelefone").val(perfil.nrTelefone);

            }
        }
    });

};

$("#btnAtualizar").click(function () {
    var txbEmail = $("#txbEmail");
    var txbNome = $("#txbNome");
    var txbSobrenome = $("#txbSobrenome");
    var txbCpf = $("#txbCpf");
    var txbTelefone = $("#txbTelefone");


    msgErro = validaCampos(txbEmail.val(), txbNome.val(),txbSobrenome.val(),txbCpf.val(),txbTelefone.val());
    if(msgErro != ""){
        jbkrAlert.alerta('Alerta!',msgErro);
    }
    else{
        $.ajax({
            //Tipo de envio POST ou GET
            type: "POST",
            dataType: "text",
            data: {
                email: txbEmail.val(),
                nome: txbNome.val(),
                sobrenome: txbSobrenome.val(),
                cpf: txbCpf.val(),
                telefone: txbTelefone.val(),
                action: "atualizar"
            },

            url: "../controller/PerfilController.php",

            //Se der tudo ok no envio...
            success: function (dados) {
                jbkrAlert.sucesso('Perfil', 'Perfil atualizado com sucesso!');
            }
        });
    }
});


function validaCampos(email, nome, sobrenome, cpf, telefone){

    var mensagem = "";
    if(nome == ""){
        mensagem = mensagem.concat("<i><b>Nome</b> é um campo de preenchimento obrigatório</i>");
    }
    if(sobrenome == ""){
        mensagem = mensagem.concat("<br/><i><b>Sobrenome</b> é um campo de preenchimento obrigatório</i>");
    }
    if(email == ""){
        mensagem = mensagem.concat("<br/><i><b>E-mail</b> é um campo de preenchimento obrigatório</i>");
    }
    else if(!validaEmail(email)){
        mensagem = mensagem.concat("<br/><i><b>E-mail</b> deve conter informações válidas</i>");
    }
    if(cpf == ""){
        mensagem = mensagem.concat("<br/><i><b>CPF</b> é um campo de preenchimento obrigatório</i>");
    }
    if(telefone == ""){
        mensagem = mensagem.concat("<br/><i><b>Telefone</b> é um campo de preenchimento obrigatório</i>");
    }
    else if (!validaCpf(cpf)){
        mensagem = mensagem.concat("<br/><i><b>CPF</b> deve conter informações válidas</i>");
    }
    return mensagem;

};
