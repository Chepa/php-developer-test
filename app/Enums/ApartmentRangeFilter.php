<?php

namespace App\Enums;

enum ApartmentRangeFilter: string
{
    use EnumsToArray;

    case BEDROOMS = 'bedrooms';
    case BATHROOMS = 'bathrooms';
    case STOREYS = 'storeys';
    case GARAGES = 'garages';
}
