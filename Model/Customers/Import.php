<?php

namespace Faal\CustomerImportCli\Model\Customers;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
class Import
{
    protected $customerFactory;
    protected $customerRepository;
    protected $storeManager;
    public function __construct(
        CustomerInterfaceFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        StoreManagerInterface $storeManager
    ){
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->storeManager = $storeManager;
    }
    public function import($customersData){

        try {
            foreach ($customersData as $customerData) {
                $customer= $this->customerFactory->create();
                $customer->setStoreId($this->storeManager->getStore()->getId());
                $customer->setWebsiteId($this->storeManager->getWebsite()->getId());
                $customer->setFirstname($customerData['fname']);
                $customer->setLastname($customerData['lname']);
                $customer->setEmail($customerData['emailaddress']);
                $this->customerRepository->save($customer);
            }
        } catch (\Exception $e) {

        }
    }

}
