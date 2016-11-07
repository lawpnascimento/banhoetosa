<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/perfil.js"></script>


<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">Perfil</div>
        </div>
        <div class="panel-body" >
            <form id="signupform" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="firstname" class="col-md-1 control-label">Nome</label>
                    <div class="col-md-4">
                        <input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome" maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-md-1 control-label">Sobrenome</label>
                    <div class="col-md-4">
                        <input id="txbSobrenome" type="text" class="form-control" name="txbSobrenome" placeholder="Sobrenome" maxlength="50">
                    </div>
                </div>
                <div class="form-group">
    								<label for="telefone" class="col-md-1 control-label">Telefone</label>
    								<div class="col-md-4">
    									<input id="txbTelefone" type="text" class="form-control" name="txbTelefone" placeholder="Telefone" maxlength="12">
    								</div>
  							</div>
                <div class="form-group">
                    <label for="email" class="col-md-1 control-label">E-mail</label>
                    <div class="col-md-4">
                        <input id="txbEmail" type="text" class="form-control" name="txbEmail" placeholder="E-mail" maxlength="50">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf" class="col-md-1 control-label">CPF</label>
                    <div class="col-md-4">
                        <input id="txbCpf" type="text" maxlength="11" class="form-control" name="txbCpf" placeholder="CPF">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-1 col-md-4">
                        <button id="btnAtualizar" type="button" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
