<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeviseService
{
    const API_ENDPOINT = "https://api.exchangeratesapi.io/latest";
    const SUPPORTED_DEVISES = ["USD", "GBP"];
    const DEVISE_SESSION = 'devise';

    private $rates = [
        "EUR" => 1,
    ];
    private $currentDevise = "EUR";
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->initDevises();
        $this->currentDevise = $session->get(self::DEVISE_SESSION, "EUR");
    }

    private function initDevises()
    {
        $client = HttpClient::create();

        $res = $client->request("GET", self::API_ENDPOINT)->toArray();

        foreach ($res["rates"] as $devise => $rate) {
            foreach (self::SUPPORTED_DEVISES as $supportedDevise) {
                if ($supportedDevise == $devise) {
                    $this->rates[$devise] = $rate;
                }
            }
        }
    }

    public function getAvailableDevises(){
        return $this->rates;
    }

    public function transformToCurrentDevise($baseAmount) {
        return $this->toDevise($baseAmount, $this->currentDevise);
    }

    public function getDevise() {
        return $this->currentDevise;
    }

    public function setUserDevise($devise) {
        $this->currentDevise = $devise;
        $this->session->set(self::DEVISE_SESSION, $this->currentDevise);
    }

    private function toDevise($baseAmount, $devise) {
        return $baseAmount * ( $this->rates[$devise] );
    }
}