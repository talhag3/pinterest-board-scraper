<?php

namespace TalhaG3\PinterestScraper\Tests;

use PHPUnit\Framework\TestCase;
use TalhaG3\PinterestScraper\PinterestScraper;

class PinterestScraperTest extends TestCase
{
    public function testScrapePage()
    {
        $scraper = new PinterestScraper();

        // Provide the Pinterest board URL
        $url = 'https://www.pinterest.com/stevenbithell/my-style/';

        $result = $scraper->scrapePage($url);

        // Check if the board info and images are retrieved successfully
        $this->assertArrayHasKey('boardInfo', $result);
        $this->assertArrayHasKey('images', $result);
        $this->assertNotEmpty($result['boardInfo']);
        $this->assertNotEmpty($result['images']);
    }
}
