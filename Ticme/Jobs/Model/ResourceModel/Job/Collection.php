<?php
namespace Ticme\Jobs\Model\ResourceModel\Job;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/*
 * https://www.maximehuran.fr/creation-dun-modele-sous-magento-2/
 * Collection : Cela permettra de gérer des collections de données, avec des méthodes très utiles telles que des
 * tris, des limites etc…
 */
 
class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \Ticme\Jobs\Model\Job::JOB_ID;
 
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ticme\Jobs\Model\Job', 'Ticme\Jobs\Model\ResourceModel\Job');
    }


    /* Utiliser dans la méthode _getJobCollection de /Jobs/Block/Job/ListJob.php
     * Nous avons mis en paramètre les objets Department et Job pour les avoir sous la main lors de nos tests.
     */
    public function addStatusFilter($job, $department){
        $this->addFieldToSelect('*')
            ->addFieldToFilter('status', $job->getEnableStatus())
            // revient à faire $this->addFieldToSelect('*')
            // ->addFieldToFilter('status', array('eq' => $job->getEnableStatus()));
            // la liste des filtres https://www.maximehuran.fr/manipuler-des-collections-avec-magento-2/
            ->join(
                array('department' => $department->getResource()->getMainTable()),
                'main_table.department_id = department.'.$department->getIdFieldName(),
                array('department_name' => 'name')
            );
 
        return $this;
    }
 
}