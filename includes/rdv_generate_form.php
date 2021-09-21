<style></style>
<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <div>
        <label for="firstname">Prénom<strong>*</strong></label>
        <input type="text" name="firstname">
    </div>
    <div>
        <label for="lastname">Nom<strong>*</strong></label>
        <input type="text" name="lastname">
    </div>
    <div>
        <label for="email">Email<strong>*</strong></label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="message">Message<strong>*</strong></label>
        <textarea name="message" placeholder="Ecrivez le but de votre rendez-vous"></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Envoyer">
    </div>
</form>
<script></script>