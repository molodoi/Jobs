<?php
namespace Ticme\Jobs\Model\Source\Job;
/**
 *Récupération des options customs dans une grid et dans un menu déroulant
 */
class Status implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Ticme\Jobs\Model\Job
     */
    protected $_job;
 
    /**
     * Constructor
     *
     * @param \Ticme\Jobs\Model\Job $job
     */
    public function __construct(\Ticme\Jobs\Model\Job $job)
    {
        $this->_job = $job;
    }
 
    /**
     * Get options il faut que l’on se charge de l’affichage de la colonne.
     * Et modifiez la classe Job pour ajouter la méthode getAvailableStatuses
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $availableOptions = $this->_job->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}