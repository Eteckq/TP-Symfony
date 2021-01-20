<?php
namespace App\Twig;

use App\Twig\AppRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            // the logic of this filter is now implemented in a different class
            new TwigFilter('currency_convert', [AppRuntime::class, 'convertedPrice']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('devise', [AppRuntime::class, 'getDevise']),
            new TwigFunction('availableDevises', [AppRuntime::class, 'getAvailableDevises']),
        ];
    }
}