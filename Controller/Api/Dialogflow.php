<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Controller\Api;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Webapi\Exception;

/**
 * Class Dialogflow
 * @package Sii\DialogflowIntegration\Controller\Api
 */
class Dialogflow extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonResultFactory;

    /**
     * Dialogflow constructor.
     * @param Context $context
     * @param JsonFactory $jsonResultFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonResultFactory
    ) {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $contentType = $this->getRequest()->getHeader('Content-Type');
        if (!is_string($contentType) || 0 === strpos($contentType, 'application/json')) {
            /** @var Json $result */
            $result = $this->jsonResultFactory->create();
            $result->setHttpResponseCode(Exception::HTTP_BAD_REQUEST);
            $result->setData(['error_message' => __('What are you doing here?')]);
            return $result;
        }
    }
}
