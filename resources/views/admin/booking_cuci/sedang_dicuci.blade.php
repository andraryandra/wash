@extends('layouts.app')
@section('title', 'Dashboard - Admin')
@section('contentAdmin')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Booking Cuci Mobil</h4>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Create Booking Cuci Mobil
                            </button>
                        </div>

                        <div class="table-responsive-custom">
                            <table id="datatable" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kategori Mobil</th>
                                        <th class="text-center">Nama Pemesan</th>
                                        <th class="text-center">No Telp</th>
                                        <th class="text-center">Nama Mobil</th>
                                        <th class="text-center">No Plat Mobil</th>
                                        <th class="text-center">Tanggal Pesanan</th>
                                        <th class="text-center">Karyawan</th>
                                        <th class="text-center">Status Booking</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->kategoriMobil->kategori_mobil }}</td>
                                            <td class="text-center text-capitalize">{{ $item->user->name }}</td>
                                            <td class="text-center">{{ $item->no_telp_pemesan }}</td>
                                            <td class="text-center">{{ $item->nama_mobil }}</td>
                                            <td class="text-center">{{ $item->no_plat_mobil }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($item->tanggal_pesan)->format('d-m-Y') }} ||
                                                {{ $item->jam_pesan }}</td>

                                            <td class="text-center text-capitalize">
                                                @if ($item->karyawan_id == null)
                                                    <button type="button" class="btn btn-info text-light me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit2{{ $item->id }}">
                                                        Pilih Karyawan
                                                    </button>
                                                @else
                                                    {{ $item->karyawan->name }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_pesan == 'PENDING')
                                                    <span class="badge bg-warning text-light">Menunggu Cucian</span>
                                                @elseif ($item->status_pesan == 'PROCESS')
                                                    <span class="badge bg-primary text-light">Sedang Dicuci</span>
                                                @elseif ($item->status_pesan == 'SUCCESS')
                                                    <span class="badge bg-success text-light">Pencucian Selesai</span>
                                                @endif
                                            </td>
                                            {{-- <td class="text-center">
                                                @if ($item->status_bayar == 'UNPAID')
                                                    <span class="badge bg-warning text-light">Belum Bayar</span>
                                                @elseif ($item->status_bayar == 'PAID')
                                                    <span class="badge bg-success text-light">Sudah Bayar</span>
                                                @endif
                                            </td> --}}
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-warning text-light me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('booking-cuci.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            style="margin-left: 8px;">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal Edit --}}
    @include('admin.booking_cuci.edit')

    {{-- Modal Karyawan --}}
    @include('admin.booking_cuci.edit-2')

    {{-- Modal Produk --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Booking Cuci</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('booking-cuci.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="kategori-mobil" class="form-label">Kategori Mobil ID</label>
                            <select class="custom-select kategori-mobil" name="kategori_mobil_id" id="kategori-mobil"
                                required>
                                <option value="" selected>Select Kategori Mobil</option>
                                @foreach ($kategori_mobils as $kategori_mobil)
                                    <option value="{{ $kategori_mobil->id }}">{{ $kategori_mobil->kategori_mobil }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="produk-id" class="form-label">Kategori Mobil ID</label>
                            <select class="custom-select produk-id" name="produk_id" id="produk-id" required>
                                <option value="" selected>Select Produk</option>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->kategoriMobil->kategori_mobil }} ||
                                        {{ $produk->nama_produk }} || Rp. {{ number_format($produk->harga_produk) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Pemesan</label>
                            <select class="custom-select" name="user_id" id="user_id" required>
                                <option value="" selected>Select User</option>
                                @foreach ($users as $user)
                                    @if ($user->role == '0' || $user->role == 'user')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_pemesan" class="form-label">No. Telp Pemesan</label>
                            <input type="text" class="form-control" id="no_telp_pemesan" name="no_telp_pemesan"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mobil" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_plat_mobil" class="form-label">No. Plat Mobil</label>
                            <input type="text" class="form-control" id="no_plat_mobil" name="no_plat_mobil" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pesan" class="form-label">Tanggal Pesan</label>
                            <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jam_pesan" class="form-label">Jam Pesan</label>
                            <input type="time" class="form-control" id="jam_pesan" name="jam_pesan" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_pesan" class="form-label">Status Pesan</label>
                            <select class="custom-select" name="status_pesan" id="status_pesan" required>
                                <option value="" selected>Select Status Pesan</option>
                                <option value="PENDING">Menunggu Cucian</option>
                                <option value="PROCESS">Sedang Dicuci</option>
                                <option value="SUCCESS">Pencucian Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status_bayar" class="form-label">Status Bayar</label>
                            <select class="custom-select" name="status_bayar" id="status_bayar" required>
                                <option value="" selected>Select Status Bayar</option>
                                <option value="UNPAID">Belum Bayar</option>
                                <option value="PAID">Sudah Bayar</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection


@push('style')
    <style>
        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        }

        .custom-select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .custom-select:disabled {
            background-color: #e9ecef;
            opacity: 1;
        }
    </style>

    <style>
        .table-responsive-custom {
            overflow-x: auto;
        }

        .table-responsive-custom table {
            width: 100%;
            min-width: 750px;
            /* Sesuaikan dengan lebar tabel jika diperlukan */
        }
    </style>


    {{-- <link rel="stylesheet" href="{{ asset('bootstrap5-3/css/bootstrap.min.css') }}"> --}}
@endpush

@push('script')
    <script src="{{ asset('bootstrap5-3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('option[value=""]').css('display', 'none');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var kategoriMobilSelect = document.querySelector('.kategori-mobil');
            var produkSelect = document.querySelector('.produk-id');

            kategoriMobilSelect.addEventListener('change', function() {
                var selectedKategoriMobilId = this.value;

                // Menghapus semua opsi produk sebelumnya
                produkSelect.innerHTML = '';

                if (selectedKategoriMobilId) {
                    // Mendapatkan daftar produk berdasarkan kategori mobil yang dipilih
                    var produkList = {!! $produks->toJson() !!};

                    // Membuat opsi produk yang sesuai dengan kategori mobil terpilih
                    produkList.forEach(function(produk) {
                        if (produk.kategori_mobil_id == selectedKategoriMobilId) {
                            var option = document.createElement('option');
                            option.value = produk.id;
                            option.textContent = produk.nama_produk + ' || Rp. ' + parseFloat(produk
                                .harga_produk).toLocaleString();
                            produkSelect.appendChild(option);
                        }
                    });
                }
            });

            // Memastikan produk terpilih saat halaman dimuat
            var initialKategoriMobilId = kategoriMobilSelect.value;
            if (initialKategoriMobilId) {
                // Memicu perubahan pada kategori mobil untuk mengisi produk
                kategoriMobilSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var kategoriMobilSelect = document.getElementById('kategori-mobil');
            var produkSelect = document.getElementById('produk-id');

            kategoriMobilSelect.addEventListener('change', function() {
                var selectedKategoriMobilId = this.value;

                // Menghapus semua opsi produk sebelumnya
                produkSelect.innerHTML = '';

                if (selectedKategoriMobilId) {
                    // Mendapatkan daftar produk berdasarkan kategori mobil yang dipilih
                    var produkList = {!! $produks->toJson() !!};

                    // Membuat opsi produk yang sesuai dengan kategori mobil terpilih
                    produkList.forEach(function(produk) {
                        if (produk.kategori_mobil_id == selectedKategoriMobilId) {
                            var option = document.createElement('option');
                            option.value = produk.id;
                            option.textContent = produk.nama_produk + ' || Rp. ' + parseFloat(produk
                                    .harga_produk)
                                .toLocaleString();
                            produkSelect.appendChild(option);
                        }
                    });
                }
            });

            // Memastikan produk terpilih saat halaman dimuat
            var initialKategoriMobilId = kategoriMobilSelect.value;
            if (initialKategoriMobilId) {
                // Memicu perubahan pada kategori mobil untuk mengisi produk
                kategoriMobilSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endpush
