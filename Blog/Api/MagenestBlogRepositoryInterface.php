<?php

namespace Magenest\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magenest\Blog\Api\Data\MagenestBlogInterface;

interface MagenestBlogRepositoryInterface
{
    /**
     * @param int $id
     * @return \Magenest\Blog\Api\Data\MagenestBlogInterface
     */
    public function getById($id);

    /**
     * @param \Magenest\Blog\Api\Data\MagenestBlogInterface $magenestBlog
     * @return \Magenest\Blog\Api\Data\MagenestBlogInterface
     */
    public function save(MagenestBlogInterface $magenestBlog);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magenest\Blog\Api\Data\MagenestBlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
