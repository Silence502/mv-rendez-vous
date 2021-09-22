<style></style>
<form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
    <div>
        <label for="firstname">Prénom<strong>*</strong></label>
        <input type="text" id="firstname" name="firstname">
    </div>
    <div>
        <label for="lastname">Nom<strong>*</strong></label>
        <input type="text" id="lastname" name="lastname">
    </div>
    <div>
        <label for="email">Email<strong>*</strong></label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="phone">Téléphone<strong>*</strong></label>
        <input type="text" id="phone" name="phone">
    </div>
    <div>
        <label for="date">Date<strong>*</strong></label>
        <input type="date" id="date" name="date">
    </div>
    <div>
        <p>Horaires<strong>*</strong></p>
        <input type="radio" id="1011" name="schedule" value="10h00 et 11h00">
        <label for="1011">10h00 - 11h00</label><br>
        <input type="radio" id="1012" name="schedule" value="11h00 et 12h00">
        <label for="1012">11h00 - 12h00</label><br>
        <input type="radio" id="1718" name="schedule" value="17h00 et 18h00">
        <label for="1718">17h00 - 18h00</label>
    </div>
    <div>
        <label for="message">Message<strong>*</strong></label>
        <textarea name="message" placeholder="Écrivez le but de votre rendez-vous"></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Envoyer">
    </div>
</form>
<script></script>