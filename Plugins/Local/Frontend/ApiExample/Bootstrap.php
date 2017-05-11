<?php

use Doctrine\ORM\Tools\SchemaTool;
use Shopware\CustomModels\ApiExample\Example;

class Shopware_Plugins_Frontend_ApiExample_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    public function afterInit()
    {
        $this->registerCustomModels();
    }


    public function install()
    {
        $this->registerCustomModels();
        $em = Shopware()->Models();
        $schemaTool = new SchemaTool($em);

        $schemaTool->createSchema([
            $em->getClassMetadata(Example::class)
        ]);

        $this->registerController('api', 'example');
        $this->registerController('backend', 'example');

        $this->createMenuItem(array(
            'label' => 'Example',
            'controller' => 'Example',
            'class' => 'sprite-application-block',
            'action' => 'Index',
            'active' => 1,
            'parent' => $this->Menu()->findOneBy(['label' => 'Artikel'])
        ));

        $this->subscribeEvent('Enlight_Bootstrap_InitResource_shopware.api.example', 'onInitApiResourceExample');

        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatch_Backend_Article',
            'onActionPostDispatchSecureBackendArticle'
        );

        return true;
    }

    public function onActionPostDispatchSecureBackendArticle(Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Backend_Article $subject */
        $subject = $args->getSubject();

        if($subject->Request()->getActionName() === 'load') {
            $subject->View()->addTemplateDir($this->Path() . 'Views/');
            $subject->View()->extendsTemplate('backend/apiexample_article/view/detail/window.js');
        }
    }

    public function onInitApiResourceExample(Enlight_Event_EventArgs $args)
    {
        Shopware()->Loader()->registerNamespace('ApiExample', $this->Path());
        return new \ApiExample\Components\Api\Example();
    }

    public function uninstall()
    {
        $this->registerCustomModels();
        $em = Shopware()->Models();
        $schemaTool = new SchemaTool($em);

        $schemaTool->dropSchema([
            $em->getClassMetadata(Example::class)
        ]);

        return true;
    }
}