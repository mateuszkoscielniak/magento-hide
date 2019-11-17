<?php

namespace MK\Hide\Helper;

/**
 * Class Data
 * @package MK\Hide\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    // HIDE PRICE
    const XML_PATH_MK_HIDE_FINAL_PRICE_GUEST = 'mk/final_price_gust/hide_enabled';
    const XML_PATH_MK_HIDE_FINAL_PRICE_LOGGED_IN = 'mk/final_price_logged_in/hide_enabled';

    //HIDE ADD TO CARD
    const XML_PATH_MK_HIDE_ADD_TO_CARD_GUEST = 'mk/add_to_card_gust/hide_enabled';
    const XML_PATH_MK_HIDE_ADD_TO_CARD_LOGGED_IN = 'mk/add_to_card_logged_in/hide_enabled';


    const XML_PATH_MK_HIDE_DEFAULT_GROUP = 'mk/group/default_group';

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var
     */
    protected $customerSession;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_storeManager = $storeManager;
        $this->_storeManager = $customerSession;
        parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function hideFinalPriceForGuest()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MK_HIDE_FINAL_PRICE_GUEST,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function hideFinalPriceForLoggedIn()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MK_HIDE_FINAL_PRICE_LOGGED_IN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function hideAddToCardGuest()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MK_HIDE_ADD_TO_CARD_GUEST,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function hideAddToCardForLoggedIn()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MK_HIDE_ADD_TO_CARD_LOGGED_IN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    /**
     * @return mixed
     */
    public function getBlockedGroup()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_MK_HIDE_DEFAULT_GROUP,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}