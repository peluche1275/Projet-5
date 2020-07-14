<form method="post">
	<div class="fields">
		<div class="field half">
			<label for="pseudo">Pseudo</label>
			<input type="text" name="pseudo" id="pseudo" required aria-required="true" placeholder="10 caractères maximum."/>
		</div>
		<div class="field half">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" required aria-required="true" placeholder="Nous n'utilisons pas vos données personnelles." />
		</div>
		<div class="field half">
			<label for="password">Mot de passe</label>
			<input type="password" name="password" id="password" required aria-required="true" placeholder="Vous devriez choisir un mot de passe fort :"/>
		</div>
		<div class="field half">
			<label for="password2">Répéter Mot de passe</label>
			<input type="password" name="password2" id="password2" required aria-required="true" placeholder="Chiffres, Miniscules, Majsucules, Caractères spéciaux."/>
		</div>
	</div>
	<ul class="actions">
		<li><input type="submit" value="Inscription" class="primary" /></li>
		<li><input type="reset" value="Reset" /></li>
	</ul>
</form>