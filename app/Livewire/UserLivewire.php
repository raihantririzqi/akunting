<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class UserLivewire extends Component
{
    #[Layout('template')]
    public function render()
    {
        return view('livewire.user-livewire');
    }
}
