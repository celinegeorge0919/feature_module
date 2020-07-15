<?php

namespace Custom\Feature\Setup;

use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Cms\Api\Data\BlockInterfaceFactory;
use Magento\Framework\App\State;
use Magento\Framework\App\Area;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Store\Model\Store;

/**
 * Class InstallData
 *
 * @package Custom\Feature\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;

    /**
     * @var BlockInterfaceFactory
     */
    private $blockInterfaceFactory;

    /**
     * @var State
     */
    private $state;

    /**
     * InstallData constructor.
     *
     * @param BlockRepositoryInterface $blockRepository
     * @param BlockInterfaceFactory $blockInterfaceFactory
     * @param State $state
     */
    public function __construct(
        BlockRepositoryInterface $blockRepository,
        BlockInterfaceFactory $blockInterfaceFactory,
        State $state
    ) {
        $this->blockRepository = $blockRepository;
        $this->blockInterfaceFactory = $blockInterfaceFactory;
        $this->state = $state;
    }

    /**
     * Install data
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws LocalizedException
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
            $this->state->setAreaCode(Area::AREA_ADMINHTML);
            $cmsBlock = $this->blockInterfaceFactory->create();
            $cmsBlock->setIdentifier('custom_cms_block');
            $cmsBlock->setTitle('Custom CMS block');
            $cmsBlock->setContent('Test cms block content');
            $cmsBlock->setData('stores', [Store::DEFAULT_STORE_ID]);
            $this->blockRepository->save($cmsBlock);
    }
}
