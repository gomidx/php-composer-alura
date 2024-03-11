<?php

require 'vendor/autoload.php';

use Alura\CoursesFinder\Finder;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


try {
    $client = new Client(['base_uri' => 'https://www.alura.com.br']);

    $crawler = new Crawler();

    $finder = new Finder($client, $crawler);

    $courses = $finder->find('/cursos-online-programacao/php');

    if ($courses === []) {
        echo 'Não existem cursos disponíveis!';

        return;
    }

    foreach ($courses as $course) {
        showMessage($course);
    }
} catch (Exception $ex) {
    showMessage($ex->getMessage());
}
