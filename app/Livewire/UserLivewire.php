<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserLivewire extends Component
{
    public $cek_limit, $cek_urutan, $cek_order_by;
    public $name, $email, $password, $role;

    public function mount()
    {
        $this->cek_limit = 10;
        $this->cek_urutan = 'ASC';
        $this->cek_order_by = 'users.created_at';
    }

    #[Layout('template')]
    public function render()
    {
        $data = User::select("users.name", "users.email", "users.role")
                    ->orderBY($this->cek_order_by, $this->cek_urutan)
                    ->offset($this->cek_limit)
                    ->limit($this->cek_limit)
                    ->paginate($this->cek_limit);
        return view('livewire.user-livewire', ['data' => $data]);
    }

    public function tambah(){
        return dd($this->email);
    }
}
