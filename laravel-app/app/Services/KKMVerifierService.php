<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class KKMVerifierService
{
    protected $url = 'https://www.moh.gov.my/index.php/pages/view/4378?mid=1501';

    public function isGovernmentClinicVerified($clinicName)
    {
        $client = new Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]));

        $crawler = $client->request('GET', $this->url);

        $rows = $crawler->filter('table tr');

        $found = false;
        $clinicName = strtolower($clinicName);

        foreach ($rows as $row) {
            if (str_contains(strtolower($row->textContent), $clinicName)) {
                $found = true;
                break;
            }
        }

        return $found;
    }
}
