<?php
namespace Ticme\Jobs\Controller\Job;
 
class Testregistry extends \Magento\Framework\App\Action\Action
{
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_registry;
 
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context);
        $this->_registry = $registry;
    }
 
    public function execute()
    {

    	/**
			La méthode prend un 3è paramètre qui permet de ne pas lancer d’erreur si la variable est déjà enregistrée. En effet, si une variable a déjà été settée via le register, il n’est pas possible de l’écraser. Il faut la supprimer, puis la réenregistrer. Si le paramètre gracefull est à « true », aucune erreur ne sera renvoyée mais la valeur ne sera pas écrasée. Pour cela, vous pouvez consulter la classe lib/internal/Magento/Framework/Registry.php, qui contient la méthode « register »
    	*/
		//Créer une variable de registre
        $this->_registry->register('my_registry_var', 'my global value');
 		//Récupérer une valeur de registre
        echo $this->_registry->registry('my_registry_var');
    }
}