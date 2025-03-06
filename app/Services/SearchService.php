<?php

namespace App\Services;

use App\DTO\SearchForm;
use App\Enums\ApartmentRangeFilter;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    const PER_PAGE = 10;
    public function getMaxPrice()
    {
        return (int) ceil((Apartment::orderBy('price', 'desc')->first()->price / 1000)/100)*100;
    }
    public function getRange(string $name): array
    {
        $min = Cache::get('apartment_min' . $name, Apartment::orderBy($name)->first()->{$name});
        $max = Cache::get('apartment_max' . $name, Apartment::orderBy($name, 'desc')->first()->{$name});

        return range($min, $max);
    }

    public function search(SearchForm $form): LengthAwarePaginator
    {
        $query = Apartment::query();

        foreach (ApartmentRangeFilter::toArray() as $name) {
            if (property_exists($form, $name)) {
                $query->when($form->$name, fn(Builder $query) => $query->where($name, $form->$name));
            }
        }

        if ($form->priceFrom && $form->priceTo) {
            $query->whereBetween('price', [$form->priceFrom, $form->priceTo]);
        } elseif ($form->priceFrom) {
            $query->where('price', '>=', $form->priceFrom);
        } elseif ($form->priceTo) {
            $query->where('price', '<=', $form->priceTo);
        }

        if ($form->name) {
            $query->where('name', 'like', '%' . $form->name . '%');
        }

        return $query->paginate(self::PER_PAGE);
    }
}
