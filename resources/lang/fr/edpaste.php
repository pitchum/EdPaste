<?php

return [

    'page.title.dashboard'      => 'Tableau de bord',
    'page.title.home'           => 'Accueil',
    'page.title.notfound'       => 'Non trouvé',
    'page.title.account'        => 'Mon compte',
    'page.title.login'          => 'Authenfitication',
    'page.title.register'       => 'Enregistrement',

    'menu.home'                 => 'Accueil',
    'menu.dashboard'            => 'Tableau de bord',
    'button.yes'  => 'Oui',
    'button.no'   => 'Non',

    'paste.title'               => 'Titre',
    'paste.untitled'            => 'Sans titre',
    'paste.title.placeholder'   => 'Nom du post-it (facultatif)',
    'paste.content'             => 'Contenu',
    'paste.content.placeholder' => 'Collez votre texte ici...',
    'paste.expiration'          => 'Expiration du post-it',
    'paste.privacy'             => 'Type d\'accès',
    'paste.option.enable.syntax' => 'Activer le surlignage syntaxique',
    'paste.submit.tooltip'      => 'Plus d\'options de visibilité sont disponibles pour les utilisateurs authentifés',
    'paste.submit'              => 'Soumettre',


    'paste.option.expiration.never' => 'Jamais',
    'paste.option.expiration.burn_after_reading' => 'S\'autodétruit après lecture',
    'paste.option.expiration.10min' => '10 minutes',
    'paste.option.expiration.1h'    => '1 heure',
    'paste.option.expiration.1d'    => '1 jour',
    'paste.option.expiration.1w'    => '1 semaine',
    'paste.option.expiration.1m'    => '1 mois',
    'paste.option.expiration.3m'    => '3 mois',

    'paste.option.privacy.link'     => 'Non listé, accès public avec un lien',
    'paste.option.privacy.internal' => 'Interne, accès pour les utilisateurs authentifiés avec un lien',
    'paste.option.privacy.password' => 'Public, protégé par un mot de passe',
    'paste.option.privacy.private'  => 'Privé, pour vous seulement',

    /* Dashboard */
    'paste.views'               => 'Vues',
    'paste.creation'            => 'Création',
    'paste.confirm.delete.title' => 'Supprimer "<i>:pastename</i>" ?',
    'paste.confirm.delete'      => 'Êtes vous sûr ? Il est <strong>impossible</strong> de revenir en arrière !',
    'paste.option.expired'      => 'Expiré',

    /* View paste */
    'paste.msg.expired.viewable'    => 'Ce post-it a expiré, mais vous pouvez toujours le consulter en tant que rédacteur·trice.',
    'paste.msg.burnafter.viewable'  => 'Ce post-it s\'autodétruira après lecture. À partir de maintenant, il ne peut être visionné qu\'une seule fois.',
    'paste.msg.burnafter.last.view' => '<strong>Attention !</strong> Ce post-it va s\'autodétruire après lecture et vous ne pourrez plus le voir.',
    'paste.syntax-highlighted'      => 'Surlignage syntaxique',
    'paste.plain-text'              => 'Texte brut',
    'paste.raw'                 => 'Afficher',
    'paste.edit'                => 'Modifier le post-it',
    'paste.view_count'          => 'Nombre de vues',
    'paste.views'               => '{1} :count vue|[2,*] :count vues',
    'paste.username'            => 'Auteur',
    'password.title'              => 'Mot de passe',
    'paste.notfound'           => 'Page non trouvée - Le post-it n\'existe pas, a expiré, ou nécessite une authentification.',
    'button.goto.home'         => 'Retourner à la page d\'accueil',
    'button.goto.auth'         => 'Vous êtes sûr·e de votre lien ? Cliquez ici pour vous authentifier !',

    /* Password prompt page */
    'page.title.password.prompt'  => 'Demande de mot de passe',
    'password.field.placeholder'  => 'Entrez le mot de passe',
    'password.submit'             => 'Soumettre',

    /* Edit paste page */
    'page.title.edit'  => 'Edition :pastename',

    /* Validation messages */
    'validation.error.password'  => 'Veuillez saisir un mot de passe',
    'validation.error.notempty'  => 'Votre post-it ne peut être vide.',
    'validation.error.maxlength' => 'Le titre ne doit pas excéder 70 caractères',
    'validation.error.expiration.required'  => 'L\'expiration du post-it est obligatoire',

];
