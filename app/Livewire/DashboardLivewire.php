<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DashboardLivewire extends Component
{
    #[Layout('template')]
    public function render()
    {
        return view('livewire.dashboard-livewire');
    }
}
