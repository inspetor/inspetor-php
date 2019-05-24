<?php

namespace Inspetor\Inspetor;

interface InspetorService
{
    /**
     * @return boolean
     */
    public function verifyTracker();
    
    /**
     * @param mixed  $orderData
     * @param string $action
     */
    public function trackOrderAction($orderData, $action);

    /**
     * @param mixed  $saleData
     * @param string $action
     */
    public function trackSaleAction($saleData, $action);

    /**
     * @param mixed  $userData
     * @param string $action
     */
    public function trackUserAction($userData, $action);

    /**
     * @param mixed  $userData
     * @param string $action
     */
    public function trackTicketTransfer($transferData, $action);

    /**
     * @param mixed $userData
     * @param string $action
     */
    public function trackUserAuthentication($userData, $action);
}
