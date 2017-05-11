<?php

namespace ZedacoMinorCheck;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Theme\LessDefinition;

class ZedacoMinorCheck extends Plugin
{
    public function install(InstallContext $context)
    {
        $crudService = $this->container->get('shopware_attribute.crud_service');
        $crudService->update('s_user_attributes', 'zedaco_document_check', 'boolean', [
            'displayInBackend' => true,
            'label' => 'Ausweisdokument verifiziert?'
        ]);
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PreDispatch_Frontend_Checkout' => 'onPreDispatchCheckout',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout' => 'onPostDispatchCheckout',
            'Theme_Compiler_Collect_Plugin_Less' => 'onCollectLessFiles',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'onCollectJavascript'
        ];
    }

    public function onPostDispatchCheckout(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Checkout $subject */
        $subject = $args->getSubject();

        if ($subject->Request()->getActionName() !== 'cart') {
            if (!$this->isUserDocumentValidated()) {
                $subject->View()->assign('zedacoDocumentValidationRequired', TRUE);
                $subject->View()->addTemplateDir($this->getPath() . '/Resources/views/');
            }
        }
    }

    public function onPreDispatchCheckout(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Checkout $subject */
        $subject = $args->getSubject();

        if ($subject->Request()->getActionName() !== 'cart') {
            if (!$this->isUserDocumentValidated()) {
                if ($subject->Request()->getActionName() == 'finish') {
                    $subject->redirect(['action' => 'confirm']);
                }
            }
        }
    }

    /**
     * @return bool
     */
    protected function isUserDocumentValidated()
    {
        $user = Shopware()->Modules()->Admin()->sGetUserData();

        $documentValidated = $user && isset($user['additional']['user']['zedaco_document_check']) && $user['additional']['user']['zedaco_document_check'] && $user['additional']['user']['zedaco_document_check'] != '0';

        /*if(!$documentValidated && isset($user["additional"]["countryShipping"]['id']) && $user["additional"]["countryShipping"]['id'] != 2) {
            $documentValidated = TRUE;
        }*/

        return $documentValidated;
    }

    public function onCollectLessFiles()
    {
        $lessDir = $this->getPath() . '/Resources/views/frontend/_public/src/less/';

        $less = new LessDefinition(
            array(),
            array(
                $lessDir . 'all.less'
            )
        );

        return new ArrayCollection(array($less));
    }

    public function onCollectJavascript()
    {
        return new ArrayCollection([
            $this->getPath() . '/Resources/views/frontend/_public/src/js/tabs.js',
            $this->getPath() . '/Resources/views/frontend/_public/src/js/passportForm.js'
        ]);
    }


}