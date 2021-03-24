<?php

namespace Testa\Blog\Block;

use Magento\Framework\View\Element\Template;

class BlogProvider extends Template
{
    // URL to  netz98 blog
    public const BLOG_URL = "https://dev98.de/";
    const FEED_URL = self::BLOG_URL ."feed/";

    // File backup latest rss-feed
    const FEED_CACHE_DIR = BP . "/var" . "/blog_posts/";
    protected $feed_cache_file = self::FEED_CACHE_DIR . "rss_feed.xml";

    public function __construct(Template\Context $context)
    {
        parent::__construct($context);
    }

    public function getLatestFeed()
    {
        // Check if the feed is already cached
        if(!is_dir(self::FEED_CACHE_DIR)) {
            mkdir(self::FEED_CACHE_DIR, 0755);
        }
        $file = $this->feed_cache_file;

        // Check how old the feed cache file is
        if(!file_exists($file) || time() - filectime($file) > 12 * 3600) {
            $feed_content = file_get_contents(self::FEED_URL);
            file_put_contents($file, $feed_content);
        }
    }

    public function getBlogItemsFromFeed()
    {
        $this->getLatestFeed();
        $xml = simplexml_load_file($this->feed_cache_file, "SimpleXMLElement", LIBXML_NOCDATA);
        $items = [];

        // Extract and save blog information from feed-xml file into array
        foreach ($xml->channel->item as $post) {
            $items[] = [
                "title" => $post->title,
                "pubDate" => substr($post->pubDate, 0, strrpos($post->pubDate, " ", -7)),
                "author" => $post->children("dc", true)->creator,
                "comments" => $post->children("slash", true)->comments,
                "commentsLink" => $post->comments,
                "shortDescription" => $post->description,
                "content" => $post->children("content", true)->encoded,
            ];
        }
        return $items;
    }
}
