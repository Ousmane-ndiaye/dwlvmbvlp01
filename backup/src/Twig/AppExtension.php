<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class AppExtension extends AbstractExtension
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entManager)
    {
        $this->entityManager = $entManager;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('format_string', [$this, 'formatString']),
            new TwigFilter('string_month', [$this, 'stringMonth']),
        ];
    }

    public function formatString($date, $format = "%e %B")
    {
        if ($date instanceof \DateTime) {
            $date = $date->getTimestamp();
        }

        return strftime($format, $date);
    }

    public function stringMonth($numMois)
    {
        $key = intval($numMois);
        $mois = [1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'];
        $stringMonth = '';
        if (array_key_exists($key, $mois)) {
            $stringMonth = $mois[$key];
        }

        return $stringMonth;
    }
}