<?php
require_once 'includes/managers/rdv_manager_class.php';
require_once 'includes/managers/rdv_message_manager.php';

if (!class_exists('RdvManagementClass')):
    class RdvManagementClass
    {
        /**
         * Used for displaying the management page.
         */
        public static function rdv_management_page()
        {
            add_menu_page(
                'Rendez-vous',
                'Rendez-vous',
                'manage_options',
                'rdv-management',
                array('RdvManagementClass', 'rdv_management'),
                null,
                4
            );
        }

        /**
         * Used to retrieve all appointments in the administration page.
         * Get columns name.
         * Implement the form with a foreach condition for display the selection query.
         * Condition for updating the display cards by the boolean confirmation value.
         * Two other conditions for validating deletion and update queries.
         * @throws Exception
         */
        public static function rdv_management()
        {
            $rdvId = 'rdv_id';
            $rdvFirstname = 'rdv_firstname';
            $rdvLastname = 'rdv_lastname';
            $rdvEmail = 'rdv_email';
            $rdvPhone = 'rdv_phone';
            $rdvDate = 'rdv_date';
            $rdvIsConfirmed = 'rdv_isConfirmed';
            $rdvSentDate = 'rdv_sentDate';
            $rdvSchedule = 'rdv_schedule';
            $rdvMessage = 'rdv_message';

            $selectCount = count(RdvManagerClass::selectAll());
            $selectCountConfirmed = count(RdvManagerClass::selectByConfirmed());
            $selectCountToConfirm = count(RdvManagerClass::selectByToConfirm());

            include_once 'includes/rdv_header_form.php';

            if ($selectCount < 1) {
                echo '<h3>Vous n\'avez pas demande de rendez-vous pour le moment.</h3>';
            } else {
                echo '<h3>Vous avez ' . $selectCount . ' demande de rendez-vous</h3>';
                echo '<p class="count-to-confirm-style">Dont <span class="validated-style"><strong>' . $selectCountToConfirm . '</strong></span> 
				rendez-vous validé(s) et <span class="unvalidated-style"><strong>' . $selectCountConfirmed . '</strong></span> non validé(s)</p><hr>';
            }

            foreach (RdvQueriesClass::rdv_select_function() as $row) {
                $sentDateObject = date_create($row->$rdvSentDate);
                $dateObject = date_create($row->$rdvDate);

                global $cardColor;
                global $checked;
                global $confirm;

                if ($row->$rdvIsConfirmed == 0) {
                    $cardColor = 'background-color: #e5d0d0';
                    $checked = '';
                    $confirm = 'Valider le rendez-vous';
                    $labelColor = 'color: black';
                    $confirmed = '';
                } else {
                    $cardColor = 'background-color: #d1dfe6';
                    $checked = 'checked';
                    $confirm = 'Rendez-vous validé';
                    $disabled = 'disabled';
                    $labelColor = 'color: teal';
                    $confirmed = 'disabled';
                }

                self::rdv_card(
                    $cardColor,
                    $row->$rdvFirstname,
                    $row->$rdvLastname,
                    $sentDateObject,
                    $row->$rdvEmail,
                    $row->$rdvPhone,
                    $dateObject,
                    $row->$rdvSchedule,
                    $row->$rdvMessage,
                    $row->$rdvId,
                    $confirmed,
                    $confirm
                );

                if (isset($_POST[$row->$rdvId . '-to-confirm'])) {
                    self::rdv_confirmation(
                        $dateObject,
                        $row->$rdvSchedule,
                        $row->$rdvFirstname,
                        $row->$rdvLastname,
                        $row->$rdvEmail,
                        $row->$rdvPhone
                    );
                    RdvManagerClass::update($row->$rdvId, true);
                    echo '<meta http-equiv="REFRESH" content="0">';
                }

                if (isset($_POST['submit'])) {
                    if (!empty($_POST[$row->$rdvId . '-to-delete']) && $row->$rdvIsConfirmed == 1) {
                        RdvManagerClass::delete($row->$rdvId);
                        echo '<meta http-equiv="REFRESH" content="0">';
                    } elseif (!empty($_POST[$row->$rdvId . '-to-delete']) && $row->$rdvIsConfirmed == 0) {
                        echo '
						<hr>
						<div class="alert-delete-style">
						Vous n\'avez pas confirmé ce rendez-vous<br>
						Voulez-vous quand même le supprimer ?
							<div class="btn-alert-style">
								<input class="button-secondary" type="submit" id="' . $row->$rdvId . '-to-delete-alert" name="' . $row->$rdvId . '-to-delete-alert" value="Confirmer la suppression">
							</div>
						</div>
						';
                    }
                }

                if (isset($_POST[$row->$rdvId . '-to-delete-alert'])) {
                    RdvManagerClass::delete($row->$rdvId);
                    echo '<meta http-equiv="REFRESH" content="0">';
                }

                echo '</div>';
            }
            include_once 'includes/rdv_footer_form.php';
        }

        /**
         * @param $dateObject
         * @param $schedule
         * @param $firstname
         * @param $lastname
         * @param $email
         * @param $phone
         * Used for send the email confirmation.
         *
         * @throws Exception
         */
        public static function rdv_confirmation($dateObject, $schedule, $firstname, $lastname, $email, $phone)
        {
            $selectMessage = RdvMessageManager::select();
            $rdvSending = 'rdv_sending';
            $from = 'user_email';
            $fromFirstname = 'first_name';
            $fromLastname = 'last_name';
            $to = $email;
            $subjectCol = 'rdv_msg_subject';
            $titleCol = 'rdv_msg_title';
            $bodyCol = 'rdv_msg_body';

            $subject = $selectMessage->$subjectCol;
            $body = '<h1>' . $selectMessage->$titleCol . '</h1>';
            $body .= '<p style="font-size: 12pt">' . $selectMessage->$bodyCol . '</p>';
            $body .= '<p style="font-size: 12pt">Pour rappel, voici les informations communiqués :</p>';
            $body .= '<ul>';
            $body .= '<li style="font-size: 12pt"><strong>Nom : </strong>' . $firstname . ' ' . $lastname . '.</li>';
            $body .= '<li style="font-size: 12pt"><strong>Date : </strong>' . date_format($dateObject, 'd/m/y') . ' entre ' . $schedule . '.</li>';
            $body .= '<li style="font-size: 12pt"><strong>Numéro de contact : </strong>' . $phone . '</li>';
            $body .= '<p style="font-size: 12pt">Cordialement,</p><br>';
            $body .= '
			<table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:none">
			<tbody>
			<tr>
			<td width="302" valign="top" style="width:226.55pt;padding:0cm 5.4pt 0cm 5.4pt">
			<p class="MsoNormal">
			<span>
			<img width="189" height="189" style="width:1.9687in;height:1.9687in" id="m_-6653833861144460004Image_x0020_1" src="https://jecroquebio.com/wp-content/uploads/2020/08/cropped-je-croque-bio-produits-bretons.jpg" data-image-whitelisted class="CToWUd">
			</span>
			</p>
			</td>
			<td width="302" valign="top" style="width:226.55pt;padding:0cm 5.4pt 0cm 5.4pt">
			<p class="MsoNormal">
			<b><span style="font-size:14.0pt">Gwen ABHAMON<u></u><u></u></span></b></p>
			<p class="MsoNormal"><span style="font-size:14.0pt">Tél&nbsp;: <b>06 20 92 08 12</b></span></p>
			<p class="MsoNormal"><span style="font-size:14.0pt">
			<a href="mailto:jecroquebio@gmail.com" target="_blank"><span style="color:#0563c1">jecroquebio@gmail.com</span></a></span></p>
			<p class="MsoNormal"><span style="font-size:14.0pt"><u></u>&nbsp;<u></u></span></p>
			<p class="MsoNormal"><span style="font-size:14.0pt">SAS LOUTRO 29. </span></p>
			<p class="MsoNormal"><span style="font-size:14.0pt">23 rue du Vieux Port</span></p>
			<p class="MsoNormal"><span style="font-size:14.0pt">29940 LA FORET-FOUESNANT</span>
			<span></span></p></td></tr></tbody></table>
			';
            $header = 'Content-Type: text/html' . "\r\n" .
                'From:' . $selectMessage->$fromFirstname . ' ' . $selectMessage->$fromLastname . '<' . $selectMessage->$from . '>' . "\r\n" .
                'Reply-To:' . $selectMessage->$from;

            if (RdvSettingsManager::select()->$rdvSending) {
                mail(
                    $to,
                    $subject,
                    $body,
                    $header
                );
            }
        }

        public static function rdv_card($cardColor, $rdvFirstname, $rdvLastname, $sentDateObject, $rdvEmail, $rdvPhone, $dateObject, $rdvSchedule, $rdvMessage, $rdvId, $confirmed, $confirm)
        {
            echo '
				<div style="' . $cardColor . '" class="card card-style">
					<h3> ' . $rdvFirstname . ' ' . $rdvLastname . '</h3>
					<em>Demande reçue le : ' . date_format($sentDateObject, "d/m/y") . '</em>
					<ul>
						<li><strong>Email :</strong> ' . $rdvEmail . '</li>
						<li><strong>Téléphone :</strong> ' . $rdvPhone . '</li>
						<li><strong>Horaire et date souhaités :</strong> le ' . date_format($dateObject, "d/m/y") . ' entre ' . $rdvSchedule . '</li>
					</ul>
					<div class="card card-style">
						<p>' . $rdvMessage . '</p>
					</div>
					<hr>
					<div class="options-card-style">
						<div>
							<input type="checkbox" id="' . $rdvId . '-to-delete" name="' . $rdvId . '-to-delete">
							<label for="' . $rdvId . '-to-delete" class="to-delete"><strong>Supprimer</strong></label>
						</div>
						<input ' . $confirmed . ' type="submit" name="' . $rdvId . '-to-confirm" id="' . $rdvId . '-to-confirm" class="button-primary" value="' . $confirm . '">
					</div>
				';
        }
    }
endif;