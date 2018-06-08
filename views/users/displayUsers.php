<?php
/**
 * Created by PhpStorm.
 * User: padbrain
 * Date: 07/06/18
 * Time: 20:37
 */
//vardump($this->aoDatas);
?>
    <p><strong>Cliquer sur un pseudo pour modifier l'utilisateur correspondant !</strong></p>
<?php
foreach ($users as $oUser):
?>

    <p>
        <a href="http://php_mvc.bwb/update/user/<?= $oUser->id ?>/form"><?= $oUser->pseudo ?></a>
        <a href="http://php_mvc.bwb/delete/user/<?= $oUser->id ?>/form">Supprimer</a>
    </p>

<?php
endforeach;
?>