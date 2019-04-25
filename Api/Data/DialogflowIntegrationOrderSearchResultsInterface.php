<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface DialogflowIntegrationOrderSearchResultsInterface
 * @package SiiPoland\DialogflowIntegration\Api\Data
 */
interface DialogflowIntegrationOrderSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get DialogflowIntegrationOrder list.
     * @return DialogflowIntegrationOrderInterface[]
     */
    public function getItems(): array;

    /**
     * Set customer_id list.
     * @param DialogflowIntegrationOrderInterface[] $items
     * @return $this
     */
    public function setItems(array $items): array;
}
