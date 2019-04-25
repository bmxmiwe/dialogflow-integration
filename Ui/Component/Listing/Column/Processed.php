<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Processed
 * @package SiiPoland\DialogflowIntegration\Ui\Component\Listing\Column
 */
class Processed extends Column
{
    /**
     * Processed constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items['processed'] == 1) {
                    $items['processed'] = 'Yes';
                } else {
                    $items['processed'] = 'No';
                }
            }
        }
        return $dataSource;
    }
}
