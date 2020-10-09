<?php

return [

    'page.title.dashboard'      => 'Dashboard',
    'page.title.home'           => 'Home',
    'page.title.notfound'       => 'Not found',
    'page.title.account'        => 'My Account',
    'page.title.login'          => 'Login',
    'page.title.register'       => 'Register',

    'menu.home'                 => 'Home',
    'menu.dashboard'            => 'Dashboard',
    'button.yes'  => 'Yes',
    'button.no'   => 'No',

    'paste.title'               => 'Title',
    'paste.untitled'            => 'Untitled',
    'paste.title.placeholder'   => 'Title (optional)',
    'paste.content'             => 'Content',
    'paste.content.placeholder' => 'Paste your text here...',
    'paste.expiration'          => 'Paste expiration',
    'paste.privacy'             => 'Privacy',
    'paste.option.enable.syntax' => 'Enable syntax highlighting',
    'paste.submit.tooltip'      => 'Registered users have access to other privacy tools',
    'paste.submit'              => 'Submit',


    'paste.option.expiration.never' => 'Never',
    'paste.option.expiration.burn_after_reading' => 'Burn after reading',
    'paste.option.expiration.10min' => '10 minutes',
    'paste.option.expiration.1h'    => '1 hour',
    'paste.option.expiration.1d'    => '1 day',
    'paste.option.expiration.1w'    => '1 week',

    'paste.option.privacy.link'     => 'Unlisted, access with link',
    'paste.option.privacy.internal' => 'Internal, authenticated users with link',
    'paste.option.privacy.password' => 'Password-protected',
    'paste.option.privacy.private'  => 'Private (only me)',

    /* Dashboard */
    'paste.views'               => 'Views',
    'paste.creation'            => 'Creation',
    'paste.confirm.delete.title' => 'Delete "<i>{{ :pastename }}</i>"?',
    'paste.confirm.delete'      => 'Are you sure? You <strong>cannot</strong> undo this',
    'paste.option.expired'      => 'Expired',

    /* View paste */
    'paste.msg.expired.viewable'    => 'This paste has expired, however since you wrote it you may view it whenever you want.',
    'paste.msg.burnafter.viewable'  => 'This paste is in burn after reading. From now, it could be viewed only one time.',
    'paste.msg.burnafter.last.view' => '<strong>Be careful!</strong> This paste is in burn after reading mode and you won\'t be able to see it again',
    'paste.syntax-highlighted'      => 'Syntax-highlighted',
    'paste.plain-text'              => 'Plain-text',
    'paste.raw'                => 'Raw paste',
    'paste.edit'               => 'Edit paste',
    'paste.view_count'         => 'Times viewed',
    'paste.views'              => '{1} :count view|[2,*] :count views',
    'paste.username'           => 'Username',
    'password.title'           => 'Password',
    'paste.notfound'           => 'Content may be not found or expired, or access may be denied. Please <a href="/users/dashboard">log-in here</a>',
    'button.goto.home'         => 'Return to home page',
    'button.goto.auth'         => 'If you\'re confident in your link, click here to authenticate!',

    /* Password prompt page */
    'page.title.password.prompt'  => 'Password prompt',
    'password.field.placeholder'  => 'Enter paste pasword',
    'password.submit'             => 'Submit',

    /* Edit paste page */
    'page.title.edit'  => 'Edit :pastename',

    /* Validation messages */
    'validation.error.password'  => 'Please enter a password please',
    'validation.error.notempty'  => 'Your paste cannot be empty.',
    'validation.error.maxlength' => 'Title must not exceed 70 characters.',
    'validation.error.expiration.required'  => 'Paste expiration is required.',

];
