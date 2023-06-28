<?php

namespace App\Service;

use App\Repository\BrandRepository;

class BrandService
{
    private BrandRepository $brandRepository;
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getBrands(): array
    {
        return $this->brandRepository->findAll();
    }
}