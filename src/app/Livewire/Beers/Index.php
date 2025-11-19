<?php

namespace App\Livewire\Beers;

use App\Models\Beer;
use App\Services\BeerService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    protected BeerService $beerService;
    public string $sortBy = "";
    public string $sortDirection = "";
    public array $filters = [];

    public function boot(BeerService $beerService)
    {
        $this->beerService = $beerService;
    }
    /**
     * Prepara os dados para a Ordenação da Lista de cervejas
     *
     * @param  mixed $sortBy
     * @return void
     */
    public function sort($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = !empty($this->sortDirection)
            && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->resetPage();
    }

    /**
     * Prepara os filtros à serem aplicados
     *
     * @return void
     */
    public function filter(){
        $this->validateForFilter();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.beers.index', [
            'beers' => $this->beerService->getBeers($this->sortBy, $this->sortDirection,$this->filters)
        ]);
    }

    /**
     * Auxilia na validação dos dados de filtro
     *
     * @return void
     */
    private function validateForFilter(){
        return $this->validate([
            'filters.name'=> 'nullable|string|min:3|max:255',
            'filters.prop_filter'=> 'nullable',
            'filters.prop_filter_rule'=> 'required_with:filters.prop_filter',
            'filters.prop_filter_value'=> 'required_with:filters.prop_filter_rule',

        ],[
            'filters.name.string' => 'O nome está em um formato inválido',
            'filters.name.min' => 'O nome deve ter no mínimo 3 caracteres.',
    'filters.name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'filters.prop_filter_rule.required_with' => 'Selecione alguma Regra!',
            'filters.prop_filter_value.required_with' => 'Selecione algum Valor!'
        ]);
    }
}
