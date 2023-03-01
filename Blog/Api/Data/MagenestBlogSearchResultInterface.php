<?php

namespace Magenest\Blog\Api\Data;

interface MagenestBlogSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Magenest\Blog\Api\Data\MagenestBlogInterface[]
     */
    public function getItems();

    /**
     * @param \Magenest\Blog\Api\Data\MagenestBlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
