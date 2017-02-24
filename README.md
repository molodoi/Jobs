Jobs Module
========================

Technologies & versions:
- Magento 2.1.3
        
Content
========================
Build a Magento Module 

Bug sur le TP 1 :
- Problème de doublons (id&title||id&name) sur les filters :
https://github.com/molodoi/Jobs/blob/master/Ticme/Jobs/view/adminhtml/ui_component/jobs_department_listing.xml
https://github.com/molodoi/Jobs/blob/master/Ticme/Jobs/view/adminhtml/ui_component/jobs_job_listing.xml

Install
========================
- Download project https://github.com/molodoi/Jobs.git
- Extract archive and copy all directories from Jobs to app/code/Ticme/Jobs
- php bin/magento setup:upgrade
- rm -rf pub/static/* 
- rm -rf var/*
- php bin/magento setup:static-content:deploy --language="en_US" --theme="Magento/luma" --area="frontend"
- php bin/magento setup:static-content:deploy --language="fr_FR" --theme="Magento/luma" --area="frontend"
- php bin/magento setup:static-content:deploy --language="en_US" --area="adminhtml"
- php bin/magento setup:static-content:deploy --language="fr_FR" --area="adminhtml"
