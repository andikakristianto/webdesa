@extends('layouts.dashboard')


@section('title', 'Management Layanan KK')

@section('content')
    <div class="card">
        <div class="card-title">
            <h1 class="p-4 font-bold text-center">Management Kartu Keluarga Masyarakat</h1>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="relative overflow-x-auto">
                    <table id="KK" class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                        <thead>
                            <tr class="text-sm">
                                <th scope="col" class="p-4 font-semibold">No.</th>
                                <th scope="col" class="p-4 font-semibold">NIK</th>
                                {{-- <th scope="col" class="p-4 font-semibold">Jenis Kelamin</th> --}}
                                <th scope="col" class="p-4 font-semibold">Kepala Keluarga</th>
                                <th scope="col" class="p-4 font-semibold">Tanggal Lahir</th>
                                <th scope="col" class="p-4 font-semibold">Tempat Lahir</th>
                                <th scope="col" class="p-4 font-semibold">Files</th>
                                <th scope="col" class="p-4 font-semibold">Message</th>
                                <th scope="col" class="p-4 font-semibold">Status</th>
                                <th scope="col" class="p-4 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {

            $('#KK').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('api/kk') }}',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'nik'
                    },
                    // {
                    //     data: 'jeniskelamin',
                    //     render: function(data, type, row) {
                    //         if (data === "laki") {
                    //             return "Laki-Laki";
                    //         } else if (data === "perempuan") {
                    //             return "Perempuan";
                    //         } else {}
                    //     }
                    // },
                    {
                        data: 'kepalakeluarga'
                    },
                    {
                        data: 'tanggallahir'
                    },
                    {
                        data: 'tempatlahir'
                    },
                    {
                        data: 'files',
                        render: function(data, type, row) {
                            return '<a class="btn btn-sm btn-info" target="_blank" href="../../storage/' +
                                data +
                                '">Lihat</a>';
                        }
                    },
                    {
                        data: 'message',
                        render: function(data, type, row) {
                            if (row.status === "rejected") {
                                if (row.message === null) {
                                    return `<a href="/management/kk/comments/${row.id}" class="py-2 px-7 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-transparent bg-red-500 text-white hover:bg-red-600">Tambah</a>`;
                                } else {
                                    return data;
                                }
                            } else if (row.status === "done") {
                                return data;
                            } else {
                                return "-";
                            }
                        }
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (data === "sending") {
                                return "Sending";
                            } else if (data === "pending") {
                                return "Pending";
                            } else if (data === "done") {
                                return "Done";
                            } else if (data === "rejected") {
                                return "Rejected";
                            }
                        }
                    },

                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                language: {
                    responsive: true,
                    search: "_INPUT_",
                    searchPlaceholder: "Cari...",
                    lengthMenu: "_MENU_",
                    info: "Show _START_ hingga _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Previous",
                        next: "Next"
                    },
                    emptyTable: "No data available in table"
                },
                dom: '<"flex justify-between items-center mb-4"<"length-dropdown"l><"search-input"f>>rt<"flex justify-between items-center mt-4"ip>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass(
                        'py-2 px-4 border border-gray-300 rounded-lg');
                    $('.dataTables_length select').addClass(
                        'py-2 px-4 border border-gray-300 rounded-lg');
                }
            });
        });

        function acceptRecord(id) {
            $.ajax({
                url: `{{ route('managementkk.pending', ':id') }}`.replace(':id', id),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    alert('Terjadi kesalahan: ' + error.responseJSON.message);
                }
            });
        }

        function deleteRecord(id) {
            $.ajax({
                url: `{{ route('managementkk.destroy', ':id') }}`.replace(':id', id),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    alert('Terjadi kesalahan: ' + error.responseJSON.message);
                }
            });
        }

        function doneRecord(id) {
            $.ajax({
                url: `{{ route('managementkk.done', ':id') }}`.replace(':id', id),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    alert('Terjadi kesalahan: ' + error.responseJSON.message);
                }
            });
        }

        function rejectRecord(id) {
            $.ajax({
                url: `{{ route('managementkk.reject', ':id') }}`.replace(':id', id),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    alert('Terjadi kesalahan: ' + error.responseJSON.message);
                }
            });
        }
    </script>
@endpush
