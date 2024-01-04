<?php

namespace TalhaG3\PinterestScraper;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PinterestScraper
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
    }

    public function scrapePage($url)
    {
        try {
            $response = $this->httpClient->get($url);
            $html = $response->getBody()->getContents();

            // Extract the JSON data from the script tag
            preg_match('/<script id="__PWS_DATA__" type="application\/json">(.*?)<\/script>/s', $html, $matches);
            $jsonData = $matches[1];

            // Decode the JSON string
            $data = json_decode($jsonData, true);
            
            // Access the 'pins' property from the decoded JSON object
            $pins = $data['props']['initialReduxState']['pins'];
            
            // Extract the images and board info from the pins
            // $board = $data['props']['initialReduxState']['resourceResponses']['BoardResource']['data'];
            $boardInfo = [
                'name' => "Board Name",
                'description' => "Board Description",
                // Add more board information as needed
            ];

            $images = [];
            foreach ($pins as $pin) {
                $pinImages = $pin['images'];
                foreach ($pinImages as $size => $imageData) {
                    $imageUrl = $imageData['url'];
                    $images[] = $imageUrl;
                }
            }

            return [
                'boardInfo' => $boardInfo,
                'images' => $images,
            ];
        } catch (Exception $e) {
            return [];
        }
    }
}
