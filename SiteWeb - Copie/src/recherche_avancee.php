<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
    <head>
        <title>Consultation des emplois du temps</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!-- Lien vers ma feuille de styles css -->
		<link rel="stylesheet" type="text/css" href="Index.css" />
</head>
    <body>
	<div id="logo">
		<img src="LOGO_iut_Michel_de_Montaigne_réduit.png" />
		<h1>Consultation des emplois du temps</h1>
	</div>
	<div id="page_spec">
		<form action="Affichage.php" method="post" class="formulaire">
			<fieldset>
				<legend>Choix de l'emploi du temps</legend>
				<table>
					<tr>
						<td>
							Fillière :
						</td>
						<td>
							<select name="objet0" id="objet0">
								<optgroup>
									<option value="1">Informatique</option>
								</optgroup>
								<optgroup>
									<option value="1">SRC</option>
								</optgroup>
								<optgroup>
									<option value="1">TC</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Groupe :
						</td>
						<td>
							<select name="objet" id="objet">
								<optgroup>
									<option value="1">Groupe 1</option>
								</optgroup>
								<optgroup>
									<option value="1">Groupe 2</option>
								</optgroup>
								<optgroup>
									<option value="1">Groupe 3</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Semaine :
						</td>
						<td>
							<select name="objet1" id="objet1">
								<optgroup>
									<option value="1">S1_06/09/2010 au 10/09/2010</option>
								</optgroup>
								<optgroup>
									<option value="1">S2_13/09/2010 au 17/09/2010</option>
								</optgroup>
								<optgroup>
									<option value="1">S3_20/09/2010 au 24/09/2010</option>
								</optgroup>
							</select>
						</td>
					</tr>
				</table>
				<input id="recherche_a" class="bouton" name="recherche_a" type="submit" value="Rechercher" />
				<a href="../index.php">Recherche simplifiée</a>
			</fieldset>
		</form>
	</div>
	<div id="end">
		<a href="Admin.php">Administration</a>
	</div>
</body>
</html>
