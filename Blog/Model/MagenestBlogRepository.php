<?php

namespace Magenest\Blog\Model;

use Magenest\Blog\Api\Data\MagenestBlogInterface;
use Magenest\Blog\Model\ResourceModel\MagenestBlog\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

class MagenestBlogRepository implements \Magenest\Blog\Api\MagenestBlogRepositoryInterface
{
    /**
     * @var \Magenest\Blog\Model\MagenestBlogFactory
     */
    protected $customFactory;

    /**
     * @var ResourceModel\MagenestBlog
     */
    protected $customResource;

    /**
     * @var \Magento\UrlRewrite\Model\UrlRewriteFactory
     */
    protected $_urlRewriteFactory;

    /**
     * @var ResourceModel\MagenestBlog\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magenest\Blog\Api\Data\MagenestBlogSearchResultInterfaceFactory
     */
    protected $searchResultInterfaceFactory;

    /**
     * CustomRepository constructor.
     * @param \Magenest\Blog\Model\MagenestBlogFactory $customFactory
     * @param ResourceModel\MagenestBlog $customResource
     * @param ResourceModel\MagenestBlog\CollectionFactory $collectionFactory
     * @param \Magenest\Blog\Api\Data\MagenestBlogSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        \Magenest\Blog\Model\MagenestBlogFactory $customFactory,
        \Magenest\Blog\Model\ResourceModel\MagenestBlog $customResource,
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory,
        \Magenest\Blog\Model\ResourceModel\MagenestBlog\CollectionFactory $collectionFactory,
        \Magenest\Blog\Api\Data\MagenestBlogSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->customFactory = $customFactory;
        $this->customResource = $customResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
        $this->_urlRewriteFactory = $urlRewriteFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $customModel = $this->customFactory->create();
        $this->customResource->load($customModel, $id);
        if (!$customModel->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find custom data with ID "%1"', $id));
        }
        return $customModel;
    }

    /**
     * {@inheritdoc}
     */
    public function save($magenestBlog)
    {
        $urlRewrite = $this->_urlRewriteFactory->create();

        $getRewriteByRequestpath = $urlRewrite->getCollection()
            ->addFieldToFilter('request_path', $magenestBlog['url_rewrite'])
            ->getData();
        if(count($getRewriteByRequestpath)>0)
        {
            if($getRewriteByRequestpath[0]['entity_id'] != $magenestBlog['id'])
            {
                throw new NoSuchEntityException(__('Url Rewrite existed.'));
            }
        }
        if ($magenestBlog['id']) {
            $getRewriteByTargetPath = $urlRewrite->getCollection()
                ->addFieldToFilter('target_path', 'blog/view/index/id/'.$magenestBlog['id'])
                ->getData();
            $urlRewrite->load($getRewriteByTargetPath[0]['url_rewrite_id']);
        }
        $this->customResource->save($magenestBlog);
        $page = array(
            'entity_type' => 'view',
            'entity_id' => $magenestBlog['id'],
            'request_path' => $magenestBlog['url_rewrite'],
            'target_path' => 'blog/view/index/id/'.$magenestBlog['id'],
            'store_id' => 1
        );
        $urlRewrite->addData($page);
        $urlRewrite->save();
        return $magenestBlog;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        try {
            $customModel = $this->customFactory->create();
            $this->customResource->load($customModel, $id);
            $this->customResource->delete($customModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
