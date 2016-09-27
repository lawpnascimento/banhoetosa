<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/parametrizacao.js"></script>
<link href="../../css/alerta.css" rel="stylesheet" media="screen" />

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Parametrização</div>
        </div>
        <div class="panel-body" >
            <form id="parametrizacaoForm" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="usuarios" class="col-md-1 control-label">Usuário</label>
                    <div class="col-md-5">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlUsuarios" data-toggle="dropdown" aria-expanded="true" name="usuarios">
                                Usuários
                                <span class="caret"></span>
                            </button>
                            <ul id="ulUsuarios" class="dropdown-menu" role="menu" aria-labelledby="ddlUsuarios">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="perfil" class="col-md-1 control-label">Perfil</label>
                    <div class="col-md-5">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlPerfil" data-toggle="dropdown" aria-expanded="true" name="perfil">
                                Perfil
                                <span class="caret"></span>
                            </button>
                            <ul id="ulPerfil" class="dropdown-menu" role="menu" aria-labelledby="ddlPerfil">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="situacao" class="col-md-1 control-label">Situação</label>
                    <div class="col-md-5">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlSituacao" data-toggle="dropdown" aria-expanded="true" name="situacao">
                                Situação
                                <span class="caret"></span>
                            </button>
                            <ul id="ulSituacao" class="dropdown-menu" role="menu" aria-labelledby="ddlSituacao">

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-offset-1 col-md-9">
                      <button id="btnAtualizar" type="button" class="btn btn-primary">Atualizar</button>
                      <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
