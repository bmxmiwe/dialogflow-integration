<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderInterface;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderSearchResultsInterface;
use SiiPoland\DialogflowIntegration\Model\DialogflowIntegrationOrder;

/**
 * Interface DialogflowIntegrationOrderRepositoryInterface
 * @package SiiPoland\DialogflowIntegration\Api
 */
interface DialogflowIntegrationOrderRepositoryInterface
{

    /**
     * Save DialogflowIntegrationOrder
     * @param DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder
     * @return void
     * @throws LocalizedException
     */
    public function save(DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder): void;

    /**
     * Retrieve DialogflowIntegrationOrder
     * @param int $dialogflowintegrationorderId
     * @return DialogflowIntegrationOrder
     * @throws LocalizedException
     */
    public function getById(int $dialogflowintegrationorderId): DialogflowIntegrationOrder;

    /**
     * Retrieve DialogflowIntegrationOrder matching the specified criteria.
     * @param SearchCriteriaInterface $searchCriteria
     * @return DialogflowIntegrationOrderSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): DialogflowIntegrationOrderSearchResultsInterface;

    /**
     * Delete DialogflowIntegrationOrder
     * @param DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder
     * @return void
     * @throws LocalizedException
     */
    public function delete(DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder): void;

    /**
     * Delete DialogflowIntegrationOrder by ID
     * @param int $dialogflowintegrationorderId
     * @return void
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $dialogflowintegrationorderId): void;
}
