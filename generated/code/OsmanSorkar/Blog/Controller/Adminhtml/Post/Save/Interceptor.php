<?php
namespace OsmanSorkar\Blog\Controller\Adminhtml\Post\Save;

/**
 * Interceptor class for @see \OsmanSorkar\Blog\Controller\Adminhtml\Post\Save
 */
class Interceptor extends \OsmanSorkar\Blog\Controller\Adminhtml\Post\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Backend\Model\Auth\Session $authSession)
    {
        $this->___init();
        parent::__construct($context, $authSession);
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
