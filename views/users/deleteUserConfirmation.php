<?php
//vardump($this->aoDatas);
$oUser = reset($this->aoDatas);
//?>
<h1 class="display-4" id="connecter">Suppression d'un profil utilisateur</h1>
<section id="formConnect">
Voulez-vous vraiment supprimer le profil de <strong> <?= $oUser->pseudo ?></strong> ?
    <ul>
        <li><a href="http://php_mvc.bwb/delete/user/<?= $oUser->id ?>" >oui</a></li>
        <li><a href="http://php_mvc.bwb/" >Annuler</a></li>
    </ul>
</section>