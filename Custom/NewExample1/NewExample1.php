<?php

namespace NewExample1;

use Shopware\Components\Plugin\Context\InstallContext;

class NewExample1 extends \Shopware\Components\Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Detail' => 'onPostDispatch'
        ];
    }

    public function onPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->getSubject();


    }


    public function install(InstallContext $context)
    {
        parent::install($context);
    }

}