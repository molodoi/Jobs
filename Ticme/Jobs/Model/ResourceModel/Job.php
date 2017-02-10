<?php
namespace Ticme\Jobs\Model\ResourceModel;
 
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
/*
 * https://www.maximehuran.fr/creation-dun-modele-sous-magento-2/
 */
 
/**
 * Department post mysql resource
 */
class Job extends AbstractDb
{
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('ticme_job', 'entity_id');
    }
 
}