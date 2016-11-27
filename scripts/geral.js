function limpaCampos($form){
    $form.find('input:text, input:password, input:file, select, textarea, input[type="date"]').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    $form.find('.dropdown-toggle').each(function(){
        $(this).html($(this).attr('name') + "&nbsp<span class='caret'></span>");
        $(this).val('');
    });
};

function validaNumero(campo)
{
    campo.keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
}

function validaEmail(email)
{
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


function validaCpf(strCPF)
{
    var Soma;

    var Resto;

    Soma = 0;

    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) {
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    }

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;

    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;

    for (i = 1; i <= 10; i++){
        Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    }

    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;

    if (Resto != parseInt(strCPF.substring(10, 11) ) )
        return false;

    return true;
}

function formularioModoInserir(){
    $("#btnCadastrar").css("display","inline-block");
    $("#btnBuscar").css("display","inline-block");
    $("#btnExcluir").css("display","none");
    $("#btnAtualizar").css("display","none");

}

function formularioModoAtualizar(){
    $("#btnCadastrar").css("display","none");
    $("#btnBuscar").css("display","none");
    $("#btnExcluir").css("display","inline-block");
    $("#btnAtualizar").css("display","inline-block");

}
