<?php
namespace Lof\CustomProduct\Model;


use Lof\CustomProduct\Api\CustomProductSettingManagementInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;

class CustomProductSettingManagement implements CustomProductSettingManagementInterface
{



    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_config;
    public function __construct(ScopeConfigInterface $config)
    {
        $this->_config = $config;
    }


    /**
     * Retrieve store Ids for $path with checking
     * @param string $path
     * @return array
     */
    public function getSetting($path)
    {
        try {
            $value = $this->_config->getValue($path, ScopeInterface::SCOPE_STORE);
        } catch (NoSuchEntityException $e) {

        }
        return $value;
    }

}