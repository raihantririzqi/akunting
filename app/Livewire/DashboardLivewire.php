<?php

namespace App\Livewire;

use App\Models\Operasional;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardLivewire extends Component
{
    #[Layout('template')]
    public function render()
    {
        $totalKas = Operasional::selectRaw('SUM(kas_masuk) as kas_masuk, SUM(kas_keluar) as kas_keluar')->first();
        $saldoTerakhir = Operasional::orderBy('id', 'desc')->limit(1)->first();

        $saldoAkhirValue = $saldoTerakhir ? strval($saldoTerakhir->saldo) : '0';

        $data = [
            'total_kas' => $totalKas,
            'saldo_akhir' => $saldoAkhirValue
        ];
        return view('livewire.dashboard-livewire', $data);
    }
}
