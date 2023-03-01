<?php

namespace Magenest\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface MagenestBlogInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $id
     * @return $this
     */
    public function setEntityId($id);

    /**
     * @return int
     */
    public function getAuthorId();

    /**
     * @param int $author_id
     * @return $this
     */
    public function setAuthorId($author_id);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getUrlRewrite();

    /**
     * @param string $title
     * @return $this
     */
    public function setUrlRewrite($url_rewrite);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at);

    /**
     * @return string
     */
    public function getUpdatedAt();

    /**
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at);
}
