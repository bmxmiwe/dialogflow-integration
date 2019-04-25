<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Api\Data;

/**
 * Interface DialogflowIntegrationOrderInterface
 * @package SiiPoland\DialogflowIntegration\Api\Data
 */
interface DialogflowIntegrationOrderInterface
{
    const PROCESSED = 'processed';
    const LOCATION = 'location';
    const EMAIL = 'email';
    const ID = 'id';
    const NAME = 'name';
    const TRAINING = 'training';
    const CUSTOMER_ID = 'customer_id';
    const LOCATION_ID = 'location_id';

    /**
     * Get id
     * @return int
     */
    public function getId(): int;

    /**
     * Get customer_id
     * @return int|null
     */
    public function getCustomerId(): ?int;

    /**
     * Set customer_id
     * @param int $customerId
     * @return void
     */
    public function setCustomerId(int $customerId): void;

    /**
     * Get name
     * @return string
     */
    public function getName(): string;

    /**
     * Set name
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * Get email
     * @return string
     */
    public function getEmail(): string;

    /**
     * Set email
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void;

    /**
     * Get training
     * @return string
     */
    public function getTraining(): string;

    /**
     * Set training
     * @param string $training
     * @return void
     */
    public function setTraining(string $training): void;

    /**
     * Get location
     * @return string|null
     */
    public function getLocation(): string;

    /**
     * Set location
     * @param string $location
     * @return void
     */
    public function setLocation(string $location): void;

    /**
     * Get location_id
     * @return int|null
     */
    public function getLocationId(): ?int;

    /**
     * Set location_id
     * @param int $locationId
     * @return void
     */
    public function setLocationId(int $locationId): void;

    /**
     * Get processed
     * @return bool
     */
    public function getProcessed(): bool;

    /**
     * Set processed
     * @param bool $processed
     * @return void
     */
    public function setProcessed(bool $processed): void;
}
