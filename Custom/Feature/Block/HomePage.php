<?php

namespace Custom\Feature\Block;

use Magento\Framework\View\Element\Template;
use Magento\Cms\Block\Block;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class HomePage
 *
 * @package Custom\Feature\Block
 */
class HomePage extends Template
{
    /**
     * @var Block
     */
    private $cmsBlock;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * XML path for custom enable field
     */
    const XML_PATH_CUSTOM_ENABLE = 'custom_section/general/custom_enable';

    /**
     * XML path for custom text field
     */
    const XML_PATH_CUSTOM_TEXT = 'custom_section/general/custom_text';

    /**
     * HomePage constructor.
     *
     * @param Template\Context $context
     * @param Block $cmsBlock
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Block $cmsBlock,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->cmsBlock = $cmsBlock;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get configuration values
     *
     * @param string $path
     * @return string
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Determine whether to display block or not
     *
     * @return boolean
     */
    public function showBlockData()
    {
        return $this->getConfig(self::XML_PATH_CUSTOM_ENABLE);
    }

    /**
     * Get custom Text
     *
     * @return string
     */
    public function getCustomText()
    {
        return $this->getConfig(self::XML_PATH_CUSTOM_TEXT);
    }

    /**
     * Get CMS Block Content
     *
     * @return string
     */
    public function fetchCmsBlockData()
    {
        return $this->cmsBlock->setBlockId('custom_cms_block')->toHtml();
    }
}
