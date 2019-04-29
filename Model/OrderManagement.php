<?php

namespace SiiPoland\DialogflowIntegration\Model;

use Magento\Framework\Webapi\Rest\Request;
use SiiPoland\DialogflowIntegration\Api\OrderManagementInterface;


/**
 * Class OrderManagement
 *
 * @package SiiPoland\DialogflowIntegration\Model
 */
class OrderManagement implements OrderManagementInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * OrderManagement constructor.
     *
     * @param Request $request
     */
    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function postOrder(): array
    {
        $json = $this->request->getRequestData();

        return ['status' => true];
    }
}
