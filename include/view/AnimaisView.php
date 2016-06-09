<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/animal.js"></script>
<link href="../../css/alerta.css" rel="stylesheet" media="screen" />

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastrar Animal</div>
        </div>
        <div class="panel-body" >
            <form id="animaisform" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="nome" class="col-md-1 control-label">Nome</label>
                    <div class="col-md-5">
                        <input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome">
                    </div>
                </div>
                <div class="form-group">
                    <label for="raca" class="col-md-1 control-label">Raça</label>
                    <div class="col-md-5">
                        <input id="txbRaca" type="raca" class="form-control" name="txbRaca" placeholder="Raça">
                    </div>
                </div>
                <div class="form-group">
                    <label for="idade" class="col-md-1 control-label">Idade</label>
                    <div class="col-md-5">
                        <input id="txbIdade" type="text" class="form-control" name="txbIdade" placeholder="Idade">
                    </div>
                </div>


                <div class="form-group">
                    <label for="porte" class="col-md-1 control-label">Porte</label>
                    <div class="col-md-5">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlPorte" data-toggle="dropdown" aria-expanded="true" name="Porte">
                                Porte
                                <span class="caret"></span>
                            </button>
                            <ul id="ulPorte" class="dropdown-menu" role="menu" aria-labelledby="ddlPorte">

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-offset-1 col-md-9">
                      <button id="btnCadastrar" type="button" class="btn btn-success"><i class="icon-hand-right"></i>Cadastrar</button>
                      <button id="btnBuscar" type="button" class="btn btn-info"><i class="icon-hand-right"></i>Buscar</button>
                      <button id="btnAtualizar" type="button" style="display:none; "class="btn btn-primary">Atualizar</button>
                      <button id="btnExcluir" type="button" style="display:none; "class="btn btn-danger">Excluir</button>
                      <button id="btnCancelar" type="button" class="btn btn-warning">Cancelar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="panel panel-default">
            <!-- Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Nome
                        </th>

                        <th>
                            Raça
                        </th>
                        <th>
                            Idade
                        </th>
                        <th>
                            Porte
                        </th>
                        <th>
                            Editar
                        </th>
                    </tr>
                </thead>
                <tbody id="tbanimal">

                </tbody>
            </table>
        </div>
    </div>
</div>
