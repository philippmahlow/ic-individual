<?php

namespace FrontendExample1\Subscribers;

use Doctrine\Common\Collections\ArrayCollection;
use FrontendExample1\Bundle\StoreFrontBundle\Service\Core\ListProductService;
use FrontendExample1\Bundle\StoreFrontBundle\Service\Core\TestService;
use Shopware\Bundle\StoreFrontBundle\Service\ListProductServiceInterface;
use Shopware\Models\Shop\Shop;

class FrontendSubscriber implements \Enlight\Event\SubscriberInterface
{
    /**
     * @var string
     */
    protected $pluginPath;

    /**
     * FrontendSubscriber constructor.
     * @param string $pluginPath
     */
    public function __construct($pluginPath)
    {
        $this->pluginPath = $pluginPath;
    }


    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Detail' => 'onActionPostDispatchSecureFrontendDetail',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'onCollectJS',
            'Enlight_Bootstrap_AfterInitResource_shopware_storefront.list_product_service'
             => 'afterInitResourceListProductService',
            'Enlight_Bootstrap_InitResource_frontendexample1.test_service' => 'onInitTestService',
            'Enlight_Controller_Action_Frontend_Detail_Index' => 'onReplaceIndex'
        ];
    }

    public function onReplaceIndex(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->getSubject();

        return TRUE;
    }

    public function onInitTestService(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware\Components\DependencyInjection\Container $subject */
        $subject = $args->getSubject();
        return new TestService();
    }

    public function afterInitResourceListProductService(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware\Components\DependencyInjection\Container $subject */
        $subject = $args->getSubject();

        /** @var ListProductServiceInterface $service */
        $service = Shopware()->Container()->get('shopware_storefront.list_product_service');

        $newService = new ListProductService($service, Shopware()->Container()->get('shopware_storefront.storefront_cache'));

        $subject->set('shopware_storefront.list_product_service', $newService);
    }

    public function onCollectJS(\Enlight_Event_EventArgs $args)
    {
        /*$jsDir = $this->pluginPath . '/Views/frontend/_public/src/js/';
        return $jsDir . 'test.js';*/
    }


    public function onActionPostDispatchSecureFrontendDetail(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Detail $subject */
        $subject = $args->getSubject();

        $article = $subject->View()->getAssign('sArticle');
        $article['foo'] = 'bar';
        $subject->View()->assign('sArticle', $article);

        /*
        $service = Shopware()->Container()->get('shopware_storefront.list_product_service');

        $contextService = Shopware()->Container()->get('shopware_storefront.context_service');
        $shopContext = $contextService->getShopContext();
        $productContext = $contextService->createProductContext($shopContext->getShop()->getId());
        $articles = $service->getList(['SW10001'], $productContext);
        */

        $service = Shopware()->Container()->get('frontendexample1.test_service');

        $subject->View()->addTemplateDir($this->pluginPath . 'Views/');
    }

}