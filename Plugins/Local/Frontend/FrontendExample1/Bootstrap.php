<?php

class Shopware_Plugins_Frontend_FrontendExample1_Bootstrap
    extends Shopware_Components_Plugin_Bootstrap
{
    public function getInfo()
    {
        return [
            'version' => '1.0.0',
            'label' => 'Frontend Example'
        ];
    }

    public function install()
    {
        $crudService = Shopware()->Container()->get('shopware_attribute.crud_service');

        $crudService->update('s_categories_attributes');

        $this->subscribeEvent(
            'Enlight_Controller_Front_StartDispatch',
            'onFrontStartDispatch'
        );

        return TRUE;
    }

    public function onFrontStartDispatch(Enlight_Event_EventArgs $args)
    {
        Shopware()->Loader()->registerNamespace('FrontendExample1', $this->Path());
        $subscriber = new \FrontendExample1\Subscribers\FrontendSubscriber($this->Path());

        Shopware()->Events()->addSubscriber($subscriber);
    }

}