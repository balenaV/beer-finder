<?php

namespace App\Services;

use App\Models\Beer;
use Illuminate\Database\Eloquent\Builder;

class BeerService
{
    public function getBeers(string $sortBy, string $sortDirection, array $filters)
    {
        $query = Beer::query();

        $this->applyFiltersAndSorters($query, $filters, $sortBy, $sortDirection);


        return $query->paginate(15);
    }

    /**
     * Aplica filtros e ordenações a query
     *
     * @param  Builder $query
     * @param  array $filters
     * @param  string $sortBy
     * @param  string $sortDirection
     * @return Builder
     */
    private function applyFiltersAndSorters(Builder $query, array $filters, string $sortBy, string $sortDirection): Builder
    {
        if (isset($filters["name"])) {
            $query->where("name", "like", "%" . $filters["name"] . "%");
        }

        $validRules = ['>', '<', '>=', '<=', '=']; // Operadores permitidos

        if (
            isset($filters["prop_filter"], $filters["prop_filter_rule"], $filters["prop_filter_value"]) &&
            in_array($filters["prop_filter_rule"], $validRules) // Verifica se a regra é segura
        ) {
            $query->where(
                $filters["prop_filter"],
                $filters["prop_filter_rule"],
                $filters["prop_filter_value"]
            );
        }
        if ($sortBy && $sortDirection) {
            $query->orderBy($sortBy, $sortDirection);
        }

        return $query;
    }
}
