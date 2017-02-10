<?php
namespace Ticme\Jobs\Block\Adminhtml\Department;
 
use Magento\Backend\Block\Widget\Form\Container;
 
class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
 
    /**
     * Le premier construct reste habituel à ce que nous connaissons déjà.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    /**
     * Department edit block
     * Le deuxième construct ne possède qu’un seul underscore. Il est appelé après le premier (qui possède deux underscores).
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'entity_id';
        $this->_blockGroup = 'Ticme_Jobs';
        $this->_controller = 'adminhtml_department';
 
        parent::_construct();
        /*
        A l’intérieur nous affichons ou non le bouton de sauvegarde en fonction des droits de l’utilisateur.
        Nous ajoutons aussi un bouton « Save & Continue edit » pour sauvegarder et rester sur le formulaire.
        */
        if ($this->_isAllowedAction('Ticme_Jobs::department_save')) {
            $this->buttonList->update('save', 'label', __('Save Department'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }
 
    }
 
    /**
     * Get header with Department name
     * La méthode « getHeaderText » est appelée dans la classe parente dans la méthode « getHeaderHtml ».
     * Dans l’affichage de la page elle n’est pas utilisée, mais nous la mettons en place quand même.
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('jobs_department')->getId()) {
            return __("Edit Department '%1'", $this->escapeHtml($this->_coreRegistry->registry('jobs_department')->getName()));
        } else {
            return __('New Department');
        }
    }
 
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
 
    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     * La méthode _getSaveAndContinueUrl permet de rediriger l’utilisateur sur le formulaire d’édition après la 
     * sauvegarde.
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('jobs/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}