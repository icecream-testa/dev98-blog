<?php

namespace Testa\Blog\Setup;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $pageFactory;
    private $pageResource;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $cmsPageData = [
            // Cms page settings
            'title' => 'Dev98 Blog',
            'page_layout' => '1column',
            'identifier' => 'devblog',
            'content' => "<div><img src='https://dev98.de/wp-content/uploads/2017/01/cropped-ctTJUiqwzSWMLaw_5oneNdpqFKTe9Jen0WF-SWl15FkpX92IB.png'
            class='blog-header' alt='blog-header'/></div>",
            'is_active' => 1,
            'stores' => [0]
        ];

        // Create cms page for magento backend
        $this->pageFactory->create()->setData($cmsPageData)->save();
        $setup->endSetup();
    }
}
