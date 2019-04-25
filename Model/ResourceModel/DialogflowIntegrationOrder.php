<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class DialogflowIntegrationOrder
 * @package SiiPoland\DialogflowIntegration\Model\ResourceModel
 */
class DialogflowIntegrationOrder extends AbstractDb
{
    /**
     * @var string
     */
    const TABLE_NAME = 'dialogflow_integration_order';

    /**
     * @var string
     */
    const PRIMARY_KEY = 'id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}
