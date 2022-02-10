<?php

namespace Faal\CustomerImportCli\Model\Files;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\File\Csv as CsvFile;

class Csv 
{
    protected $file;
    protected $csv;
    public function __construct(
        File $file,
        CsvFile $csv
    ){
        $this->file = $file;
        $this->csv = $csv;
    }
    public function process($file){
        try {
            if ($this->file->isExists($file)) {
                $this->csv->setDelimiter(",");
                $data = $this->csv->getData($file);
                if (!empty($data)) {
                    $customers = [];
                    foreach (array_slice($data, 1) as $key => $value) {
                        $customer = [];
                        $customer['fname'] = trim($value['0']);
                        $customer['lname'] = trim($value['1']);
                        $customer['emailaddress'] = trim($value['2']);
                        $customers[] = $customer;
                    }
                    return $customers;
                }
            }
        } catch (FileSystemException $e) {
        }
    }
}
