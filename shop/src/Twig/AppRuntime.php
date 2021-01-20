<?php
namespace App\Twig;

use Twig\Extension\RuntimeExtensionInterface;
use App\Service\DeviseService;

class AppRuntime implements RuntimeExtensionInterface
{

    private $devise;

    public function __construct(DeviseService $devise)
    {
        $this->devise = $devise;
    }

    public function convertedPrice($number)
    {
        return $this->devise->transformToCurrentDevise($number);
    }

    public function getDevise(){
        return $this->devise->getDevise();
    }

    public function getAvailableDevises(){
        return $this->devise->getAvailableDevises();
    }
}