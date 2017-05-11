<?php

class Shopware_Controllers_Api_Example extends Shopware_Controllers_Api_Rest
{
    /**
     * @var \ApiExample\Components\Api\Example
     */
    protected $resource = null;

    public function init()
    {
        $this->resource = \Shopware\Components\Api\Manager::getResource('example');
    }

    /**
     * Get list of example
     *
     * GET /api/example/
     */
    public function indexAction()
    {
        $limit = $this->Request()->getParam('limit', 1000);
        $offset = $this->Request()->getParam('start', 0);
        $sort = $this->Request()->getParam('sort', []);
        $filter = $this->Request()->getParam('filter', []);

        $result = $this->resource->getList($offset, $limit, $filter, $sort);

        $this->View()->assign($result);
        $this->View()->assign('success', true);
    }

    /**
     * Get one example
     *
     * GET /api/example/{id}
     */
    public function getAction()
    {
        $id = $this->Request()->getParam('id');

        $example = $this->resource->getOne($id);

        $this->View()->assign('data', $example);
        $this->View()->assign('success', true);
    }

    /**
     * Create new example
     *
     * POST /api/example
     */
    public function postAction()
    {
        $example = $this->resource->create($this->Request()->getPost());

        $location = $this->apiBaseUrl . 'example/' . $example->getId();
        $data = [
            'id' => $example->getId(),
            'location' => $location,
        ];

        $this->View()->assign(['success' => true, 'data' => $data]);
        $this->Response()->setHeader('Location', $location);
    }

    /**
     * Update example
     *
     * PUT /api/example/{id}
     */
    public function putAction()
    {
        $id = $this->Request()->getParam('id');
        $params = $this->Request()->getPost();

        $example = $this->resource->update($id, $params);

        $location = $this->apiBaseUrl . 'example/' . $example->getId();
        $data = [
            'id' => $example->getId(),
            'location' => $location,
        ];

        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    /**
     * Delete example
     *
     * DELETE /api/example/{id}
     */
    public function deleteAction()
    {
        $id = $this->Request()->getParam('id');

        $this->resource->delete($id);

        $this->View()->assign(['success' => true]);
    }
}