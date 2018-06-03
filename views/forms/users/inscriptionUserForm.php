<h1 class="display-4" id="connecter">Inscrivez-vous ici</h1>
<?php echo "'toto'" ?>
<section id="formConnect">
    <form id="connexion"   action="../../api/users" method="POST">
        <p><label>Pseudo  </label>
            <input name="pseudo" type="text" placeholder="Pseudo" id="user" value="toto"/></p>
    <!--        <input name="id" type="text" placeholder="id" id="id"/></p>-->

        <p><label>Mot de passe</label>
            <input type="password" name="password" placeholder="mdp" id="mdp" value="toto"/></p>

          <p><label>Role_id</label>
            <input type="text" name="role_id" placeholder="role_id" id="role_id" value="2" /></p>

          <p><label>Mail</label>
              <input type="email" name="email" placeholder="mail" id="mail" value="toto@toto.fr"/></p>

        <button type="submit" class="btn btn-primary mb-2">Valider</button>


    </form>
</section>