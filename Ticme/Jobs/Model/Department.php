<?php
namespace Ticme\Jobs\Model;
 
use \Magento\Framework\Model\AbstractModel;

/*
 * https://www.maximehuran.fr/creation-dun-modele-sous-magento-2/
 */
 
class Department extends AbstractModel
{
    const DEPARTMENT_ID = 'entity_id'; // We define the id fieldname
 
    /**
     * Prefix of model events names / Un prefixe d’evenement
     *
     * @var string
     */
    protected $_eventPrefix = 'jobs'; // parent value is 'core_abstract'
 
    /**
     * Name of the event object / Un nom d’objet pour les événements
     *
     * @var string
     */
    protected $_eventObject = 'department'; // parent value is 'object'
 
    /**
     * Name of object id field / Un nom de champ ID
     *
     * @var string
     */
    protected $_idFieldName = self::DEPARTMENT_ID; // parent value is 'id'
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ticme\Jobs\Model\ResourceModel\Department');
    }
 
}