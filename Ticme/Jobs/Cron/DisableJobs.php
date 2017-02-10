<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ticme\Jobs\Cron;
 
class DisableJobs
{
    /**
     * @var \Ticme\Jobs\Model\Job
     */
    protected $_job;
 
    /**
     * @param \Ticme\Jobs\Model\Job $job
     */
    public function __construct(
        \Ticme\Jobs\Model\Job $job
    ) {
        $this->_job = $job;
    }
 
    /**
     * Disable jobs which date is less than the current date
     *
     * @return void
     */
    public function execute()
    {
        $nowDate = date('Y-m-d');
        $jobsCollection = $this->_job->getCollection()
            ->addFieldToFilter('date', array ('lt' => $nowDate));
 
        foreach($jobsCollection AS $job) {
            $job->setStatus($job->getDisableStatus());
            $job->save();
        }
    }
}