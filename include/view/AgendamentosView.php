<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/agendamentos.js"></script>

<link href="../../css/alerta.css" rel="stylesheet" media="screen" />

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Cadastrar Agendamento</div>
        </div>
        <div class="panel-body" >
            <form id="agendamentosform" class="form-horizontal" role="form">
                <div class="form-group">
                    <input type="hidden" id="hdfcdAgendamento">
                    <label for="data" class="col-md-1 control-label">Data</label>
                    <div class="col-md-4">
                        <div  id="divDtpAgendamento">
                            <input id="dtpAgendamento" type="date" data-date-format="DD/MM/YYYY" class="form-control"  maxlength="10" />
                        </div>
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
                <div class="form-group">
                    <label for="pagamento" class="col-md-1 control-label">Pagamento</label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlPagamento" data-toggle="dropdown" aria-expanded="true" name="Pagamento">
                                Pagamento
                                <span class="caret"></span>
                            </button>
                            <ul id="ulPagamento" class="dropdown-menu" role="menu" aria-labelledby="ddlPagamento">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="animal" class="col-md-1 control-label">Animal</label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlAnimal" data-toggle="dropdown" aria-expanded="true" name="Animal">
                                Animal
                                <span class="caret"></span>
                            </button>
                            <ul id="ulAnimal" class="dropdown-menu" role="menu" aria-labelledby="ddlAnimal">


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
    <div id="grdUsuarioAgendamentos" class="panel panel-default">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Data
                    </th>
                    <th>
                        Hr. Inicial
                    </th>
                    <th>
                        Hr. Final
                    </th>
                    <th>
                        Animal
                    </th>
                    <th>
                        Pagamento
                    </th>
                    <th>
                        Situação
                    </th>
                    <th></th>
                </tr>

            </thead>
            <tbody id="tbdUsuarioAgendamento">

            </tbody>
        </table>
    </div>
</div>
