<?php
namespace Magenest\Movie\Block\Adminhtml\ModuleAndStore;

class CheckStore extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory;
    protected $productFactory;
    protected $orderFactory;
    protected $invoiceRepository;
    protected $creditmemoRepository;
    public function __construct(

        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\CustomerFactory          $customerFactory,
        \Magento\Catalog\Model\ProductFactory            $productFactory,
        \Magento\Sales\Model\OrderFactory                $orderFactory,
        \Magento\Sales\Api\InvoiceRepositoryInterface    $invoiceRepository,
        \Magento\Sales\Api\CreditmemoRepositoryInterface $creditmemoRepository,
        array $data = []
    ) {
        $this->customerFactory = $customerFactory;
        $this->productFactory = $productFactory;
        $this->orderFactory = $orderFactory;
        $this->invoiceRepository = $invoiceRepository;
        $this->creditmemoRepository = $creditmemoRepository;
        parent::__construct($context, $data);
    }

    public function storeList()
    {
        $customer = $this->customerFactory->create()->getCollection()->addAttributeToSelect("*")->load();
        $product = $this->productFactory->create()->getCollection()->addAttributeToSelect("*")->load();
        $order = $this->orderFactory->create()->getCollection()->addAttributeToSelect("*")->load();
        $invoice = $this->invoiceRepository->create()->getCollection()->addAttributeToSelect("*")->load();
        $creditmemo = $this->creditmemoRepository->create()->getCollection()->addAttributeToSelect("*")->load();

        $totalCustomer = count($customer->getItems());
        $totalProduct = count($product->getItems());
        $totalOrder = count($order->getItems());
        $totalInvoice = count($invoice->getItems());
        $totalCreditmemo = count($creditmemo->getItems());

        $total = [];
        $total['totalCustomer'] = $totalCustomer;
        $total['totalProduct'] = $totalProduct;
        $total['totalOrder'] = $totalOrder;
        $total['totalInvoice'] = $totalInvoice;
        $total['totalCreditmemo'] = $totalCreditmemo;

        return $total;
    }
}

