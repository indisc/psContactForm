<?php
/**
 *
 * @package ##@@PACKAGE@@##
 * @version ##@@VERSION@@##
 * @link www.proudcommerce.com
 * @author Proud Sourcing <support@proudcommerce.com>
 * @copyright Proud Sourcing GmbH | 2019
 *
 * This Software is the property of Proud Sourcing GmbH
 * and is protected by copyright law, it is not freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 **/

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
    'version' => '2.0.0',
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
