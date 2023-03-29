<?php

namespace Perficient\AlertBanner\Block\Widget;

use Magento\Framework\View\Element\Template;

class AlertBanner extends Template implements \Magento\Widget\Block\BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'Perficient_AlertBanner::widget/alert-banner.phtml';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * AlertBanner constructor.
     * @param Template\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getData('content');
    }

    public function getBackgroundColor()
    {
        $color = $this->getData('background_color');
        return $color ?: '#000000';
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        $from = $this->getData('date_from');
        $to = $this->getData('date_to');
        $currentDate = $this->dateTime->date('Y-m-d');
        if (empty($to) && $currentDate >= $from) {
            return true;
        } elseif ($currentDate >= $from && $currentDate <= $to) {
            return true;
        }
        return false;
    }
}
