@foreach ($bookings as $item)
    <!-- Modal -->
    <div class="modal fade" id="modalEdit2{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Pilih Karyawan Booking Cuci</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('booking-cuci.updateKaryawan', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                            <select class="custom-select" id="karyawan_id" name="karyawan_id">
                                <option value="" selected>-- Pilih Karyawan --</option>
                                @foreach ($users as $user)
                                    @if ($user->role == '2' || $user->role == 'karyawan')
                                        @foreach ($user->statusKaryawan as $item2)
                                            @if ($item2->status == 'INACTIVE')
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
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
