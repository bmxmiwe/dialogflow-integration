<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderInterface;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderInterfaceFactory;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderSearchResultsInterfaceFactory;
use SiiPoland\DialogflowIntegration\Api\DialogflowIntegrationOrderRepositoryInterface;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderSearchResultsInterface;
use SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder as ResourceDialogflowIntegrationOrder;
use SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder\CollectionFactory as DialogflowIntegrationOrderCollectionFactory;

/**
 * Class DialogflowIntegrationOrderRepository
 * @package SiiPoland\DialogflowIntegration\Model
 */
class DialogflowIntegrationOrderRepository implements DialogflowIntegrationOrderRepositoryInterface
{
    /**
     * @var DialogflowIntegrationOrderInterfaceFactory
     */
    protected $dataDialogflowIntegrationOrderFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var ResourceDialogflowIntegrationOrder
     */
    protected $resource;
    /**
     * @var DialogflowIntegrationOrderFactory
     */
    protected $dialogflowIntegrationOrderFactory;
    /**
     * @var DialogflowIntegrationOrderCollectionFactory
     */
    protected $dialogflowIntegrationOrderCollectionFactory;
    /**
     * @var DialogflowIntegrationOrderSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @param ResourceDialogflowIntegrationOrder $resource
     * @param DialogflowIntegrationOrderFactory $dialogflowIntegrationOrderFactory
     * @param DialogflowIntegrationOrderInterfaceFactory $dataDialogflowIntegrationOrderFactory
     * @param DialogflowIntegrationOrderCollectionFactory $dialogflowIntegrationOrderCollectionFactory
     * @param DialogflowIntegrationOrderSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceDialogflowIntegrationOrder $resource,
        DialogflowIntegrationOrderFactory $dialogflowIntegrationOrderFactory,
        DialogflowIntegrationOrderInterfaceFactory $dataDialogflowIntegrationOrderFactory,
        DialogflowIntegrationOrderCollectionFactory $dialogflowIntegrationOrderCollectionFactory,
        DialogflowIntegrationOrderSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->dialogflowIntegrationOrderFactory = $dialogflowIntegrationOrderFactory;
        $this->dialogflowIntegrationOrderCollectionFactory = $dialogflowIntegrationOrderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataDialogflowIntegrationOrderFactory = $dataDialogflowIntegrationOrderFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder
     * @return void
     * @throws CouldNotSaveException
     */
    public function save(DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder): void
    {
        try {
            $this->resource->save($dialogflowIntegrationOrder);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the dialogflowIntegrationOrder: %1',
                $exception->getMessage()
            ));
        }
    }

    /**
     * @param int $dialogflowIntegrationOrderId
     * @return DialogflowIntegrationOrder
     * @throws NoSuchEntityException
     */
    public function getById(int $dialogflowIntegrationOrderId): DialogflowIntegrationOrder
    {
        $dialogflowIntegrationOrder = $this->dialogflowIntegrationOrderFactory->create();
        $this->resource->load($dialogflowIntegrationOrder, $dialogflowIntegrationOrderId);
        if (!$dialogflowIntegrationOrder->getId()) {
            throw new NoSuchEntityException(__('DialogflowIntegrationOrder with id "%1" does not exist.', $dialogflowIntegrationOrderId));
        }
        return $dialogflowIntegrationOrder;
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return DialogflowIntegrationOrderSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): DialogflowIntegrationOrderSearchResultsInterface
    {
        $collection = $this->dialogflowIntegrationOrderCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder
     * @return void
     * @throws CouldNotDeleteException
     */
    public function delete(DialogflowIntegrationOrderInterface $dialogflowIntegrationOrder): void
    {
        try {
            $this->resource->delete($dialogflowIntegrationOrder);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the DialogflowIntegrationOrder: %1',
                $exception->getMessage()
            ));
        }
    }

    /**
     * @param int $dialogflowIntegrationOrderId
     * @throws LocalizedException
     */
    public function deleteById(int $dialogflowIntegrationOrderId): void
    {
        $this->delete($this->getById($dialogflowIntegrationOrderId));
    }
}
