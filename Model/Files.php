<?php

namespace Faal\CustomerImportCli\Model;

use Faal\CustomerImportCli\Model\Files\FilesFactory;

class Files
{
    protected $filesFactory;
    protected $files;
    public function __construct(
        FilesFactory $filesFactory,
        array $files
    ){
        $this->filesFactory = $filesFactory;
        $this->files = $files;
    }
    public function readFile($filePath, $filetype){
        $type = $this->getFileType($filetype);
        $fileModel = $this->filesFactory->create($this->files[$type]);
        return $fileModel->process($filePath);
    }
    private function getFileType($file){
        $array = explode('-', $file);
        return strtoupper($array[1]);
    }
}
