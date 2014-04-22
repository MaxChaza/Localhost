<?php
include('header.php');
?>
	<div id="menu">
		<dl> 
			<dd id="titre"><h2>Gestion des comptes Twitter</h2></dd>
			<dd><a class="survol" href="ajouterCompte.html">Ajouter un compte</a></dd>
			<dd><a class="survol" href="modifierCompte.html">Modifier un compte</a></dd>
			<dd><a class="survol" href="supprimerCompte.html">Supprimer un compte</a></dd>
			<dd><a class="survol" href="utiliserCompte.html">Utiliser un compte</a></dd>
  		</dl>
	</div>
	 <div id="page">
		<form action="supprimerCompte2.html" method="post" class="centre">
			<fieldset>
				<legend>Suppression d'un comptes</legend>
         			<p class="gche" >
					Comptes :
					<select name="objet0" id="objet0" onclick="return objet0_onclick()">
						<optgroup>
							<option value="1">SRC_Bordeaux</option>
						</optgroup>
						<optgroup>
							<option value="1">Info_Limoges</option>
						</optgroup>
					</select>&nbsp;&nbsp;&nbsp;
					<input class="bouton" type="submit" id="envoyer0" name="envoyer0" value="Ok" />
				</p>
			</fieldset>
		</form>
	</div>
	<?php
include('foot.php');
?>
