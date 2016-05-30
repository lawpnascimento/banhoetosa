<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Banho e tosa</title>
		<script type="text/javascript" src="../../scripts/jquery-2.1.4.min.js"></script>
		<link href="../../css/bootstrap.css" rel="stylesheet" media="screen" />
		<link href="../../css/login.css" rel="stylesheet" media="screen" />
		<script type="text/javascript" src="../../scripts/bootstrap.js"></script>
	</head>
	<body>
		<div class="container-fluid">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Entrar</div>
					</div>    
					<div style="padding-top:30px" class="panel-body" >

						<div style="display:none" id="divErro" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form">
								
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="txbLogin" type="text" class="form-control" name="username" value="" placeholder="Usuário" maxlength="50"/>
							</div>
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="txbSenha" type="password" class="form-control" name="password" placeholder="Senha" maxlength="20">
							</div>
							<div style="margin-top:10px" class="form-group">
							   <!-- Button -->
								<div class="col-sm-12 controls">
								  <a id="btnLogin" href="#" class="btn btn-success">Entrar  </a>
								</div>
							</div>


							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										Não tem uma conta? 
									<a id="btnCadastro"  href="#">
										Cadastre-se
									</a>
									</div>
								</div>
							</div>    
						</form> 
					</div>                     
				</div>  
			</div>
			<div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Cadastrar</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" >Entrar</a></div>
					</div>  
					<div class="panel-body" >
						<form id="signupform" class="form-horizontal" role="form"> 
							<div id="divMensagemCadastro" style="display:none" class="alert alert-danger"></div>
							<div class="form-group">
								<label for="firstname" class="col-md-3 control-label">Nome</label>
								<div class="col-md-9">
									<input id="txbNome" type="text" class="form-control" name="txbNome" placeholder="Nome" maxlength="50">
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-md-3 control-label">Sobrenome</label>
								<div class="col-md-9">
									<input id="txbSobrenome" type="text" class="form-control" name="txbSobrenome" placeholder="Sobrenome" maxlength="50">
								</div>
							</div>
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuário</label>
								<div class="col-md-9">
									<input id="txbUsuario" type="text" class="form-control" name="txbUsuario" placeholder="Usuário" maxlength="50">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Senha</label>
								<div class="col-md-9">
									<input id="txbSenhaCad" type="password" class="form-control" name="txbSenha" placeholder="Senha" maxlength="20">
								</div>
							</div> 
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">E-mail</label>
								<div class="col-md-9">
									<input id="txbEmail" type="text" class="form-control" name="txbEmail" placeholder="E-mail" maxlength="50">
								</div>
							</div>
							<div class="form-group">
								<label for="cpf" class="col-md-3 control-label">CPF</label>
								<div class="col-md-9">
									<input id="txbCpf" type="text" maxlength="11" class="form-control" name="txbCpf" placeholder="CPF">
								</div>

							</div>   
							
							<div class="form-group">
								<!-- Button -->                                        
								<div class="col-md-offset-3 col-md-9">
									<button id="btnCadastrar" type="button" class="btn btn-info" >
                                        <i class="icon-hand-right"></i>
                                        Cadastrar
                                    </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="imagem-login"/>
		</div>
  </body>
  <script type="text/javascript" src="../../scripts/geral.js"></script>
  <script type="text/javascript" src="../../scripts/login.js"></script>
  <script type="text/javascript" src="../../scripts/cadastroLogin.js"></script>
</html>