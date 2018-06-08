<?php
//vardump($_SERVER);
//?>
<h1 class="display-4" id="connecter">Modification profil</h1>
<section id="formConnect">
<form id="connexion"   action="../../api/users/" method="POST">
    <p><label>Pseudo  </label>
        <input name="pseudo" type="text" placeholder="Pseudo" id="user" value="<?= $oUser->pseudo ?>"/></p>
        <input name="id" type="hidden" placeholder="id" id="id" value="<?= $oUser->id ?>" /></p>

    <p><label>Mot de passe</label>
        <input type="password" name="password" placeholder="mdp" id="mdp" value="<?= $oUser->password ?>"/></p>
    
      <p><label>Role_id</label>
        <input type="text" name="role_id" placeholder="role_id" id="role_id" value="<?= $oUser->role_id ?>" /></p>
      
      <p><label>Mail</label>
          <input type="email" name="email" placeholder="mail" id="mail" value="<?= $oUser->email ?>"/></p>
      
    <button type="submit" class="btn btn-primary mb-2">Valider</button>
    
 
</form>
</section>