<?php
namespace Ticme\Jobs\Model\ResourceModel\Department;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
/*
 * https://www.maximehuran.fr/creation-dun-modele-sous-magento-2/
 * Collection : Cela permettra de gérer des collections de données, avec des méthodes très utiles telles que des
 * tris, des limites etc…
 */


class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \Ticme\Jobs\Model\Department::DEPARTMENT_ID;
 
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ticme\Jobs\Model\Department', 'Ticme\Jobs\Model\ResourceModel\Department');
    }
 
}