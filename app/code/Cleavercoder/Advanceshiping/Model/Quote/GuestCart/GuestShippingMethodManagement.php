<?php
/**
 * Copyright © 2016 Cleavercoder. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Cleavercoder\Advanceshiping\Model\Quote\GuestCart;

use Cleavercoder\Advanceshiping\Api\Quote\ShippingMethodManagementInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;

/**
 * Shipping method management class for guest carts.
 */
class GuestShippingMethodManagement extends \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement implements
    \Cleavercoder\Advanceshiping\Api\Quote\GuestShippingMethodManagementInterface
{
    /**
     * @var ShippingMethodManagementInterface
     */
    private $shippingMethodManagement;

    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    /**
     * Constructs a shipping method read service object.
     *
     * @param ShippingMethodManagementInterface $shippingMethodManagement
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        ShippingMethodManagementInterface $shippingMethodManagement,
        QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->shippingMethodManagement = $shippingMethodManagement;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function estimateRatesByAddress($cartId, \Cleavercoder\Advanceshiping\Api\Quote\Data\EstimateAddressInterface $address)
    {
        /** @var $quoteIdMask QuoteIdMask */
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->shippingMethodManagement->estimateRatesByAddress($quoteIdMask->getQuoteId(), $address);
    }
}
