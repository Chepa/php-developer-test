<?php

namespace App\DTO;

class SearchForm
{
    public function __construct(
        public string $name,
        public int $priceFrom,
        public int $priceTo,
        public int $bedrooms,
        public int $bathrooms,
        public int $storeys,
        public int $garages,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (string)($data['name'] ?? ''),
            (int)($data['price'][0]*1000 ?? 0),
            (int)($data['price'][1]*1000 ?? 0),
            (int)($data['bedrooms'] ?? 0),
            (int)($data['bathrooms'] ?? 0),
            (int)($data['storeys'] ?? 0),
            (int)($data['garages'] ?? 0),
        );
    }
}
