<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Plugin\Customer;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Math\Random;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use SiiPoland\DialogflowIntegration\Api\Data\DialogflowIntegrationOrderInterface;
use SiiPoland\DialogflowIntegration\Api\DialogflowIntegrationOrderRepositoryInterface;
use SiiPoland\DialogflowIntegration\Model\DialogflowIntegrationOrderRepository;
use Exception;

/**
 * Class AccountCheck
 * @package SiiPoland\DialogflowIntegration\Plugin\Customer
 */
class AccountCheck
{
    /**
     * @var int;
     */
    private const PASSWORD_LENGTH = 10;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var DialogflowIntegrationOrderRepositoryInterface
     */
    private $orderIntegrationRepository;

    /**
     * @var CustomerInterfaceFactory|CustomerFactory
     */
    private $customerFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Random
     */
    private $random;

    /**
     * @var AccountManagementInterface
     */
    private $accountManagment;

    /**
     * AccountCheck constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerInterfaceFactory $customerFactory
     * @param DialogflowIntegrationOrderRepositoryInterface $orderIntegrationRepository
     * @param StoreManagerInterface $storeManager
     * @param EncryptorInterface $encryptor
     * @param LoggerInterface $logger
     * @param Random  $random
     * @param AccountManagementInterface $accountManagement
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerFactory,
        DialogflowIntegrationOrderRepositoryInterface $orderIntegrationRepository,
        StoreManagerInterface $storeManager,
        EncryptorInterface $encryptor,
        LoggerInterface $logger,
        Random $random,
        AccountManagementInterface $accountManagement
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
        $this->orderIntegrationRepository = $orderIntegrationRepository;
        $this->storeManager = $storeManager;
        $this->encryptor = $encryptor;
        $this->logger = $logger;
        $this->random = $random;
        $this->accountManagment = $accountManagement;
    }

    /**
     * @param DialogflowIntegrationOrderRepository $subject
     * @param $result
     * @param DialogflowIntegrationOrderInterface $integrationOrder
     * @return mixed
     */
    public function afterSave(DialogflowIntegrationOrderRepository $subject, $result, DialogflowIntegrationOrderInterface $integrationOrder)
    {
        try {
            if (null === $integrationOrder->getCustomerId()) {
                if ($this->isCustomerAccountExists($integrationOrder->getEmail())) {
                    $this->setCustomerIdInIntegrationOrder($integrationOrder);
                } else {
                    $this->createCustomerAccount($integrationOrder);
                    $this->resetPassword($integrationOrder->getEmail());
                }
            }
        } catch (Exception $exception) {
            $this->logger->error("There was an error in creating new customer account or adding customer ID: " . $exception->getMessage());
        }
        return $result;
    }

    /**
     * @param string $email
     * @return bool
     * @throws LocalizedException
     */
    private function isCustomerAccountExists(string $email): bool
    {
        try {
            $this->customerRepository->get($email);
        } catch (NoSuchEntityException $exception) {
            return false;
        }
        return true;
    }

    /**
     * @param DialogflowIntegrationOrderInterface $integrationOrder
     * @throws InputException
     * @throws LocalizedException
     * @throws InputMismatchException
     */
    private function createCustomerAccount(DialogflowIntegrationOrderInterface $integrationOrder): void
    {
        $websiteId = $this->storeManager->getWebsite()->getWebsiteId();
        $namesArray = $this->getNameAndSurname($integrationOrder->getName());
        $firstName = (array_key_exists(0, $namesArray)) ? $namesArray[0] : '';
        $lastName = (array_key_exists(1, $namesArray)) ? $namesArray[1] : '';
        $newCustomer = $this->customerFactory->create();
        $newCustomer->setWebsiteId($websiteId);
        $newCustomer->setEmail($integrationOrder->getEmail());
        $newCustomer->setFirstname($firstName);
        $newCustomer->setLastname($lastName);
        $this->customerRepository->save($newCustomer, $this->encryptor->getHash($this->generatePassword(), true));
        $this->setCustomerIdInIntegrationOrder($integrationOrder);
    }

    /**
     * @param DialogflowIntegrationOrderInterface $integrationOrder
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    private function setCustomerIdInIntegrationOrder(DialogflowIntegrationOrderInterface $integrationOrder): void
    {
        $customer = $this->customerRepository->get($integrationOrder->getEmail());
        $integrationOrder->setCustomerId((int)$customer->getId());
        $this->orderIntegrationRepository->save($integrationOrder);
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    private function generatePassword(): string
    {
        return $this->random->getRandomString(self::PASSWORD_LENGTH, null);
    }

    /**
     * @param $string
     * @return array
     */
    private function getNameAndSurname(string $string): array
    {
        return explode(' ', $string);
    }

    /**
     * @param string $email
     */
    private function resetPassword(string $email): void
    {
        try {
            $this->accountManagment->initiatePasswordReset($email, AccountManagement::EMAIL_RESET);
        } catch (Exception $exception) {
            $this->logger->error('Unable to to send password reset email for ' . $email);
        }
    }
}
