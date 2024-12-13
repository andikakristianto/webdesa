@extends('layouts.dashboard')


@section('title', 'List Masyarakat')


@section('content')

    <div class="card">
        <div class="card-body flex flex-col gap-6">
            <div class="flex justify-between">
                <h6 class="text-lg text-gray-500 font-semibold">Dashboard {{ Auth::user()->name }}</h6>
                <div class="block">
                    <a href="{{ route('import.index') }}" type="button"
                        class="py-2 px-6 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600 btn-import">
                        Import
                    </a>

                    <a href="{{ route('masyarakat.tambah') }}" type="button"
                        class="py-2 px-6 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600">
                        Tambah
                    </a>
                </div>
            </div>
            <div class="card ">
                <div class="card-body">
                    <h4 class="text-gray-500 text-lg font-semibold mb-5">Masyarakat</h4>
                    <div class="relative overflow-x-auto">
                        <table id="masyarakatTable" class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                            <thead>
                                <tr class="text-sm">
                                    <th scope="col" class="p-4 font-semibold">No.</th>
                                    <th scope="col" class="p-4 font-semibold">Nama</th>
                                    <th scope="col" class="p-4 font-semibold">Jenis Kelamin</th>
                                    <th scope="col" class="p-4 font-semibold">NIK</th>
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
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#masyarakatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('api/user') }}',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'jenis_kelamin',
                        render: function(data, type, row, meta) {
                            if (data === 'laki') {
                                return 'Laki-Laki';
                            } else if (data === 'perempuan') {
                                return 'Perempuan';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                language: {
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

        function deleteUser(id) {
            $.ajax({
                url: `{{ route('masyarakat.destroy', ':id') }}`.replace(':id', id),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    location.reload();
                }
            });
        }
    </script>
@endpush
