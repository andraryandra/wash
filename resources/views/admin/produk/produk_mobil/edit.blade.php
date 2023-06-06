@foreach ($produk_mobil as $item)
    <!-- Modal -->
    <div class="modal fade" id="modalEdit{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produk-mobil.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Tambahkan field-field edit sesuai kebutuhan -->
                        <div class="mb-3">
                            <label for="kategori_mobil_id" class="form-label">Kategori Mobil</label>
                            <select class="custom-select" id="kategori_mobil_id" name="kategori_mobil_id" required>
                                <option value="">-- pilih kategori mobil --</option>
                                @foreach ($kategori_mobils as $mobil)
                                    <option value="{{ $mobil->id }}"
                                        {{ $item->kategori_mobil_id == $mobil->id ? 'selected' : '' }}>
                                        {{ $mobil->kategori_mobil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                value="{{ $item->nama_produk }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga_produk" class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" id="harga_produk" name="harga_produk"
                                value="{{ number_format($item->harga_produk, 0, '', '') }}" required>
                        </div>


                        <div class="mb-3">
                            <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required>{{ $item->deskripsi_produk }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
