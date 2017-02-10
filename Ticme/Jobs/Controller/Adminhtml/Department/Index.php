<?php
namespace Ticme\Jobs\Controller\Adminhtml\Department;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
 
class Index extends Action
{
    /*
     La constante ADMIN_RESSOURCE est très importante car elle permet de vérifier si nous avons accès à ce contenu de l’admin (ACL).
     Dans notre acl.xml c'est l’id de la première ligne 
    */
    const ADMIN_RESOURCE = 'Ticme_Jobs::department';
 
    /**
     * L’attribut « resultPageFactory » et la méthode construct sont obligatoires, c’est l’injection de dépendance qui 
     * nous y oblige. Sans cette partie, vous aurez l’erreur suivante :
     * Notice: Undefined property: Ticme\Jobs\Controller\Adminhtml\Job\Index\Interceptor::$resultPageFactory
     * @var PageFactory
     */
    protected $resultPageFactory;
 
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
 
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        /* setActiveMenu permet de mettre en surbrillance le menu courant, 
        c’est le menu déclaré dans le menu.xml. */
        $resultPage->setActiveMenu('Ticme_Jobs::department');
        /*
        Les méthodes addBreadcrumb permettent de compléter le fil d’ariane, la première valeur est le label de l’élément, le deuxième est le title.
        Il existe un 3è paramètre facultatif qui est le lien voulu au clic sur l’élément.
        !!! Le fil d’ariane n’à pas l’air visible dans la partie admin, j’ai vérifié dans des modules natifs de Magento et ces méthodes sont appelées.
        C’est donc pour celà que je les ai mises dans le modules même si on ne voit pas leur affichage.
        */
        $resultPage->addBreadcrumb(__('Jobs'), __('Jobs'));
        $resultPage->addBreadcrumb(__('Manage Departments'), __('Manage Departments'));
        /* ->prepend, permet de précéder le titre de la page par « Department », de ce fait, le title de notre page est « Department / Jobs / Magento Admin » */
        $resultPage->getConfig()->getTitle()->prepend(__('Department'));
 
        return $resultPage;
    }
}