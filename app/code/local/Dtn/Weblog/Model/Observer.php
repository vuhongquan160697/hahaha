<?php

class Dtn_Weblog_Model_Observer extends Varien_Event_Observer{
    public function modifiCustomerName($observer){
        $temp = $observer;
        $event = $observer->getEvent();
        $customer = $event->getCustomer();
        $customer->setFirstname('DTN');
        $customer->save();

    }
}