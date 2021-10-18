<form action="<?php esc_url($_SERVER['REQUEST_URI']) ?>" method="post">
    <table class="form-table-style">
        <tr>
            <th scope="row"><label for="firstname">Prénom <strong>*</strong></label></th>
            <td><input required type="text" id="firstname" name="firstname" class="large-text"></td>
        </tr>
        <tr>
            <th scope="row"><label for="lastname">Nom <strong>*</strong></label></th>
            <td><input required type="text" id="lastname" name="lastname"></td>
        </tr>
        <tr>
            <th scope="row"><label for="email">Email <strong>*</strong></label></th>
            <td><input required type="email" id="email" name="email"></td>
        </tr>
        <tr>
            <th scope="row"><label for="phone">Téléphone <strong>*</strong></label></th>
            <td><input required type="text" id="phone" name="phone"></td>
        </tr>
        <tr>
            <th scope="row"><label for="date">Date <strong>*</strong></label></th>
            <td><input required type="date" id="date" name="date"></td>
        </tr>
        <tr>
            <th scope="row"><label>Horaires <strong>*</strong></label></th>
            <td>
                <input type="radio" id="schedule-01" name="schedule" value="10h00 et 11h00">
                <label for="schedule-01">10h00 - 11h00</label><br>
                <input type="radio" id="schedule-02" name="schedule" value="11h00 et 12h00">
                <label for="schedule-02">11h00 - 12h00</label><br>
                <input type="radio" id="schedule-03" name="schedule" value="17h00 et 18h00">
                <label for="schedule-03">17h00 - 18h00</label>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="message">Message <strong>*</strong></label></th>
            <td></label><textarea required name="message" rows="5"
                          placeholder="Écrivez le but de votre rendez-vous (255 caractères maximum)"></textarea></td>
        </tr>
    </table>
    <br>
    <div>
        <input type="submit" name="submit" value="Envoyer">
    </div>
</form>