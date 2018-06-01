<?php
//vardump($_SERVER);
//?>
<h1 class="display-4" id="connecter">Suppression d'un profil utilisateur</h1>
<section id="formConnect">
Voulez-vous vraiment supprimer le profil de <strong> <?= $oUser->pseudo ?></strong> ?
    <ul>
        <li><a href="http://php_mvc.bwb/api/user/delete/<?= $oUser->id ?>" >oui</a></li>
        <li><a href="http://php_mvc.bwb/" >Annuler</a></li>
    </ul>
</section>