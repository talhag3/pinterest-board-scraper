<?php
require_once __DIR__ . '/vendor/autoload.php';

use TalhaG3\PinterestScraper\PinterestScraper;

$scraper = new PinterestScraper();

// Provide the Pinterest board URL
$url = 'https://www.pinterest.com/stevenbithell/my-style/';

$result = $scraper->scrapePage($url);

function createImageGrid($imageArray) {
    echo '<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px;">';

    foreach ($imageArray as $imageUrl) {
        echo '<img src="' . $imageUrl . '" alt="Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">';
    }

    echo '</div>';
}

createImageGrid($result['images']);