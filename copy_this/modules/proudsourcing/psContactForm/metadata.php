<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @copyright (c) Proud Sourcing GmbH | 2018
 * @link www.proudcommerce.com
 * @package psContactForm
 * @version 1.0.0
 **/

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'psContactForm',
    'title'       => 'psContactForm',
    'description' => [
        'de' => 'Pflichtfeld nur eMail-Adresse beim Kontaktformular (DSGVO).',
        'en' => 'Only email address as requiered field in contact form (GDPR).',
    ],
    'thumbnail'   => '',
    'version'     => '1.0.0',
    'author'      => 'Proud Sourcing GmbH',
    'url'         => 'http://www.proudcommerce.com',
    'email'       => 'support@proudcommerce.com',
    'extend'      => [
        'contact' => 'proudsourcing/psContactForm/application/controllers/pscontactform_contact',
    ],
    'files'       => [
    ],
    'templates'   => [
    ],
    'blocks'      => [
    ],
    'settings'    => [
    ]
];
