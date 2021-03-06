<?php
/**
 * @copyright Copyright (c) 2017 a4logic Colombia (https://www.a4logic.com)
 */

namespace A4logic\Payulatam\Model\Transaction;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

class Service
{
    /**
     * @var \Magento\Sales\Api\TransactionRepositoryInterface
     */
    protected $transactionRepository;

    /**
     * @var \A4logic\Payulatam\Model\ResourceModel\Transaction
     */
    protected $transactionResource;

    /**
     * @param \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepository
     * @param \A4logic\Payulatam\Model\ResourceModel\Transaction $transactionResource
     */
    public function __construct(
        \Magento\Sales\Api\TransactionRepositoryInterface $transactionRepository,
        \A4logic\Payulatam\Model\ResourceModel\Transaction $transactionResource
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionResource = $transactionResource;
    }

    /**
     * @param string $payulatamOrderId
     * @param string $status
     * @param bool $close
     * @throws LocalizedException
     */
    public function updateStatus($payulatamOrderId, $status, $close = false)
    {
        /**
         * @var $transaction \Magento\Sales\Model\Order\Payment\Transaction
         */
        $id = $this->transactionResource->getIdByPayuplOrderId($payulatamOrderId);
        if (!$id) {
            throw new LocalizedException(new Phrase('Transaction ' . $payulatamOrderId . ' not found.'));
        }
        $transaction = $this->transactionRepository->get($id);
        if ($close) {
            $transaction->setIsClosed(1);
        }
        $rawDetailsInfo = $transaction->getAdditionalInformation(
            \Magento\Sales\Model\Order\Payment\Transaction::RAW_DETAILS
        );
        $rawDetailsInfo['status'] = $status;
        $transaction
            ->setAdditionalInformation(\Magento\Sales\Model\Order\Payment\Transaction::RAW_DETAILS, $rawDetailsInfo)
            ->save();
    }
}
