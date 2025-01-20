<?php

namespace App\Jobs;

use Goutte\Client;
use App\Models\Bottle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class StartScrapingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600;

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
            // Check if scraping was stopped
            if (!Cache::get('scraping_in_progress')) {
                return;
            }
    
            $nextUrl = $this->scrapeSAQWines($nextUrl, $client);
        }
    
        // Clear the scraping flag after completion
        Cache::forget('scraping_in_progress');
    }

    private function scrapeSAQWines($url, $client)
    {
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
                'designation_of_origin' => $detailedData['designation_of_origin'] ?? 'N/A',
                'regulated_designation' => $detailedData['regulated_designation'] ?? 'N/A',
                'classification' => $detailedData['classification'] ?? 'N/A',
                'grape_variety' => $detailedData['grape_variety'] ?? 'N/A',
                'sugar_content' => $detailedData['sugar_content'] ?? 'N/A',
                'particularity' => $detailedData['particularity'] ?? 'N/A',
                'producer' => $detailedData['producer'] ?? 'N/A',
                'promoting_agent' => $detailedData['promoting_agent'] ?? 'N/A',
            ]);
        });

        try {
            $nextPage = $crawler->filter('a.action.next')->attr('href');
            return $nextPage ?: null;
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * Extract data by "data-th" attribute from the crawler.
     * @param string $field The label to search for (e.g., 'Pays', 'Région').
     * @return string The extracted text or 'N/A' if not found.
     */

     private function extractData($crawler, $field) {
        //selector to find data-th attribute
        $selector = 'ul.list-attributs li strong[data-th="' . $field . '"]';

        $element = $crawler->filter($selector);
        
         // Check if the element exists and return the text
         if ($element->count() > 0){
            return trim($element->text());
         } else {
            return 'N/A';
         }
     }


    /**
     * Scrape detailed information for a specific wine bottle from its SAQ page.
     */
    private function scrapeBouteilleDetails($url, $client) {
            $crawler = $client->request('GET', $url);

            // Extract details using the helper function
            $saqCode = $this->extractData($crawler, 'Code SAQ');
            $country = $this->extractData($crawler, 'Pays');
            $region = $this->extractData($crawler, 'Région');
            $designationOfOrigin = $this->extractData($crawler, "Appellation d'origine");
            $classification = $this->extractData($crawler, 'Classification');
            $grapeVariety = $this->extractData($crawler, 'Cépage');
            $degreeAlcohol = $this->extractData($crawler, "Degré d'alcool");
            $sugarContent = $this->extractData($crawler, 'Taux de sucre');
            $color = $this->extractData($crawler, 'Couleur');
            $particularity = $this->extractData($crawler, 'Particularité');
            $size = $this->extractData($crawler, 'Format');
            $producer = $this->extractData($crawler, 'Producteur');
            $promotingAgent = $this->extractData($crawler, 'Agent promotionnel');

            return [
                'saq_code' => $saqCode,
                'country' => $country,
                'region' => $region,
                'designation_of_origin' => $designationOfOrigin,
                'classification' => $classification,
                'grape_variety' => $grapeVariety,
                'degree_alcohol' => $degreeAlcohol,
                'sugar_content' => $sugarContent,
                'color' => $color,
                'particularity' => $particularity,
                'size' => $size,
                'producer' => $producer,
                'promoting_agent' => $promotingAgent,
            ];
        }


        public function failed(\Throwable $exception)
        {
            // Ensure the scraping flag is cleared even if the job fails
            Cache::forget('scraping_in_progress');
        }

}
