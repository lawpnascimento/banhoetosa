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
                        <div class="input-group date" id="divDtpAgendamento">
                            <input id="dtpAgendamento" readonly="true" type="text" class=" datepicker form-control" data-date-format="dd/mm/yyyy" maxlength="10" />
                                <span class="input-group-addon">
                                    <span class=" glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="horario" class="col-md-1 control-label">Horário</label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button  class="btn btn-default dropdown-toggle form-control" type="button" id="ddlHorarioDe" data-toggle="dropdown" aria-expanded="true" name="De">
                                De
                                <span class="caret"></span>
                            </button>
                            <ul id="ulHorarioDe" class="dropdown-menu" role="menu" aria-labelledby="ddlHorarioDe">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">08:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">09:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">10:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">11:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">12:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">14:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">16:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">17:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">18:00:00</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="horario" class="col-md-1 control-label"></label>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle form-control" type="button" id="ddlHorarioAte" data-toggle="dropdown" aria-expanded="true" name="Até">
                                Até
                                <span class="caret"></span>
                            </button>
                            <ul id="ulHorarioAte" class="dropdown-menu" role="menu" aria-labelledby="ddlHorario">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">08:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">09:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">10:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">11:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">12:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">14:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">16:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">17:00:00</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">18:00:00</a></li>
                            </ul>
                        </div>
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
                                <li role="presentation" value="1"><a role="menuitem" tabindex="-1" href="#">Dinheiro</a></li>
                                <li role="presentation" value="2"><a role="menuitem" tabindex="-1" href="#">Cartão de crédito</a></li>
                                <li role="presentation" value="3"><a role="menuitem" tabindex="-1" href="#">Cheque</a></li>
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
