<?php
declare(strict_types=1);

namespace Sii\DialogflowIntegration\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

/**
 * Class InstallSchema
 * @package Sii\DialogflowIntegration\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var string
     */
    const TABLE_NAME = 'sii_dialogflow_order';

    /**
     * @param SchemaSetupInterface $setup
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
            'dialogflow_order_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Entity ID'
        );
        $tableDialogflowOrder->addColumn(
            'participant_name',
            Table::TYPE_TEXT,
            250,
            ['nullable' => false],
            'Participant name'
        );
        $tableDialogflowOrder->addColumn(
            'participant_email',
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Participant email'
        );
        $tableDialogflowOrder->addColumn(
            'participant_customer_id',
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true],
            'Participant customer id'
        );
        $tableDialogflowOrder->addColumn(
            'course_name',
            Table::TYPE_TEXT,
            250,
            ['nullable' => false],
            'Course name'
        );
        $tableDialogflowOrder->addColumn(
            'course_location',
            Table::TYPE_TEXT,
            255,
            [],
            'Course location'
        );
        $setup->getConnection()->createTable($tableDialogflowOrder);
        $setup->endSetup();
    }
}
