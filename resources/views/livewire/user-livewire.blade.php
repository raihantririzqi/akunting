<div>
    {{-- Data User --}}
    <div class="container">
        <div class="d-flex justify-content-end p-3">
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
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
                        <option value="name">Name</option>
                        <option value="email">Email</option>
                        <option value="role">Role</option>
                        <option value="acc_operasional.created_at">Created At</option>
                    </select>
                </div>
            </div>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($data as $datas)
                    <tr wire:key="{{ $datas->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $datas->name }}</td>
                        <td>{{ $datas->email }}</td>
                        <td>{{ $datas->role }}</td>
                        <td>
                            @if (Auth::user()->id != $datas->id)
                            <button type="button" class="btn btn-danger"
                                wire:click.prevent="destroy({{ $datas->id }})">
                                Delete
                            </button>
                            @endif

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
    {{-- End Data User --}}
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="ModalTambah"
        aria-hidden="true">
        <form wire:submit.prevent="tambah " enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleFormModalLabel">Form Tambah Pengguna</h5>
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
                                <label class="form-control-label">Nama</label>
                                <input type="text" name="name" wire:model="name" placeholder="Nama"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" wire:model="email" placeholder="Email"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Password</label>
                                <input type="password" name="password" wire:model="password" placeholder="Password"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Role</label>
                                <select class="form-control" wire:model="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="karyawan">Karyawan</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex" style="width: 100%">
                                <div class="col-md-6">
                                    <button wire:loading.attr="disabled" type="submit"
                                        class="btn btn-primary btn-block">Save</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" wire:click="ClearForm" data-bs-dismiss="modal"
                                        aria-label="Close" class="btn btn-secondary btn-block">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div wire:ignore.self class="modal fade" id="edit" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
        <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleFormModalLabel">Form Edit Pengguna</h5>
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
                                <label class="form-control-label">Nama</label>
                                <input type="text" name="name" wire:model="name" placeholder="Nama"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Email</label>
                                <input type="email" name="email" wire:model="email" placeholder="Email"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" wire:model="password" placeholder="Password"
                                    class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group form-material col-md-12">
                                <label class="form-control-label">Role</label>
                                <select class="form-control" wire:model="role" required>
                                    <option value="">Pilih Role</option>
                                    <option value="karyawan">Karyawan</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex" style="width: 100%">
                                <div class="col-md-6">
                                    <button wire:loading.attr="disabled" type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" wire:click="ClearForm" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-block">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
