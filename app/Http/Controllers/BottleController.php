<?php

namespace App\Http\Controllers;

use App\Models\Cellar;
use App\Models\CellarBottle;
use App\Models\Bottle;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Jobs\StartScrapingJob;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Cache;

class BottleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Retrieve filter values
    $colors = Bottle::select('color')->distinct()->pluck('color');
    $countries = Bottle::select('country')->distinct()->pluck('country');

    // Check if the query or filters exist
    $query = $request->input('search');
    $filter = $request->input('order');
    $color = $request->input('color');
    $country = $request->input('country');

    // Base query
    $bottlesQuery = Bottle::query();

    // Apply filters if they exist
    if ($query) {
        $bottlesQuery->where('title', 'LIKE', '%' . $query . '%');
    }

    if ($color) {
        $bottlesQuery->where('color', $color);
    }

    if ($country) {
        $bottlesQuery->where('country', $country);
    }

    if ($filter) { $order = $filter; }
    else {
        $order = 'title';
    }
    // Get filtered results
    $bottles = $bottlesQuery->orderby($order)->paginate(5);
    // Pass data to the view
    return view('bottle.index', compact('bottles', 'query', 'colors', 'countries', 'color', 'country'));
}


    public function details($id)
    {
        // Retrieve the specific bottle
        $bottle = Bottle::findOrFail($id);
        $celliers = Cellar::all();
        // Pass the bottles to the view
        return view('bottle.details', ['bottle'=>$bottle,'celliers'=>$celliers]);
    
    }
    

    /**
     * Lance le scraping des bouteilles depuis le site de la SAQ en parcourant plusieurs pages.
     */
    public function scrape()
    {
        set_time_limit(0);
        // Set the "scraping" flag to true
        Cache::put('scraping', true, 60);
        $client = new Client();
        $nextUrl = "https://www.saq.com/fr/produits/vin";
        while ($nextUrl && Cache::get('scraping')) {
            $nextUrl = $this->scrapeSAQWines($nextUrl, $client);
        }
        // Reset the "scraping" flag
        Cache::forget('scraping');
        if (!Cache::get('scraping')) {
            //
            return response()->json(['success' => true, 'message' => 'Extraction arrêtée par l\'utilisateur.']);
        }
        //
        return response()->json(['success' => true, 'message' => 'Extraction terminée avec succès !']);
    }


    public function stopScraping() {
        // Set the scraping flag to false
        Cache::put('scraping', false);
        //
        return response()->json(['success' => true, 'message' => 'Extraction arrêtée avec succès !']);
    }


    /**
     * Scrape les titres des bouteilles sur une page et gère la pagination.
     */
    private function scrapeSAQWines($url, $client)
    {
        $crawler = $client->request('GET', $url);
        $crawler->filter('li.product-item')->each(function ($node) use ($client) {
            // Extract the title
            $titleNode = $node->filter('a.product-item-link');
            $title = $titleNode->count() ? trim($titleNode->text()) : 'N/A';
            // Extract the price
            $priceNode = $node->filter('.price-box .price');
            $price = $priceNode->count() ? trim($priceNode->text()) : 'N/A';
            // Extract the SAQ link (href attribute)
            $linkNode = $node->filter('a.product-item-photo');
            $saqLink = $linkNode->count() ? $linkNode->attr('href') : 'N/A';
            // Extract the image source URL
            $imageNode = $node->filter('.product-image-photo');
            $imageSrc = $imageNode->count() ? $imageNode->attr('src') : 'N/A';
            echo "Détails de l'extraction pour : $title | $saqLink\n";
    
            // Visit the detailed page to extract the SAQ code
            $detailedData = $this->scrapeBouteilleDetails($saqLink, $client);
    
            // Insert the data into the database
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
        // Handle pagination
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
    private function extractData($crawler, $field) 
    {
        // Selector to find data-th attribute
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

    /**
     * Comptage des bouteilles en temps réel
     */
    public function getTotalBottles()
    {
        $totalBottles = Bottle::count();
        // Return the total bottle count as JSON
        return response()->json(['totalBottles' => Bottle::count()]);
    }



    public function destroy() {
        $delete = Bottle::truncate();

        return view('welcome');
    }
}

