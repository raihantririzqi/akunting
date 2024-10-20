<?php

namespace App\Livewire;

use App\Models\Akun;
use App\Models\Operasional;
use Livewire\Attributes\Layout;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class OperasionalLivewire extends Component
{
    public $id, $tanggal, $id_akun, $tujuan, $jumlah, $tipe, $kas_masuk, $kas_keluar, $saldo, $saldo_terakhir;
    public $cek_limit, $cek_urutan, $cek_order_by;

    public function mount()
    {
        $this->cek_limit = 10;
        $this->cek_urutan = 'ASC';
        $this->cek_order_by = 'operasional.created_at';
    }
    #[Layout('template')]
    public function render()
    {
        $akun = Akun::all();
        $data = Operasional::select('operasional.id', 'akun.id', 'akun.nama_akun', 'operasional.tujuan', 'operasional.tanggal', 'operasional.jumlah', 'operasional.tipe', 'operasional.kas_masuk', 'operasional.kas_keluar', 'operasional.saldo')
            ->join('akun', 'operasional.id_akun', '=', 'akun.id')
            ->orderBY($this->cek_order_by, $this->cek_urutan)
            ->offset($this->cek_limit)
            ->limit($this->cek_limit)
            ->paginate($this->cek_limit);
        $get_saldo = Operasional::select('saldo')->orderBY('tanggal', 'DESC')->first();
        if ($get_saldo) {
            $this->saldo_terakhir = $get_saldo['saldo'];
        } else {
            $this->saldo_terakhir = 0;
        }
        return view('livewire.operasional-livewire', [
            'data' => $data,
            'akun' => $akun,
        ]);
    }

    public function store()
    {
        if ($this->tipe == 'debit') {
            $total_kas = $this->jumlah * $this->saldo;
            $total_saldo = $this->saldo_terakhir - $total_kas;

            $date = date('Y-m-d');

            $data = [
                'tanggal' => $date,
                'id_akun' => $this->id_akun,
                'tujuan' => $this->tujuan,
                'jumlah' => $this->jumlah,
                'tipe' => $this->tipe,
                'kas_keluar' => $total_kas,
                'saldo' => $total_saldo,
            ];

            Operasional::create($data);
            session()->flash('message', 'Berhasil Menyimpan Data');
            $this->ClearForm();
            $this->saldo_terakhir = $total_saldo;
        } else {
            $total_kas = $this->jumlah * $this->saldo;
            $total_saldo = $this->saldo_terakhir + $total_kas;

            $date = date('Y-m-d');

            $data = [
                'tanggal' => $date,
                'id_akun' => $this->id_akun,
                'tujuan' => $this->tujuan,
                'jumlah' => $this->jumlah,
                'tipe' => $this->tipe,
                'kas_masuk' => $total_kas,
                'saldo' => $total_saldo,
            ];

            Operasional::create($data);
            session()->flash('message', 'Berhasil Menyimpan Data');
            $this->ClearForm();
            $this->saldo_terakhir = $total_saldo;
        }
    }

    public function ClearForm()
    {
        $this->id_akun = null;
        $this->tujuan = null;
        $this->jumlah = null;
        $this->tipe = null;
        $this->saldo = null;
    }
}
