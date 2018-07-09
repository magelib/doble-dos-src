<?php
namespace WebShopApps\MatrixRate\Model\ResourceModel\Carrier\Matrixrate;

/**
 * Factory class for @see \WebShopApps\MatrixRate\Model\ResourceModel\Carrier\Matrixrate\Collection
 */
class CollectionFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\WebShopApps\\MatrixRate\\Model\\ResourceModel\\Carrier\\Matrixrate\\Collection')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \WebShopApps\MatrixRate\Model\ResourceModel\Carrier\Matrixrate\Collection
     */
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
