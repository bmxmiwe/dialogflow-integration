<?php

namespace SiiPoland\DialogflowIntegration\Api;

/**
 * Interface OrderManagementInterface
 *
 * @package SiiPoland\DialogflowIntegration\Api
 */
interface OrderManagementInterface
{

    /**
     * POST for Order api
     *
     * @return array
     */
    public function postOrder(): array;
}