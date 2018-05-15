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

class psContactForm_contact extends psContactForm_contact_parent
{

    /**
     * Composes and sends user written message, returns false if some parameters
     * are missing.
     *
     * @return bool
     */
    public function send()
    {
        $aParams = oxRegistry::getConfig()->getRequestParameter('editval');

        // checking email address
        if (!oxRegistry::getUtils()->isValidEmail($aParams['oxuser__oxusername'])) {
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('ERROR_MESSAGE_INPUT_NOVALIDEMAIL');

            return false;
        }

        // spam spider prevension
        $sMac = oxRegistry::getConfig()->getRequestParameter('c_mac');
        $sMacHash = oxRegistry::getConfig()->getRequestParameter('c_mach');
        $oCaptcha = $this->getCaptcha();

        if (!$oCaptcha->pass($sMac, $sMacHash)) {
            // even if there is no exception, use this as a default display method
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('MESSAGE_WRONG_VERIFICATION_CODE');

            return false;
        }

        $sSubject = oxRegistry::getConfig()->getRequestParameter('c_subject');

        // proud sourcing START
        // if (!$aParams['oxuser__oxfname'] || !$aParams['oxuser__oxlname'] || !$aParams['oxuser__oxusername'] || !$sSubject) {
        if (!$aParams['oxuser__oxusername']) {
        // proud sourcing STOP

            // even if there is no exception, use this as a default display method
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('ERROR_MESSAGE_INPUT_NOTALLFIELDS');

            return false;
        }

        $oLang = oxRegistry::getLang();
        $sMessage = $oLang->translateString('MESSAGE_FROM') . " " .
            $oLang->translateString($aParams['oxuser__oxsal']) . " " .
            $aParams['oxuser__oxfname'] . " " .
            $aParams['oxuser__oxlname'] . "(" . $aParams['oxuser__oxusername'] . ")<br /><br />" .
            nl2br(oxRegistry::getConfig()->getRequestParameter('c_message'));

        $oEmail = oxNew('oxemail');
        if ($oEmail->sendContactMail($aParams['oxuser__oxusername'], $sSubject, $sMessage)) {
            $this->_blContactSendStatus = 1;
        } else {
            oxRegistry::get("oxUtilsView")->addErrorToDisplay('ERROR_MESSAGE_CHECK_EMAIL');
        }
    }

}
