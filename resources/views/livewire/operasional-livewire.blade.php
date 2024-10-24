@push('title')
    Operasional
@endpush
<div>
    {{-- Data Operasional --}}
    <div class="container">
        <div class="d-flex justify-content-end p-3">
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
            </div>
        </div>
        <table class="table table-hover table-striped w-full">
            <div class="row mb-2">
                <div class="col-md-2 col-lg-2">
                    <label class="form-control-label">Data</label>
                    <select class="form-control" wire:model.live="cek_limit" required>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                        <option>250</option>
                        <option>500</option>
                    </select>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label class="form-control-label">Order</label>
                    <select class="form-control" wire:model.live="cek_urutan" required>
                        <option value="ASC">A-Z</option>
                        <option value="DESC">Z-A</option>
                    </select>
                </div>
                <div class="col-md-2 col-lg-2">
                    <label class="form-control-label">BY</label>
                    <select class="form-control" wire:model.live="cek_order_by" required>
                        <option value="tujuan">Tujuan</option>
                        <option value="tanggal">Tanggal</option>
                        <option value="jumlah">Jumlah</option>
                        <option value="acc_operasional.created_at">Created At</option>
                    </select>
                </div>
            </div>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Kas Masuk</th>
                    <th>Kas Keluar</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Kas Masuk</th>
                    <th>Kas Keluar</th>
                    <th>Saldo</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $datas)
                    <tr wire:key="{{ $datas->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $datas->nama_akun }}</td>
                        <td>{{ $datas->tujuan }}</td>
                        <td>{{ $datas->tanggal }}</td>
                        <td>{{ $datas->jumlah }}</td>
                        <td>{{ $datas->tipe }}</td>
                        <td>Rp. {{ number_format($datas->kas_masuk, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($datas->kas_keluar, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($datas->saldo, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    {{-- End Data Operasional --}}

    {{-- Modal Tambah --}}
    <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="ModalTambah" aria-hidden="true">
        <form wire:submit="store" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleFormModalLabel">Form Operasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success mb-2">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Nama Akun</label>
                                <select class="form-control" wire:model.live="id_akun" required>
                                    <option value="">Pilih Akun</option>
                                    @foreach ($akun as $akuns)
                                        <option value="{{ $akuns->id }}">{{ $akuns->nama_akun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Tujuan</label>
                                <input type="text" name="tujuan" wire:model.live="tujuan" placeholder="Tujuan"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-6">
                                <label class="form-control-label">Jumlah</label>
                                <input type="number" name="jumlah" wire:model.live="jumlah" placeholder="Jumlah"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-6">
                                <label class="form-control-label">Tipe</label>
                                <select class="form-control" wire:model.live="tipe" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="kredit">Kredit</option>
                                    <option value="debit">Debit</option>
                                </select>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Saldo</label>
                                <input type="number" name="saldo" wire:model.live="saldo" placeholder="Saldo"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex" style="width: 100%">
                                <div class="col-md-6">
                                    <button wire:loading.attr="disabled" type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" wire:click="ClearForm" data-bs-dismiss="modal" aria-label="Close"
                                        class="btn btn-secondary btn-block">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End Modal Tambah --}}
</div>
