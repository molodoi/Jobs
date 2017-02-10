<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace Ticme\Jobs\Setup; 

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Ticme\Jobs\Model\Department;
use Ticme\Jobs\Model\Job;
use Magento\Config\Model\ResourceModel\Config;
 
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
 
    protected $_department;
    protected $_job;
 
    /**
        – Nous avons ajouté l’attribut $_resourceConfig à notre classe
        – Via le construct on vient le setter avec l’objet que l’on souhaite
        – Puis dans le upgrade, nous faisons un saveConfig pour mettre à jour la donnée

        Le saveConfig comporte les paramètres :
        – Chemin de la config
        – Valeur de la config
        – Portée de la valeur
        – ID du store ou du website, 0 si scope est défault.

        Il est possible de changer le scope :
        – stores : Pour la store view
        – websites : Pour le website

        Dans ce cas le dernier paramètre du saveConfig sera l’ID de votre website ou de votre store view.
    */
    protected $_resourceConfig;
 
    public function __construct(Department $department, Job $job, Config $resourceConfig){
        $this->_department = $department;
        $this->_job = $job;
        $this->_resourceConfig = $resourceConfig;
    }
 
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
 
        // Action to do if module version is less than 1.0.0.1
        /** 
            Nous remarquons l’utilisation de la méthode getVersion, qui permet de retourner la version actuelle de votre module.
        */

        /**
            version_compare retourne -1 si la version actuelle est inférieure à la version voulue
            version_compare retourne 0 si la version actuelle est égale à la version voulue
            version_compare retourne 1 si la version actuelle est supérieure à la version voulue

            Chaque fois que vous allez upgrader un module, il faudra mettre cette condition dans ce même fichier.
        */
        if (version_compare($context->getVersion(), '1.0.0.1') < 0) {
            $departments = [
                [
                    'name' => 'Marketing',
                    'description' => 'Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea,
                aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed
                siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in
                hoc causarum titulo dissimilem sui.'
                ],
                [
                    'name' => 'Technical Support',
                    'description' => 'Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et
                venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque
                nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita
                priscis.'
                ],
                [
                    'name' => 'Human Resource',
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.'
                ]
            ];
 
            /**
             * Insert departments
             */
            $departmentsIds = array();
            foreach ($departments as $data) {
                $department = $this->_department->setData($data)->save();
                $departmentsIds[] = $department->getId();
            }
 
            // Des données fixtures
            $jobs = [
                [
                    'title' => 'Sample Marketing Job 1',
                    'type' => 'CDI',
                    'location' => 'Paris, France',
                    'date'  => '2016-01-05',
                    'status' => $this->_job->getEnableStatus(),
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                    'department_id' => $departmentsIds[0]
                ],
                [
                    'title' => 'Sample Marketing Job 2',
                    'type' => 'CDI',
                    'location' => 'Paris, France',
                    'date'  => '2016-01-10',
                    'status' => $this->_job->getDisableStatus(),
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                    'department_id' => $departmentsIds[0]
                ],
                [
                    'title' => 'Sample Technical Support Job 1',
                    'type' => 'CDD',
                    'location' => 'Lille, France',
                    'date'  => '2016-02-01',
                    'status' => $this->_job->getEnableStatus(),
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                    'department_id' => $departmentsIds[1]
                ],
                [
                    'title' => 'Sample Human Resource Job 1',
                    'type' => 'CDI',
                    'location' => 'Paris, France',
                    'date'  => '2016-01-01',
                    'status' => $this->_job->getEnableStatus(),
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                    'department_id' => $departmentsIds[2]
                ]
            ];
 
            foreach ($jobs as $data) {
                $this->_job->setData($data)->save();
            }
        }
 
 
        // Action to do if module version is less than 1.0.0.3
        if (version_compare($context->getVersion(), '1.0.0.3') < 0) {
            $this->_resourceConfig->saveConfig('jobs/department/view_list', 1, 'default', 0);
        }

        /**
        if (version_compare($context->getVersion(), '1.0.0.0') < -1) {
            // code executé si la version est inférieure à la version voulue içi 1.0.0.0  
        }
 
        if (version_compare($context->getVersion(), '1.0.0.1') < 0) {
            // code executé si la version est égale à la version voulue içi 1.0.0.1   
        }
 
        if (version_compare($context->getVersion(), '1.1.0.0') < 1) {
            // code executé si la version est supérieure à la version voulue içi 1.1.0.0  
        }
        */
 
        $installer->endSetup();
    }
}