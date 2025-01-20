<?php

namespace App\Jobs;

use Goutte\Client;
use App\Models\Bottle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartScrapingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        set_time_limit(0);
        
        $client = new Client();
        $nextUrl = "https://www.saq.com/fr/produits/vin";

        while ($nextUrl) {
            $nextUrl = $this->scrapeSAQWines($nextUrl, $client);
        }
    }

    private function scrapeSAQWines($url, $client) {
        $crawler = $client->request('GET', $url);

        $crawler->filter('li.product-item')->each(function ($node) use ($client) {
            $title = $node->filter('a.product-item-link')->count()
                ? trim($node->filter('a.product-item-link')->text())
                : 'N/A';

            $price = $node->filter('.price-box .price')->count()
                ? trim($node->filter('.price-box .price')->text())
                : 'N/A';

            $saqLink = $node->filter('a.product-item-photo')->count()
                ? $node->filter('a.product-item-photo')->attr('href')
                : 'N/A';

            $imageSrc = $node->filter('.product-image-photo')->count()
                ? $node->filter('.product-image-photo')->attr('src')
                : 'N/A';

            $detailedData = $this->scrapeBouteilleDetails($saqLink, $client);

            Bottle::create([
                'title' => $title,
                'price' => $price,
                'saq_link' => $saqLink,
                'image_src' => $imageSrc,
                'saq_code' => $detailedData['saq_code'] ?? 'N/A',
                'country' => $detailedData['country'] ?? 'N/A',
                'region' => $detailedData['region'] ?? 'N/A',
                'degree_alcohol' => $detailedData['degree_alcohol'] ?? 'N/A',
                'color' => $detailedData['color'] ?? 'N/A',
                'size' => $detailedData['size'] ?? 'N/A',
            ]);
        });

        try {
            $nextPage = $crawler->filter('a.action.next')->attr('href');
            return $nextPage ?: null;
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }

    private function scrapeBouteilleDetails($url, $client) {
        $crawler = $client->request('GET', $url);

        return [
            'saq_code' => $crawler->filter('ul.list-attributs li strong[data-th="Code SAQ"]')->text() ?? 'N/A',
            'country' => $crawler->filter('ul.list-attributs li strong[data-th="Pays"]')->text() ?? 'N/A',
            'region' => $crawler->filter('ul.list-attributs li strong[data-th="Région"]')->text() ?? 'N/A',
        ];
    }
}
