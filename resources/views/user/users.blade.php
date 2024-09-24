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
    .form-group {
        margin-bottom: 0.5rem!important;
    }
    .form-control {
        font-size: 1em!important;
    }
</style>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users Login</h1>
<p class="mb-4">Daftar Users Login PT Perkebunan Nusantara I</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-rounded add_user" data-toggle="modal" data-target="#addModal">
            <i class="fas fa-fw fa-plus"></i> Tambah Data
        </button>
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align:center">Nama</th>
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Username</th>
                        <th style="text-align:center">Region</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody style='font-size: 0.85em; text-align: center;'>
                    @foreach($dataalluser as $user)
                    <tr>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->region }}</td>
                        <td style="text-align:center">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal" data-nama="{{ $user->nama }}" data-email="{{ $user->email }}" data-username="{{ $user->username }}" data-region="{{ $user->region }}">
                                <i class="fas fa-fw fa-info-circle"></i> Detail
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" data-id="{{ $user->id }}" data-id_karyawan="{{ $user->id_karyawan }}" data-nama="{{ $user->nama }}" data-email="{{ $user->email }}" data-username="{{ $user->username }}" data-region="{{ $user->region }}" data-bagianid="{{ $user->bagianid }}">
                                <i class="fas fa-fw fa-edit"></i> Edit
                            </button>
                            <a href="{{ route('user.deleteUsers', $user->id) }}" class="btn btn-danger btn-sm deletedata">
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
                <h5 class="modal-title" id="addModalLabel">Tambah Data User Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm" action="{{ route('user.storeUsers') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_karyawan">ID Karyawan</label>
                        <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="region" name="region" required>
                    </div>
                    <div class="form-group">
                        <label for="bagianid">Bagian</label>
                        <select class="form-control" id="bagianid" name="bagianid" required>
                            <option value="">Pilih Bagian</option>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->BagianId }}">{{ $bagian->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subbagianid">Role</label>
                        <select class="form-control" id="subbagianid" name="subbagianid" required>
                            <option value="">Pilih Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->roleid }}">{{ $role->namarole }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveAddData">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data User Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('user.updateUsers') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_user_id" name="id">
                    <div class="form-group">
                        <label for="edit_id_karyawan">ID Karyawan</label>
                        <input type="text" class="form-control" id="edit_id_karyawan" name="id_karyawan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_region">Region</label>
                        <input type="text" class="form-control" id="edit_region" name="region" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bagianid">Bagian</label>
                        <select class="form-control" id="edit_bagianid" name="bagianid" required>
                            @foreach ($bagians as $bagian)
                                <option value="{{ $bagian->BagianId }}">{{ $bagian->Nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveEditData">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle modal display and AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Handle adding data
        $('#saveAddData').on('click', function() {
            $('#addForm').submit();
        });

        // Handle edit modal data population
        $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var id_karyawan = button.data('id_karyawan');
        var nama = button.data('nama');
        var email = button.data('email');
        var username = button.data('username');
        var region = button.data('region');
        var bagianid = button.data('bagianid');

        var modal = $(this);
        modal.find('#edit_user_id').val(id);
        modal.find('#edit_id_karyawan').val(id_karyawan); 
        modal.find('#edit_nama').val(nama);
        modal.find('#edit_email').val(email);
        modal.find('#edit_username').val(username);
        modal.find('#edit_region').val(region);
        modal.find('#edit_bagianid').val(bagianid);
    });

    // Handle saving edited data with SweetAlert confirmation
    // Handle saving edited data with SweetAlert confirmation
    $('#saveEditData').on('click', function() {
        const form = $('#editForm');
    
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah Anda yakin ingin menyimpan perubahan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: form.attr('action'), // Use the form action URL
                    method: 'POST',
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    },
                    error: function(xhr) {
                        const errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan!';
                        Swal.fire({
                            title: 'Gagal!',
                            text: errorMessage,
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });


        // Handle delete confirmation
        $('.deletedata').on('click', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
</script>

@endsection
