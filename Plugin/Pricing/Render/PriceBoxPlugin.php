<?php

namespace MK\Hide\Plugin\Pricing\Render;

use Magento\Framework\Pricing\Render\PriceBox;
use MK\Hide\Helper\Data;
use Magento\Framework\App\Http\Context;
use Magento\Customer\Model\Context as CustomerContext;

/**
 * Class PriceBoxPlugin
 * @package MK\Hide\Plugin\Pricing\Render
 */
class PriceBoxPlugin
{
    /**
     * @var Data
     */
    private $data;

    /**
     * @var Context
     */
    protected $context;

    /**
     * PriceBoxPlugin constructor.
     * @param Data $data
     * @param Context $context
     */
    public function __construct(Data $data, Context $context)
    {
        $this->data = $data;
        $this->context = $context;
    }

    /**
     * @param PriceBox $priceBox
     * @param $return
     * @return string
     */
    public function afterRenderAmount(PriceBox $priceBox, $return)
    {
        $isLoggedIn = $this->context->getValue(CustomerContext::CONTEXT_AUTH);
        $customer_group = $this->context->getValue(CustomerContext::CONTEXT_GROUP);

        if($customer_group == $this->data->getBlockedGroup()){
            return '';
        }

        if ($isLoggedIn && $this->data->hideFinalPriceForLoggedIn()) {
            return '';
        }
        if (!$isLoggedIn && $this->data->hideFinalPriceForGuest()) {
            return '';
        }
        return $return;
    }
}
