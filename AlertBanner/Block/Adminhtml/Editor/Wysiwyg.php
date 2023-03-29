<?php

namespace Perficient\AlertBanner\Block\Adminhtml\Editor;

class Wysiwyg extends \Magento\Backend\Block\Widget\Form\Element
{
    /**
     * @var \Magento\Framework\Data\Form\Element\Factory
     */
    protected $elementFactory;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $wysiwygConfig;

    /**
     * Wysiwyg constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Data\Form\Element\Factory $elementFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Data\Form\Element\Factory $elementFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->elementFactory = $elementFactory;
        $this->wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return \Magento\Framework\Data\Form\Element\AbstractElement
     */
    public function prepareElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $wysiwygConfig = $this->wysiwygConfig->getConfig([
            'add_variables' => false,
            'add_widgets' => false,
            'add_images' => false,
        ]);
        $editor = $this->elementFactory->create('editor', ['data' => $element->getData()])
            ->setLabel('Editor')
            ->setForm($element->getForm())
            ->setWysiwyg(false)
            ->setConfig($wysiwygConfig);
        if ($element->getRequired()) {
            $editor->addClass('required-entry');
        }
        $element->setData(
            'after_element_html', $this->getAfterElementHtml() . $editor->getElementHtml()
        );
        return $element;
    }

    /**
     * @return string
     */
    protected function getAfterElementHtml() {
        $html = '<style>.admin__field-control.control .control-value { display: none }</style>';

        return $html;
    }
}
