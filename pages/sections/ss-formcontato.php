<div class="container" style="padding-bottom: 2.2rem">	
	<div class="row" id="card-contato">
		<div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding: 0">
			<div class="card-header" style="text-align: left;">
				<span class="card-icon"></span> Entre em Contato
			</div>
			<div class="card-body" style="text-align: left;">
				<div id="alertsuccess" class="alert alert-success" role="alert" style="display: none">
					Mensagem enviada com <b>sucesso</b>, entraremos em contato o mais breve possivel.
				</div>
				<div id="alerterror" class="alert alert-warning" role="alert" style="display: none">
					Ocorreu um erro ao enviar a mensagem.
				</div>
				<form id="contactformforvisitors" method="post" enctype="multipart/form-data" action='<?php echo $GLOBALS["api"]["contactmsg"]."/createcontactmsg"; ?>'>
					<form action="" target="">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" class="form-control" name="contactmsg[name]" id="nome" placeholder="Nome Completo">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="contactmsg[mail]" class="form-control" id="mail" placeholder="Digite seu email">
						<small id="emailHelp" class="form-text text-muted">
							Seu email jamais sera divulgado!
						</small>
					</div>
					<div class="form-group">
						<label for="msg">Mensagem</label>
						<textarea class="form-control" name="contactmsg[msg]" id="msg" rows="3"></textarea>
					</div>
					
					<button type="submit" class="btn btn-secondary">Enviar</button>
				</form>
			</div>
			<div id="subLayerForm">

			</div>
		</div>
	</div>
</div>
