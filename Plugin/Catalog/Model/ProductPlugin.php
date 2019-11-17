<?php

namespace MK\Hide\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;
use MK\Hide\Helper\Data;
use Magento\Framework\App\Http\Context;
use Magento\Customer\Model\Context as CustomerContext;

/**
 * Class ProductPlugin
 * @package MK\Hide\Plugin\Catalog\Model
 */
class ProductPlugin
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
     * @param Product $subject
     * @param $return
     * @return bool
     */
    public function afterIsSaleable(Product $subject, $return)
    {

        $isLoggedIn = $this->context->getValue(CustomerContext::CONTEXT_AUTH);
        $customer_group = $this->context->getValue(CustomerContext::CONTEXT_GROUP);

        if($customer_group == $this->data->getBlockedGroup()){
            return false;
        }
        if ($isLoggedIn && $this->data->hideAddToCardForLoggedIn()) {
            return false;
        }
        if (!$isLoggedIn && $this->data->hideAddToCardGuest()) {
            return false;
        }

        return $return;
    }
}
