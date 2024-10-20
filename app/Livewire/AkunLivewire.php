<?php

namespace App\Livewire;

use App\Models\Akun;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AkunLivewire extends Component
{
    public $cek_limit, $cek_urutan, $cek_order_by;
    public $id_akun, $nama_akun, $kode_akun;
    public function mount()
    {
        $this->cek_limit = 10;
        $this->cek_urutan = 'ASC';
        $this->cek_order_by = 'created_at';
    }
    #[Layout('template')]
    public function render()
    {
        $data = Akun::orderBY($this->cek_order_by, $this->cek_urutan)
            ->offset($this->cek_limit)
            ->limit($this->cek_limit)
            ->paginate($this->cek_limit);
        return view('livewire.akun-livewire', [
            'data' => $data,
        ]);
    }

    public function store()
    {
        $data = [
            'nama_akun' => $this->nama_akun,
            'kode_akun' => $this->kode_akun,
        ];

        Akun::create($data);

        session()->flash('message', 'Berhasil Menyimpan Data');
        $this->ClearForm();
    }

    public function show($id)
    {
        $data = Akun::find($id);
        $this->nama_akun = $data->nama_akun;
        $this->kode_akun = $data->kode_akun;
        $this->id_akun = $data->id;
    }

    public function update($id){
        $data = [
            'nama_akun' => $this->nama_akun,
            'kode_akun' => $this->kode_akun,
        ];

        Akun::find($id)->update($data);

        session()->flash('message', 'Berhasil Mengedit Data');
        $this->ClearForm();
    }

    public function destroy($id)
    {
        Akun::find($id)->delete();
    }

    public function ClearForm()
    {
        $this->nama_akun = null;
        $this->kode_akun = null;
    }
}
