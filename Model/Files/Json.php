<?php

namespace Faal\CustomerImportCli\Model\Files;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Serialize\Serializer\Json as JsonFile;

class Json
{
    protected $file;
    protected $json;
    public function __construct(
        File $file,
        JsonFile $json
    ){
        $this->file = $file;
        $this->json = $json;
    }
    public function process($file){
        try {
            if ($this->file->isExists($file)) {
                $contents =  $this->file->fileGetContents($file);
                $jsonDecode = $this->json->unserialize($contents);
                return $jsonDecode;
            }
        } catch (FileSystemException $e) {

        }
    }
}
