<form action="<?php esc_url($_SERVER['REQUEST_URI']) ?>" method="post">
    <div>
        <label for="firstname">Prénom <strong>*</strong></label>
        <input required type="text" id="firstname" name="firstname">
    </div>
    <div>
        <label for="lastname">Nom <strong>*</strong></label>
        <input required type="text" id="lastname" name="lastname">
    </div>
    <div>
        <label for="email">Email <strong>*</strong></label>
        <input required type="email" id="email" name="email">
    </div>
    <div>
        <label for="phone">Téléphone <strong>*</strong></label>
        <input required type="text" id="phone" name="phone">
    </div>
    <div>
        <label for="date">Date <strong>*</strong></label>
        <input required type="date" id="date" name="date">
    </div>
    <div>
        <p>Horaires <strong>*</strong></p>
        <input type="radio" id="schedule-01" name="schedule" value="10h00 et 11h00">
        <label for="schedule-01">10h00 - 11h00</label><br>
        <input type="radio" id="schedule-02" name="schedule" value="11h00 et 12h00">
        <label for="schedule-02">11h00 - 12h00</label><br>
        <input type="radio" id="schedule-03" name="schedule" value="17h00 et 18h00">
        <label for="schedule-03">17h00 - 18h00</label>
    </div>
    <div>
        <label for="message">Message <strong>*</strong></label>
        <textarea required name="message" placeholder="Écrivez le but de votre rendez-vous (255 caractères maximum)"></textarea>
    </div>
    <br>
    <div>
        <input type="submit" name="submit" value="Envoyer">
    </div>
</form>