<?php

namespace App\Http\Controllers;

use App\DTO\SearchForm;
use App\Http\Requests\SearchRequest;
use App\Http\Resourses\SearchResultCollection;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function __construct(private readonly SearchService $filterService)
    {
    }

    public function __invoke(SearchRequest $request)
    {
        $results = $this->filterService->search(SearchForm::fromArray($request->validated()));

        return response()->json(
            [
                'data' => new SearchResultCollection($results),
                'pagination' => [
                    'page' => $results->currentPage(),
                    'perPage' => SearchService::PER_PAGE,
                    'total' => $results->total(),
                ]
            ]
        );
    }
}
