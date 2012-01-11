<?php
class PWS_FAQ_Block_Adminhtml_Faq_Articles_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        
        $fieldset = $form->addFieldset('faq_articles_form', array(
            'legend'=>Mage::helper('pws_faq')->__('Article Information')
        ));
        
        $fieldset->addField('store_id', 'hidden', array(
            'name'      => 'faq_article[store_id]',
            'label'     => '',
            'class'     => 'required-entry',
            'required'  => true
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'faq_article[title]',
            'label'     => Mage::helper('pws_faq')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
            'class' => 'use_default',
            'note' => Mage::helper('pws_faq')->__('scope: [STORE VIEW]'),
        ));	
		
		try{
            $config = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            /*
			$config->setData(Mage::helper('blog')->recursiveReplace(
                        '/blog_admin/',
                        '/'.(string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName').'/',
                        $config->getData()
                    )
                );
			*/
        }
        catch (Exception $ex){
            $config = null;
        }
		

		$fieldset->addField('faq_content', 'editor', array(
							'name'      => 'faq_article[faq_content]',
							'label'     => Mage::helper('pws_faq')->__('Content'),
							'title'     => Mage::helper('pws_faq')->__('Content'),
							'style'     => 'width:800px; height:400px;',
							'config'    => $config,
							'note' => Mage::helper('pws_faq')->__('scope: [STORE VIEW]'),
			));	
		
		/*
        $fieldset->addField('content', 'editor', array(
            'name'      => 'faq_article[content]',
            'label'     => Mage::helper('pws_faq')->__('Content'),
            'class'     => 'required-entry',
            'required'  => true,
            'wysiwyg'   => true,
            'class' => 'use_default',
            'note' => Mage::helper('pws_faq')->__('scope: [STORE VIEW]'),
        ));
		*/
		
		
        if (Mage::registry('store_id') && Mage::registry('store_id') !=0 ) {		      
            $useDefault = $fieldset->addField('use_default', 'checkbox', array(
                'name'      => 'faq_article[use_default]',
                'label'     => Mage::helper('pws_faq')->__('Use Default Values'),
                'value'		=> '1',       
                'note' => Mage::helper('pws_faq')->__('scope: [STORE VIEW]; use default values for title and content'),
                'onclick' => "",
            ));
        }
             
        $fieldset->addField('status', 'select', array(
                'label'     => Mage::helper('pws_faq')->__('Status'),
                'name'      => 'faq_article[status]',
                'value'		=> 'enabled',
                'values'    => array(
                	array('value'=>'enabled','label'=>'Enabled'),
                	array('value'=>'disabled','label'=>'Disabled')
                ),
                'note' => Mage::helper('pws_faq')->__('scope: [GLOBAL]'),
            ));

      
		if (Mage::registry('faq_article')) {			
        	$form->setValues(Mage::registry('faq_article')->getData()); 
        	$useDefaultValue = Mage::registry('faq_article')->getData('use_default');  
        	if (isset($useDefault) && isset($useDefaultValue) && $useDefaultValue != 0) {
        	    $useDefault->setIsChecked(true);
        	}
        }
        return parent::_prepareForm();
    }

    

    protected function _toHtml()
    {
        return parent::_toHtml();
    }


}
