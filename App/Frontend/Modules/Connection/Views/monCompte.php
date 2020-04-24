<h2 class="major">Votre compte</h2>
<p>Informations</p>
<div class="monCompte">
    <p>Identifiant : <span class="monCompteData"><?= $account->pseudo() ?></span></p>
    <p>Meilleur score :<span class="monCompteData"> <?= $account->score() ?></span> points</p>
</div>
<p>Photo de profil</p>
<div id="monCompteAvatar">
    <img id="avatar" src="<?= $account->avatar() ?>" alt="Votre Avatar">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar"><br><br>
        <input type="submit" value="Mettre à jour">
    </form>
</div>