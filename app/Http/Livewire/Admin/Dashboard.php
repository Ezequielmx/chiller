<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Ordene;

class Dashboard extends Component
{
    public $periodo;
    public $ordenes;

    public function mount()
    {
        $this->periodo = 'hoy';
    }

    public function render()
    {
        $startDate = null;

        if ($this->periodo === 'hoy') {
            $startDate = now()->startOfDay();
        } elseif ($this->periodo === 'ultima_semana') {
            $startDate = now()->subWeek()->startOfDay();
        } elseif ($this->periodo === 'ultimo_mes') {
            $startDate = now()->subMonth()->startOfDay();
        } elseif ($this->periodo === 'ultimo_anio') {
            $startDate = now()->subYear()->startOfDay();
        }

        $this->ordenes = Ordene::where('fecha', '>=', $startDate->toDateTimeString())->get();

        return view('livewire.admin.dashboard');
    }
}
