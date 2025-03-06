<?php

namespace App\Http\Controllers;

use App\Enums\ApartmentRangeFilter;
use App\Services\SearchService;

class HomeController extends Controller
{
    public function __construct(private readonly SearchService $service)
    {
    }

    public function index()
    {
        $rangeFilters = [
            ApartmentRangeFilter::BATHROOMS->value => $this->service->getRange(ApartmentRangeFilter::BATHROOMS->value),
            ApartmentRangeFilter::BEDROOMS->value => $this->service->getRange(ApartmentRangeFilter::BEDROOMS->value),
            ApartmentRangeFilter::STOREYS->value => $this->service->getRange(ApartmentRangeFilter::STOREYS->value),
            ApartmentRangeFilter::GARAGES->value => $this->service->getRange(ApartmentRangeFilter::GARAGES->value),
        ];

        return view('app', [
            'data' => [
                'rangeFilters' => $rangeFilters,
                'maxPrice' => $this->service->getMaxPrice(),
            ]
        ]);
    }
}
