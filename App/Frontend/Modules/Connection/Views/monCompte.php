<p>Pseudo : <?= $account->pseudo(); ?></p>
<p>ID : <?= $account->id(); ?></p>
<img src="<?= $account->avatar() ?>" alt="Votre Avatar">
<br>
<form action="" method="POST" enctype="multipart/form-data">
    <label>Avatar :</label>
    <input type="file" name="avatar"><br><br>
    <input type="submit" value ="Mettre à jour">
</form>

