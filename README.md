# MV Rendez-vous

<em>Plugin for Wordpress</em>

## Introduction
<hr>

This plugin for WordPress has developed as part of the validation of the title web developer at 'ENI école informatique'. MV Rendez-vous is a phone appointment plugin and is not intended for the official store.

#### Main functionalities :

* User, registered or not, can submit an appointment via a form page.
* User can choose a schedule among propositions.
* The appointment submission is sent to the WordPress back-office.
* The appointment submission is sent to the administrator emailbox.
* Administrator can validate the appointment by one click only.
* By validation of the appointment by the administrator, an email is sent to the requesting user.
* The administrator can delete an appointment in progress or validated. A confirmation message appears if the appointment has not been confirmed before.
* Administrator can choose if yes or not he will receive the appointment in his emailbox.
* Administrator can choose if yes or not he will send an email for appointment confirmation.
* Administrator can customize the message to send.

## Development environment 
<hr>

### Prerequisites

* PHP 7.4
* WAMP
* MySQL 5.7
* Wordpress 5.8.x

## Installation instructions
<hr>

* Download or clone the repository inside your project path as follows : `MyProject/wp-content/plugins`.
* From your WordPress back-office, activate the plugin *MV Rendez-vous*.
* For the next step, create a new page, insert a shortcode block and type following line : `[rdv_form_shortcode]`
* By default, without specific extension, the plugin's onglet appear in the first on the panel on the left side.

And now, the plugin is ready to tu use. You can manage your appointments by the *Rendez-vous* onglet and set your preferences by the *Paramètres* onglet.


**Please note that the database tables will be dropped on deactivation.**

###
