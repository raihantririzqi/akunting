@push('title')
    Akun
@endpush
<div class="container">
    {{-- data akun --}}
    <div class="panel-body">
        <div class="d-flex justify-content-end p-3 ">
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
                        <option value="nama_akun">Nama Akun</option>
                        <option value="kode_akun">Kode Akun</option>
                        <option value="created_at">Created At</option>
                    </select>
                </div>
            </div>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Kode Akun</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Kode Akun</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $datas)
                    <tr wire:key="{{ $datas->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $datas->nama_akun }}</td>
                        <td>{{ $datas->kode_akun }}</td>
                        <td>
                            <button type="button" class="btn btn-danger"
                                wire:click.prevent="destroy({{ $datas->id }})">
                                Delete
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit" wire:click.prevent="show({{ $datas->id }})">
                                Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
    {{-- end data akun --}}

    {{-- Modal Tambah --}}
    <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="ModalTambah" aria-hidden="true">
        <form wire:submit.prevent="store" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success mb-2">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nama_akun" class="form-label">Nama Akun</label>
                                <input type="text" id="nama_akun" name="nama_akun" wire:model.lazy="nama_akun"
                                    placeholder="Nama Akun" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="kode_akun" class="form-label">Kode Akun</label>
                                <input type="text" id="kode_akun" name="kode_akun" wire:model.lazy="kode_akun"
                                    placeholder="Kode Akun" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End Modal Tambah --}}

    {{-- Modal Edit --}}
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="ModalEdit"
        aria-hidden="true">
        <form wire:submit.prevent="update({{ $id_akun }})" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success mb-2">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nama_akun_edit" class="form-label">Nama Akun</label>
                                <input type="text" id="nama_akun_edit" name="nama_akun"
                                    wire:model.lazy="nama_akun" placeholder="Nama Akun" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="kode_akun_edit" class="form-label">Kode Akun</label>
                                <input type="text" id="kode_akun_edit" name="kode_akun"
                                    wire:model.lazy="kode_akun" placeholder="Kode Akun" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End Modal Edit --}}

</div>
