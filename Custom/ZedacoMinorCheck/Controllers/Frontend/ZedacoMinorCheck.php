<?php

class Shopware_Controllers_Frontend_ZedacoMinorCheck extends Enlight_Controller_Action implements \Shopware\Components\CSRFWhitelistAware
{

    public function getWhitelistedCSRFActions()
    {
        return ['check'];
    }

    public function checkAction()
    {
        try {
            $params = [
                $this->Request()->getParam('blockA', ''),
                $this->Request()->getParam('blockB', ''),
                $this->Request()->getParam('blockC', ''),
                $this->Request()->getParam('blockD', '')
            ];

            $result = \ZedacoMinorCheck\Service\PersoCheck::validate($params);

            if($result) {
                $user = Shopware()->Modules()->Admin()->sGetUserData();
                if($user && isset($user['additional']['user']['id'])) {
                    $id = $user['additional']['user']['id'];
                    Shopware()->Db()->executeUpdate('UPDATE s_user_attributes SET zedaco_document_check = 1 WHERE userID = ?', [$id]);
                }
            }

        } catch (\Exception $ex) {
            $result = FALSE;
        }

        Shopware()->Plugins()->Controller()->ViewRenderer()->setNoRender();

        $this->Response()->setHeader('Content-type', 'application/json', true);
        $this->Response()->setBody(json_encode(['success' => $result]));

    }
}