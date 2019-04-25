<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SiiPoland\DialogflowIntegration\Model\DialogflowIntegrationOrder;
use SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder as DialogflowIntegrationOrderResourceModel;

/**
 * Class Collection
 * @package SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder
 */
class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            DialogflowIntegrationOrder::class,
            DialogflowIntegrationOrderResourceModel::class
        );
    }
}
