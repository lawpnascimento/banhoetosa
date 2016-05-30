<script type="text/javascript">

    $("#imagem").fileinput({
        language: 'pt-BR',
        allowedFileExtensions : ['jpg', 'png'],
        maxFileSize: 2000,
        maxFilesNum: 1,
        browseClass: "btn btn-primary btn-block",
        showCaption: false,
        showRemove: false,
        showUpload: false
    });

    $(document).ready(function(){
    /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
        $('#btnEnviar').click(function(){
            alert("testes");
            $('#visualizar').html('<img src="ajax-loader.gif" alt="Enviando..."/> Enviando...');
            /* Efetua o Upload sem dar refresh na pagina */
            $('#formulario').ajaxForm({ target:'#visualizar' // o callback será no elemento com o id #visualizar
             }).submit();
        });
    })
</script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Foto de Perfil</div>
        </div>
        <form id="formulario" method="post" enctype="multipart/form-data" action="../controller/FotoPerfilController.php">
            <div style="width: 99%; margin-top:5px; margin-left: 6px;">
                <input id="imagem" name="imagem" class="file" type="file" multiple data-min-file-count="1" >
            </div>
        </form>

        <button id="btnEnviar" style="width: 99%; margin-top:5px; margin-bottom:5px; margin-left: 6px;" type="button" class="btn btn-success"><i class="icon-hand-right"></i>Enviar</button>

        <div id="visualizar" style="display: none;"></div>

        </div>
    </div>
</div>