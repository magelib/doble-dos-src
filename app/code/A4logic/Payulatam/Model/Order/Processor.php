<?php
/**
 * @copyright Copyright (c) 2017 a4logic Colombia (https://www.a4logic.com)
 */

namespace A4logic\Payulatam\Model\Order;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

class Processor
{
    /**
     * @var \A4logic\Payulatam\Model\Order
     */
    protected $orderHelper;

    /**
     * @var \A4logic\Payulatam\Model\Transaction\Service
     */
    protected $transactionService;

    /**
     * @param \A4logic\Payulatam\Model\Order $orderHelper
     * @param \A4logic\Payulatam\Model\Transaction\Service $transactionService
     */
    public function __construct(
        \A4logic\Payulatam\Model\Order $orderHelper,
        \A4logic\Payulatam\Model\Transaction\Service $transactionService
    ) {
        $this->orderHelper = $orderHelper;
        $this->transactionService = $transactionService;
    }

    /**
     * @param string $payulatamOrderId
     * @param string$status
     * @param bool $close
     * @throws LocalizedException
     */
    public function processOld($payulatamOrderId, $status, $close = false)
    {
        $this->transactionService->updateStatus($payulatamOrderId, $status, $close);
    }

    /**
     * @param string $payulatamOrderId
     * @param string $status
     * @throws LocalizedException
     */
    public function processPending($payulatamOrderId, $status)
    {
        $this->transactionService->updateStatus($payulatamOrderId, $status);
    }

    /**
     * @param string $payulatamOrderId
     * @param string $status
     * @throws LocalizedException
     */
    public function processHolded($payulatamOrderId, $status)
    {
        $order = $this->loadOrderByPayuplOrderId($payulatamOrderId);
        $this->orderHelper->setHoldedOrderStatus($order, $status);
        $this->transactionService->updateStatus($payulatamOrderId, $status, true);
    }

    /**
     * @param string $payulatamOrderId
     * @param string $status
     * @throws LocalizedException
     * @todo Implement some additional logic for transaction confirmation by store owner.
     */
    public function processWaiting($payulatamOrderId, $status)
    {
        $this->transactionService->updateStatus($payulatamOrderId, $status);
    }

    /**
     * @param string $payulatamOrderId
     * @param string $status
     * @param float $amount
     * @throws LocalizedException
     */
    public function processCompleted($payulatamOrderId, $status, $amount)
    {
        $order = $this->loadOrderByPayuplOrderId($payulatamOrderId);
        $this->orderHelper->completePayment($order, $amount, $payulatamOrderId);
        $this->transactionService->updateStatus($payulatamOrderId, $status, true);
    }

    /**
     * @param string $payulatamOrderId
     * @return \A4logic\Payulatam\Model\Sales\Order
     * @throws LocalizedException
     */
    protected function loadOrderByPayuplOrderId($payulatamOrderId)
    {
        $order = $this->orderHelper->loadOrderByPayuplOrderId($payulatamOrderId);
        if (!$order) {
            throw new LocalizedException(new Phrase('Order not found.'));
        }
        return $order;
    }
}
