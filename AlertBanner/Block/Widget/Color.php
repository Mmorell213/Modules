<?php
namespace Perficient\AlertBanner\Block\Widget;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Color extends Template implements BlockInterface
{
    public function prepareElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $defaultColor = "#8ec63f";
        $value = $element->getValue() ?: defaultColor;
        $element->setData('after_element_html', '
            <input type="text" 
                style="height: 55px; width: 55px;"
                value="' . $value . '" 
                id="' . $element->getHtmlId() . '"
                name="' . $element->getName() . '"
            >
            <script type="text/javascript">
            require(["jquery", "jquery/colorpicker/js/colorpicker"], function ($) {
                $currentElement = $("#' . $element->getHtmlId() . '");
                $currentElement.css("backgroundColor", "'. $value .'");
                $currentElement.ColorPicker({
                    color: "' . $value . '",
                    onChange: function (hsb, hex, rgb) {
                        $currentElement.css("backgroundColor", "#" + hex).val("#" + hex);
                    }
                });
            });
            </script><style>.colorpicker {z-index: 10010}</style>');
        $element->setValue(null);
        return $element;
    }
}
