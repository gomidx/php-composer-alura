<?php

namespace Alura\CoursesFinder;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Finder
{
    private $client;
    private $crawler;

    public function __construct(ClientInterface $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function find(string $url): array
    {
        $response = $this->client->request('GET', $url);

        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);

        $coursesElements = $this->crawler->filter('span.card-curso__nome');

        $courses = [];

        foreach ($coursesElements as $courseElement) {
            $courses[] = $courseElement->textContent;
        }

        return $courses;
    }
}