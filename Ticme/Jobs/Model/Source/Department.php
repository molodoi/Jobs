<?php
namespace Ticme\Jobs\Model\Source;
 
class Department implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Ticme\Jobs\Model\Department
     */
    protected $_department;
 
    /**
     * Constructor
     *
     * @param \Ticme\Jobs\Model\Department $department
     */
    public function __construct(\Ticme\Jobs\Model\Department $department)
    {
        $this->_department = $department;
    }
 
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $departmentCollection = $this->_department->getCollection()
            ->addFieldToSelect('entity_id')
            ->addFieldToSelect('name');
        foreach ($departmentCollection as $department) {
            $options[] = [
                'label' => $department->getName(),
                'value' => $department->getId(),
            ];
        }
        return $options;
    }
}