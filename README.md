# MV Rendez-vous

<em>Module pour Wordpress</em>

## Présentation

Ce module pour Wordpress est réalisé dans le cadre d'un projet de stage de validation du titre de Développeur Web et Web
Mobile à l'ENI école informatique. MV Rendez-vous est un plugin de prise de rendez-vous téléphonique qui n'a pas pour
vocation d'être distribué officiellement dans le store.

#### Les grandes et principales fonctionnalités :

* L'utilisateur inscrit ou non, peut soumettre via un formulaire une demande de rendez-vous.
* L'utilisateur peut choisir une tranche horaire pour un rendez-vous téléphonique.
* La demande de rendez-vous est transmise à l'administration dans le back-office Wordpress.
* La demande de rendez-vous est également transmise par email à l'administrateur.
* L'administrateur à la possibilité de confirmer les demandes.
* A la confirmation des demandes par l'administrateur, un email est automatiquement envoyé au demandeur.
* L'administrateur peut supprimer les demandes en cours ou confirmé. Une deuxième validation est demandé si la demande n'a pas été confirmé au préalable.
* L'administrateur peut choisir si oui ou non il recevra un email automatique lors d'une demande.
* L'administrateur peut choisir si oui ou non il enverra un email automatique lors d'une validation de demande.
* L'administrateur peut personnaliser son message d'envoi automatique.

## Environnement de développement

### Pré-requis

* PHP 7.4
* WAMP
* MySQL 5.7
* Wordpress 5.8.x

## Instructions d'installation

* Téléchargez ou clonez le repository dans votre projet par l'arborescence suivante : `MonSite/wp-content/plugins`.
* Dans votre back-office, depuis le panneau *Extensions* activez le nouveau plugin *MV Rendez-vous*.
* Ensuite, créez une nouvelle page, insérez un bloc shortcode et saisissez la commande suivante : `[rdv_form_shortcode]`
* Par défaut et en l'absence de plugin spécifique, l'onglet d'administration du module se positionne en premier dans le menu du back-office.
  . 

Et voilà, le plugin est prêt pour utilisation. Dans votre back-office vous pourrez administrer toutes les demandes de rendez-vous dans le panneau *MV Rendez-vous*.


**Attention ! Étant toujours en phase de développement, la table dédiée dans la base de données sera supprimée à la simple désactivation du plugin.**

###
