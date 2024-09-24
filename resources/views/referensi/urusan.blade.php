@extends('layouts.app')

@section('content')
<style>
    .content-body .container {
        margin: 0;
        max-width: 100%!important;
        height: 99%;
    }
    .content-body {
        padding: 3px!important;
    }
    .modal-dialog {
        max-width: 80%;
    }
    .modal-content {
        border-radius: 0.3rem;
    }
    .form-group {
        margin-bottom: 0.5rem!important;
    }
    .form-control {
        font-size: 1em!important;
    }
</style>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Urusan</h1>
<p class="mb-4">Daftar Urusan PT Perkebunan Nusantara I</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-fw fa-plus"></i> Tambah Data
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nomenklatur</th>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Tanggal Aktif</th>
                        <th style="text-align:center">Bagian</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody style='font-size: 0.85em;'>
                    @foreach($urusanData as $urusan)
                    <tr>
                        <td>{{ $urusan->Nomenklatur }}</td>
                        <td>{{ $urusan->Nama }}</td>
                        <td>{{ $urusan->TanggalAktif }}</td>
                        <td>
                            @foreach($bagianData as $bagian)
                                @if($bagian->BagianId == $urusan->BagianId)
                                    {{ $bagian->Nama }}
                                @endif
                            @endforeach
                        </td>
                        <td style="text-align:center">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{ $urusan->UrusanId }}" data-nomenklatur="{{ $urusan->Nomenklatur }}" data-nama="{{ $urusan->Nama }}" data-tanggal_aktif="{{ $urusan->TanggalAktif }}" data-bagian_id="{{ $urusan->BagianId }}">
                                <i class="fas fa-fw fa-edit"></i> Edit
                            </button>
                            <a href="{{ route('urusan.destroy', $urusan->UrusanId) }}" class="btn btn-danger btn-sm deletedata">
                                <i class="fas fa-fw fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Urusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @csrf
                    <div class="form-group">
                        <label for="nomenklatur">Nomenklatur</label>
                        <input type="text" class="form-control" id="nomenklatur" name="nomenklatur" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_aktif">Tanggal Aktif</label>
                        <input type="date" class="form-control" id="tanggal_aktif" name="tanggal_aktif" required>
                    </div>
                    <div class="form-group">
                        <label for="bagian_id">Bagian</label>
                        <select class="form-control" id="bagian_id" name="bagian_id" required>
                            @foreach($bagianData as $bagian)
                                <option value="{{ $bagian->BagianId }}">{{ $bagian->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveAddData">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Urusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_urusan_id" name="UrusanId">
                    <div class="form-group">
                        <label for="edit_nomenklatur">Nomenklatur</label>
                        <input type="text" class="form-control" id="edit_nomenklatur" name="nomenklatur" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_aktif">Tanggal Aktif</label>
                        <input type="date" class="form-control" id="edit_tanggal_aktif" name="tanggal_aktif" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bagian_id">Bagian</label>
                        <select class="form-control" id="edit_bagian_id" name="bagian_id" required>
                            @foreach($bagianData as $bagian)
                                <option value="{{ $bagian->BagianId }}">{{ $bagian->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditData">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle modal display and AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handle add data
        $('#saveAddData').on('click', function() {
            $.ajax({
                url: '{{ route('urusan.store') }}',
                type: 'POST',
                data: $('#addForm').serialize(),
                success: function(response) {
                    Swal.fire('Success!', 'Data berhasil ditambahkan.', 'success');
                    $('#addModal').modal('hide');
                    location.reload(); // Reload halaman setelah data ditambahkan
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal menambahkan data: ' + xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle edit data
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nomenklatur = button.data('nomenklatur');
            var nama = button.data('nama');
            var tanggal_aktif = button.data('tanggal_aktif');
            var bagian_id = button.data('bagian_id');

            var modal = $(this);
            modal.find('#edit_urusan_id').val(id);
            modal.find('#edit_nomenklatur').val(nomenklatur);
            modal.find('#edit_nama').val(nama);
            modal.find('#edit_tanggal_aktif').val(tanggal_aktif);
            modal.find('#edit_bagian_id').val(bagian_id);
        });

        $('#saveEditData').on('click', function() {
            var id = $('#edit_urusan_id').val();
            $.ajax({
                url: '{{ route('urusan.update', '') }}/' + id,
                type: 'POST',
                data: $('#editForm').serialize(),
                success: function(response) {
                    Swal.fire('Success!', 'Data berhasil diperbarui.', 'success');
                    $('#editModal').modal('hide');
                    location.reload(); // Reload halaman setelah data diperbarui
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal memperbarui data: ' + xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle delete data
        $('.deletedata').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
