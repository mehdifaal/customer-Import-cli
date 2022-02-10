<?php

namespace Faal\CustomerImportCli\Model\Files;

class FilesFactory
{
    protected $objectManager;
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create($name)
    {
        $type = $this->objectManager->create($name);
        return $type;
    }
}
