<?php
namespace OsmanSorkar\Blog\Controller\Adminhtml\Post\MassEnable;

/**
 * Interceptor class for @see \OsmanSorkar\Blog\Controller\Adminhtml\Post\MassEnable
 */
class Interceptor extends \OsmanSorkar\Blog\Controller\Adminhtml\Post\MassEnable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \OsmanSorkar\Blog\Model\ResourceModel\Post\CollectionFactory $collectionFactory)
    {
        $this->___init();
        parent::__construct($context, $filter, $collectionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        if (!$pluginInfo) {
            return parent::dispatch($request);
        } else {
            return $this->___callPlugins('dispatch', func_get_args(), $pluginInfo);
        }
    }
}
