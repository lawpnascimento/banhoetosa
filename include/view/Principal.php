<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start();
			require_once("../../estrutura/iniciar_sessao.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Banho e tosa</title>
		<script type="text/javascript" src="../../scripts/jquery-2.1.4.min.js"></script>
		<link href="../../css/bootstrap.css" rel="stylesheet" media="screen" />
		<link href="../../css/principal.css" rel="stylesheet" media="screen" />
    <link href="../../css/datepicker.css" rel="stylesheet" media="screen" />
    <link href="../../css/alerta.css" rel="stylesheet" media="screen" />
    <script type="text/javascript" src="../../scripts/bootstrap.js"></script>
		<script type="text/javascript" src="../../scripts/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../../scripts/fileinput.js"></script>
    <script type="text/javascript" src="../../scripts/fileinput_locale_pt-BR.js"></script>
    <link href="../../css/fileinput.css" rel="stylesheet" media="screen" />
	</head>
	<body>
		<div class="container-fluid">
			<header class="row">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"/>
								<span class="icon-bar"/>
								<span class="icon-bar"/>
							</button>
							<a class="navbar-brand" href="Principal.php">Luluzinha Banho e Tosa</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li>
									<a id="btnAnimais" href="#">Animais</a>
								</li>
							</ul>
							<ul class="nav navbar-nav">
								<li>
									<a id="btnAgendamentos" href="#">Agendamentos</a>
								</li>
							</ul>
							<div id="divAdministradores" <?php echo $_SESSION["cdperfil"] == 1 ? "style='display:none;'" : "style='display:block;'"?>>
								<ul class="nav navbar-nav" >
									<li>
										<a id="btnAvaliacao" href="#">Avaliações</a>
									</li>
								</ul>
								<ul class="nav navbar-nav">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administração<span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu" >
											<li>
												<a id="btnCliente" href="#">Clientes</a>
											</li>
												<li class="divider"/>
											<li>
												<a id="btnParametrizacao" href="#">Parametrizações</a>
											</li>

									  </ul>
								  </li>
								</ul>
							</div>

							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo ucfirst($_SESSION["nome"]) ?><span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
                      <li>
                          <a id="btnPerfil" href="#">Perfil</a>
                      </li>
											<li class="divider"/>
											<li>
                          <a id="btnAjuda" href="#">Ajuda</a>
                      </li>
                      <li class="divider"/>
                      <li>
                          <a href="Sair.php">Sair</a>
                      </li>
								     </ul>
								</li>
							</ul>
						</div>
					</div><!-- /.container-fluid -->
				</nav>
		    </header>
		    <div class="row">
				<div id="main" role="main">
					<div class="panel panel-default">
			        <div class="panel-heading">
			            <div class="panel-title">Agenda Diária</div>
			        </div>
			        <div class="panel-body" >
			            <form id="frmAgendamentosConsulta" class="form-horizontal" role="form">
										<div class="form-group">
												<label for="data" class="col-md-1 control-label">Data</label>
												<div class="col-md-4">
															<input id="gdpDtAgendamento" type="date" class="form-control" name="gdpDtAgendamento"></input>
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
										Horário
									</th>
								</tr>
							</thead>
							<tbody id="grdPrincipal">
							</tbody>
						</table>
					</div>
				</div>
		    </div>
		    <footer class="row">
				<div class="container">

				</div>
		    </footer>
		</div>
	</body>
</html>
<script type="text/javascript" src="../../scripts/alerta.js"></script>
<script type="text/javascript" src="../../scripts/cadastroLogin.js"></script>
<script type="text/javascript" src="../../scripts/principal.js"></script>
<script type="text/javascript" src="../../scripts/geral.js"></script>
