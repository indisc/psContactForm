<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id' => 'psContactForm',
    'title' => 'psContactForm',
    'description' => [
        'de' => 'Pflichtfeld nur eMail-Adresse beim Kontaktformular (DSGVO).',
        'en' => 'Only email address as requiered field in contact form (GDPR).',
    ],
    'thumbnail' => '',
    'version' => '2.0.1',
    'author' => 'ProudCommerce',
    'url' => 'http://www.proudcommerce.com',
    'email' => 'module@proudcommerce.com',
    'controllers' => [
    ],

    'extend' => [
        \OxidEsales\Eshop\Application\Controller\ContactController::class
            => \ProudCommerce\ContactForm\Application\Controllers\ContactController::class,
    ],

    'templates' => [
    ],

    'blocks' => [
    ],

    'settings' => [
    ],

    'events' => [
    ],
);
