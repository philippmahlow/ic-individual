<?php

namespace SensusFlyOut;


use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Theme\LessDefinition;

class SensusFlyOut extends \Shopware\Components\Plugin
{


    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure' => 'onActionPostDispatch',
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles',
        ];
    }

    public function addLessFiles(\Enlight_Event_EventArgs $args)
    {
        $less = new LessDefinition(
            [],
            [
                $this->getPath().'/Resources/views/frontend/_public/fob.css',
            ]
        );
        return new ArrayCollection([$less]);
    }

    public function onActionPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->getSubject();

        $configVars = [
            'dimension',
            'position',
            'margin',
            'visual_effects',
            'animation',
            'speed',
            'effect',
            'button',
            'hidden',
        ];

        foreach($configVars as $var) {
            $subject->View()->assign('sensus_flyout_' . $var, Shopware()->Config()->getByNamespace('SensusFlyOut', $var));
        }

        $subject->View()->addTemplateDir($this->getPath().'/Resources/views/');
    }


}