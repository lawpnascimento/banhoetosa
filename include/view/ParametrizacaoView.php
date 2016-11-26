<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/parametrizacao.js"></script>
<link href="../../css/alerta.css" rel="stylesheet" media="screen" />

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Parametrizações</div>
        </div>
        <div class="panel-body" >
            <form id="parametrizacaoForm" class="form-horizontal" role="form">
                <fieldset>
                    <legend class="scheduler-border">Empresa</legend>

                    <div class="form-group">
                        <label for="nome" class="col-md-1 control-label">Nome</label>
                        <div class="col-md-4">
                            <input id="txbEmpresa" type="text" class="form-control" name="txbEmpresa" placeholder="Empresa"></input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="horario" class="col-md-1 control-label">Horário</label>
                        <div class="col-md-2">
                            <input id="txbHorarioDe" type="text" class="form-control" name="txbHorarioDe" placeholder="De"/>
                        </div>
                        <div class="col-md-2">
                            <input id="txbHorarioAte" type="text" class="form-control" name="txbHorarioAte" placeholder="Até"/>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="scheduler-border">Usuários</legend>
                    <div class="form-group">
                        <label for="usuarios" class="col-md-1 control-label">Usuário</label>
                        <div class="col-md-4">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlUsuario" data-toggle="dropdown" aria-expanded="true" name="usuarios">
                                    Usuários
                                    <span class="caret"></span>
                                </button>
                                <ul id="ulUsuario" class="dropdown-menu" role="menu" aria-labelledby="ddlUsuario">

                                </ul>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <label for="perfil" class="col-md-1 control-label">Perfil</label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlPerfil" data-toggle="dropdown" aria-expanded="true" name="perfil">
                                Perfis
                                <span class="caret"></span>
                            </button>
                            <ul id="ulPerfil" class="dropdown-menu" role="menu" aria-labelledby="ddlPerfil">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="situacao" class="col-md-1 control-label">Situação</label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlSituacao" data-toggle="dropdown" aria-expanded="true" name="situacao">
                                Situações
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
