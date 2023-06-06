@extends('layouts.app')
@section('title', 'Dashboard - Admin')
@section('contentAdmin')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Produk Create</h4>
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
                                Create Produk
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Mobil</th>
                                        <th>Name</th>
                                        <th>Harga Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk_mobil as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kategoriMobil->kategori_mobil }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>Rp. {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                                            <td>{{ $item->deskripsi_produk }}</td>
                                            <td class="d-flex align-items-center">
                                                <div class="d-flex justify-content-between">
                                                    <button type="button" class="btn btn-warning text-light me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('produk-mobil.destroy', $item->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-2">Delete</button>
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

    @include('admin.produk.produk_mobil.edit')

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Create Produk Mobil</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produk-mobil.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_mobil_id" class="form-label">Kategori Mobil</label>
                            <select class="custom-select" id="kategori_mobil_id" name="kategori_mobil_id" required>
                                <option value="" select>-- pilih kategori mobil --</option>
                                @foreach ($kategori_mobils as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori_mobil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                placeholder="Nama Produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="input-harga" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="input-harga" name="harga_produk"
                                placeholder="Harga Produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" placeholder="Deskripsi" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="disableButton(this);"
                                id="buttonText">Simpan</button>
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
@endpush

@push('script')
    <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('bootstrap5-3/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('option[value=""]').css('display', 'none');
        });
    </script>

    <script>
        function disableButton(button) {
            button.disabled = true;
            var buttonText = document.getElementById("buttonText");
            buttonText.innerText = "Tunggu...";

            // Mengganti format angka sebelum submit
            var inputHarga = document.getElementById('input-harga');
            var nilaiInput = inputHarga.value.replace(/\D/g, '');
            inputHarga.value = nilaiInput;

            // Menjalankan submit form setelah 500ms
            setTimeout(function() {
                button.form.submit();
            }, 500);
        }
    </script>

    <script>
        function formatRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        var inputHarga = document.getElementById('input-harga');
        inputHarga.addEventListener('input', function(e) {
            var nilaiInput = e.target.value.replace(/\D/g, '');
            var nilaiFormat = formatRupiah(nilaiInput);
            e.target.value = nilaiFormat;
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            var inputHarga = document.getElementById('input-harga');
            var nilaiInput = inputHarga.value.replace(/\D/g, '');
            inputHarga.value = nilaiInput;
        });
    </script>
@endpush
