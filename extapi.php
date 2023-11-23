<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

function getConversionRate($currencies = 'EUR,CAD,USD,JPY,AED,PHP') {
    try {
        $client = new Client([
            'base_uri' => 'http://api.exchangeratesapi.io/v1/',
        ]);
  
        $response = $client->request('GET', 'latest', [
            'query' => [
                'access_key' => '556219c73a9dfa0ebaeab3e150c15170',
                'symbols' => $currencies
            ]
        ]);
         
        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $arr_body = json_decode($body, true);
            return $arr_body['rates'] ?? []; // Default to empty array if not available
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log the error
        return []; // Default conversion rate in case of an error
    }
}

// Sanitize input
$requestedCurrencies = isset($_GET['currencies']) ? htmlspecialchars($_GET['currencies']) : 'EUR,CAD,USD,JPY,AED,PHP';
echo json_encode(getConversionRate($requestedCurrencies));
?>