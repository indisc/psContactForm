<?php

namespace ProudCommerce\ContactForm\Application\Controllers;


use OxidEsales\Eshop\Core\Email;
use OxidEsales\Eshop\Core\MailValidator;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Module\Module;

class ContactController extends ContactController_parent
{
    /**
     * @inheritdoc
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function send()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);
        $aParams = $request->getRequestParameter('editval');

        // checking email address

        /** @var MailValidator $mailValidator */
        $mailValidator = oxNew(MailValidator::class);
        if (!$mailValidator->isValidEmail($aParams['oxuser__oxusername'])) {
            Registry::getUtilsView()->addErrorToDisplay('ERROR_MESSAGE_INPUT_NOVALIDEMAIL');

            return false;
        }


        $sSubject = $request->getRequestParameter('c_subject');

        // ProudCommerce START
        // if (!$aParams['oxuser__oxfname'] || !$aParams['oxuser__oxlname'] || !$aParams['oxuser__oxusername'] || !$sSubject) {
        if (!$aParams['oxuser__oxusername']) {
            // ProudCommerce STOP

            // even if there is no exception, use this as a default display method
            Registry::getUtilsView()->addErrorToDisplay('ERROR_MESSAGE_INPUT_NOTALLFIELDS');

            return false;
        }
        
        $oModule = oxNew(Module::class);
        if ($oModule->load("oecaptcha") === true && $oModule->isActive()) {
            if (!$this->getCaptcha()->passCaptcha()) {
                return false;
            }
        }

        $oLang = Registry::getLang();
        $sMessage = $oLang->translateString('MESSAGE_FROM') . " " .
            $oLang->translateString($aParams['oxuser__oxsal']) . " " .
            $aParams['oxuser__oxfname'] . " " .
            $aParams['oxuser__oxlname'] . " (" . $aParams['oxuser__oxusername'] . ")\r\n\r\n" .
            $request->getRequestParameter('c_message');

        /** @var Email $oEmail */
        $oEmail = oxNew(Email::class);
        if ($oEmail->sendContactMail($aParams['oxuser__oxusername'], $sSubject, $sMessage)) {
            $this->_blContactSendStatus = 1;
        } else {
            Registry::getUtilsView()->addErrorToDisplay('ERROR_MESSAGE_CHECK_EMAIL');
        }
    }
}