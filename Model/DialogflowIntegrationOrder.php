<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Model;

use Magento\Framework\Model\AbstractModel;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderInterface;
use SiiPoland\DialogflowIntegration\Model\ResourceModel\DialogflowIntegrationOrder as DialogflowIntegrationOrderResource;

/**
 * Class DialogflowIntegrationOrder
 * @package SiiPoland\DialogflowIntegration\Model
 */
class DialogflowIntegrationOrder extends AbstractModel implements DialogflowIntegrationOrderInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(DialogflowIntegrationOrderResource::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(self::ID);
    }

    /**
     * @return int|null
     */
    public function getCustomerId(): ?int
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return mixed|string
     */
    public function getTraining(): string
    {
        return $this->getData(self::TRAINING);
    }

    /**
     * @param string $training
     */
    public function setTraining(string $training): void
    {
        $this->setData(self::TRAINING, $training);
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->setData(self::LOCATION, $location);
    }

    /**
     * @return int|null
     */
    public function getLocationId(): ?int
    {
        return $this->getData(self::LOCATION_ID);
    }

    /**
     * @param int $locationId
     */
    public function setLocationId(int $locationId): void
    {
        $this->setData(self::LOCATION_ID, $locationId);
    }

    /**
     * @return bool
     */
    public function getProcessed(): bool
    {
        return $this->getData(self::PROCESSED);
    }

    /**
     * @param bool $processed
     */
    public function setProcessed(bool $processed): void
    {
        $this->setData(self::PROCESSED, $processed);
    }

}
