<?php

namespace Testa\Blog\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Image extends AbstractHelper
{
    public const BLOG_URL = "https://dev98.de/";

    public function getMainArticleImages()
    {
        libxml_use_internal_errors(true);
        // The main blog images must be fetch over the main blog page, because there are no images in the rss-feed.
        $doc = new \DOMDocument();

        $doc->loadHTMLFile(self::BLOG_URL);
        $article_collection = $doc->getElementsByTagName("article");

        $images = [];

        // Collect images in structured array to sync with output from class BlogProvider getBlogItemsFromFeed.

        foreach ($article_collection as $article) {
            $image = $article->getElementsByTagName("img");

            if($image->length == 0) {
                // In case a blog article doesn't have an image collect a dummy src.
                $images[] =  [
                    "src" => NULL,
                    "alt" => "dummy"
                ];
            } else {
                // Collect blog image src.
                $images[] = [
                    "src" => $image->item(0)->getAttribute("src"),
                    "alt" => $image->item(0)->getAttribute("data-image-title")
                ];
            }
        }
        return $images;
    }
}
