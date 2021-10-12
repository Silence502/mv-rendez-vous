<?php
echo '<h1>Confirmation de rendez-vous</h1>';
echo '<p>Bonjour, ' . $firstname . ' ' . $lastname . '.<br><br>';
echo 'Je vous confirme votre demande de rendez-vous pour le <i>' . date_format( $dateObject, 'd/m/y' ) . '</i> entre <i>' . $schedule . '.</i><br>';
echo 'Je vous contacterai via le numéro de téléphone suivant : <i>' . $phone . '</i>  lors de votre demande.</p><br>';
echo '<p>Cordialement,</p>';
echo '<hr>';
echo '<p>' . $_POST['message'] . '</p>';

