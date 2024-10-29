<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserLivewire extends Component
{
    public $cek_limit, $cek_urutan, $cek_order_by;
    public $name, $email, $password, $role, $userId;

    public function mount()
    {
        $this->cek_limit = 10;
        $this->cek_urutan = 'ASC';
        $this->cek_order_by = 'users.created_at';
    }

    #[Layout('template')]
    public function render()
    {
        $data = User::select("users.id", "users.name", "users.email", "users.role")
                    ->orderBY($this->cek_order_by, $this->cek_urutan)
                    ->offset($this->cek_limit)
                    ->limit($this->cek_limit)
                    ->paginate($this->cek_limit);

        return view('livewire.user-livewire', ['data' => $data]);
    }

    public function tambah()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);


        $this->reset(['name', 'email', 'password', 'role']);

        session()->flash('message', 'User added successfully.');
    }

    public function ClearForm()
    {
        $this->reset(['name', 'email', 'password', 'role']);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function show($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|string|max:255',
        ]);

        // Update pengguna
        $user = User::find($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;

        // Update password jika diisi
        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        $user->save();

        // Reset input
        $this->reset(['name', 'email', 'password', 'role', 'userId']);

        session()->flash('message', 'User updated successfully.');
    }
}
