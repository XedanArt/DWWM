<?php

// src/Kernel.php
namespace App;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(): void
    {
        parent::boot();

        // Définit le fuseau horaire pour toutes les fonctions date/time
        date_default_timezone_set($this->getContainer()->getParameter('timezone'));
    }
}