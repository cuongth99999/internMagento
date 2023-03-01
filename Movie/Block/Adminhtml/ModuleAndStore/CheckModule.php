<?php

namespace Magenest\Movie\Block\Adminhtml\ModuleAndStore;

class CheckModule extends \Magento\Framework\View\Element\Template
{
    protected $fullModuleList;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        array $data = []
    ) {
        $this->fullModuleList = $fullModuleList;
        parent::__construct($context, $data);
    }

    public function modulesList()
    {
        $allModules = $this->fullModuleList->getAll();

        $totalModule = count($allModules);

        $total = [];
        $total['totalModule'] = $totalModule;
        $total['allModules'] = $allModules;

        $moduleName = $this->fullModuleList->getNames();
        $total_module_non_magento = 0;
        foreach($moduleName as $name)
        {
            if (strlen(strstr($name, 'Magenest_')) > 0) {
                $total_module_non_magento++;
            }
        }
        $total['total_module_non_magento'] = $total_module_non_magento;
        return $total;
    }
}
