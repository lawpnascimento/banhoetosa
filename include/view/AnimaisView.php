<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/animais.js"></script>
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
                    <div class="col-md-9">
                        <input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome">
                    </div>
                </div>
                <div class="form-group">
                    <label for="raca" class="col-md-1 control-label">Raça</label>
                    <div class="col-md-9">
                        <input id="txbRaca" type="raca" class="form-control" name="txbRaca" placeholder="Raça">
                    </div>
                </div>
                <div class="form-group">
                    <label for="idade" class="col-md-1 control-label">Idade</label>
                    <div class="col-md-9">
                        <input id="txbIdade" type="text" class="form-control" name="txbIdade" placeholder="Idade">
                    </div>
                </div>
                <div class="form-group">
                    <label for="porte" class="col-md-1 control-label">Porte</label>
                    <div class="col-md-9">
                        <input id="txbPorte" type="text" class="form-control" name="txbPorte" placeholder="Porte">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-9">
                        <button id="btnCadastrar" type="button" class="btn btn-success"><i class="icon-hand-right"></i>Cadastrar</button>
                        <button id="btnBuscar" type="button" class="btn btn-info"><i class="icon-hand-right"></i>Buscar</button>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Toto
                        </td>
                        <td>
                            Tomba lata
                        </td>
                        <td>
                            5
                        </td>
                        <td>
                            Monstro
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>