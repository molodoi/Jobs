<?php
namespace Ticme\Jobs\Controller\Job;
class Index extends \Magento\Framework\App\Action\Action
{

	/**
		– On injecte notre session dans le construct
		– Dans la méthode exécute on récupère le paramètre renseigné dans l’URL
		– On l’enregistre dans notre session
	*/
    protected $_jobSession;
 
    /**
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Session\Generic $jobSession
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Session\Generic $jobSession
    )
    {
        parent::__construct($context);
        $this->_jobSession = $jobSession;
    }
 
    public function execute()
    {
        // If n not exists, will return the second parameter : false
        $numberByPage = (int) $this->getRequest()->getParam('n', false);
        if($numberByPage){
            $this->_jobSession->setNumberByPage($numberByPage);
        }
 
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}