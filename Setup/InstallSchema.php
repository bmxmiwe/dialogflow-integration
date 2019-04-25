<?php
declare(strict_types=1);

namespace SiiPoland\DialogflowIntegration\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 *
 * @package SiiPoland\DialogflowIntegration\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var string
     */
    const TABLE_NAME = 'dialogflow_integration_order';

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $tableDialogflowOrder = $setup->getConnection()->newTable($setup->getTable(self::TABLE_NAME));
        $tableDialogflowOrder->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'ID'
        );
        $tableDialogflowOrder->addColumn(
            'customer_id',
            Table::TYPE_INTEGER,
            10,
            ['nullable' => true, 'unsigned' => true],
            'Customer id'
        );
        $tableDialogflowOrder->addColumn(
            'name',
            Table::TYPE_TEXT,
            250,
            ['nullable' => false],
            'Name'
        );
        $tableDialogflowOrder->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Email'
        );

        $tableDialogflowOrder->addColumn(
            'training',
            Table::TYPE_TEXT,
            250,
            ['nullable' => false],
            'Training name'
        );
        $tableDialogflowOrder->addColumn(
            'location',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true, 'default' => null],
            'Training Location'
        );
        $tableDialogflowOrder->addColumn(
            'location_id',
            Table::TYPE_INTEGER,
            null,
            [],
            'Location Id'
        );
        $tableDialogflowOrder->addColumn(
            'processed',
            Table::TYPE_BOOLEAN,
            1,
            ['default' => 0],
            'It was processed?'
        );

        $tableDialogflowOrder->addForeignKey(
            $setup->getFkName(
                self::TABLE_NAME,
                'customer_id',
                'customer_entity',
                'entity_id'
            ),
            'customer_id',
            'customer_entity',
            'entity_id',
            Table::ACTION_CASCADE
        );

        $setup->getConnection()->createTable($tableDialogflowOrder);
        $setup->endSetup();
    }
}
