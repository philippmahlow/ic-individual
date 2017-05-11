<?php

class Shopware_Plugins_Frontend_EmotionExample_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    public function install()
    {
        /**
         * Create the main component for the emotion element.
         */
        $teaserElement = $this->createEmotionComponent([
            'name' => 'Teaser',
            'xtype' => 'emotion-components-exampleteaser',
            'template' => 'emotion_exampleteaser',
            'cls' => 'emotion-exampleteaser-element',
            'description' => 'A simple teaser element for the shopping worlds.'
        ]);

        $teaserElement->createTextField([
            'name' => 'example_teaser_row1',
            'fieldLabel' => 'Zeile 1',
            'allowBlank' => true
        ]);

        $teaserElement->createTextField([
            'name' => 'example_teaser_row2',
            'fieldLabel' => 'Zeile 2',
            'allowBlank' => true
        ]);

        $teaserElement->createTextField([
            'name' => 'example_teaser_button_label',
            'fieldLabel' => 'Button Text',
            'allowBlank' => true
        ]);

        $teaserElement->createTextField([
            'name' => 'example_teaser_button_link',
            'fieldLabel' => 'Button Link',
            'allowBlank' => true
        ]);

        $teaserElement->createMediaField([
            'name' => 'example_teaser_button_background',
            'fieldLabel' => 'Hintergrundbild',
            'allowBlank' => false
        ]);

        $this->subscribeEvent(
            'Theme_Compiler_Collect_Plugin_Less',
            'onCollectLess'
        );
        return true;
    }

    public function onCollectLess(Enlight_Event_EventArgs $args)
    {
        $lessDir = $this->Path() . '/Views/frontend/_public/src/less/';
        $less = new \Shopware\Components\Theme\LessDefinition(
            array(),
            array(
                $lessDir . 'example_emotions.less'
            )
        );
        return new \Doctrine\Common\Collections\ArrayCollection(array($less));
    }


    public function uninstall()
    {
        return true;
    }

    public function enable()
    {
        return [
            'success' => true,
            'invalidateCache' => ['backend', 'frontend', 'theme']
        ];
    }

    public function disable()
    {
        return [
            'success' => true,
            'invalidateCache' => ['backend', 'frontend', 'theme']
        ];
    }


}