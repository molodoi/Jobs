<?php namespace Ticme\Jobs\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     * https://www.maximehuran.fr/gestion-des-setups-sous-magento-2/
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
 
        /**
         * Create table 'ticme_department'
         */

        // – Un nom : $tableName 
        $tableName = $installer->getTable('ticme_department');
        // – Un commentaire pour la table : $tableComment
        $tableComment = 'Department management for jobs module';
        // Les colonnes de ma table avec leur type, leur taille si nécessaire, certaines options, et un commentaire
        $columns = array(
            'entity_id' => array(
                'type' => Table::TYPE_INTEGER,
                'size' => null,
                'options' => array(
                	    // identity : permet de signaler que notre colonne sera en auto_increment
	                	'identity' => true,
	                	/*
	                	unsigned : nous travaillons avec un entier non signé, cela nous permet d’utiliser les bytes réservés normalement à des valeurs négatives, pour des valeurs positives. Cela permet d’augmenter la valeur maximale de notre champ
	                	*/
	                	'unsigned' => true, 
	                	// nullable : mis à false, cela permet d’ajouter l'action NOT NULL dans notre SQL
	                	'nullable' => false,
	                	//primary : permet de signaler que notre colonne sera la clé primaire de notre table 
	                	'primary' => true
	                	// default : permettrai de choisir une valeur par défaut pour notre colonne
                	),
                'comment' => 'Department Id',
            ),
            'name' => array(
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'options' => array('nullable' => false, 'default' => ''),
                'comment' => 'Department name',
            ),
            'description' => array(
                'type' => Table::TYPE_TEXT,
                'size' => 2048,
                'options' => array('nullable' => false, 'default' => ''),
                'comment' => 'Department description',
            ),
            // içi le champ « name » sera en VARCHAR alors que le champ « description » sera en « TEXT ». C’est Magento qui choisit en fonction de la taille que nous définissons.
        );
 
        $indexes =  array(
            // No index for this table
        );
 
        $foreignKeys = array(
            // No foreign keys for this table
        );
 
        /**
         *  We can use the parameters above to create our table
         */
 
        // Table creation
        $table = $installer->getConnection()->newTable($tableName);
 
        // Columns creation
        foreach($columns AS $name => $values){
            $table->addColumn(
                $name,
                $values['type'],
                $values['size'],
                $values['options'],
                $values['comment']
            );
        }
 
        // Indexes creation
        foreach($indexes AS $index){
            $table->addIndex(
                $installer->getIdxName($tableName, array($index)),
                array($index)
            );
        }
 
        // Foreign keys creation
        foreach($foreignKeys AS $column => $foreignKey){
            $table->addForeignKey(
                $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                $column,
                $foreignKey['ref_table'],
                $foreignKey['ref_column'],
                $foreignKey['on_delete']
            );
        }
 
        // Table comment
        $table->setComment($tableComment);
 
        // Execute SQL to create the table
        $installer->getConnection()->createTable($table);
 
        // End Setup
        $installer->endSetup();
    }
 
}