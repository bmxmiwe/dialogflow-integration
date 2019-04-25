<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Model\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Processed
 * @package SiiPoland\DialogflowIntegration\Model\Source
 */
class Processed implements ArrayInterface
{
    /**
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 1, 'label' => __('Yes')]
        ];
    }

}
