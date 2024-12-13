@extends('layouts.dashboard')

@section('title', 'Berita')

@section('content')
    <div class="card">
        <div class="card-body flex flex-col gap-6">
            <div class="flex justify-between">
                <h6 class="text-lg text-gray-500 font-semibold">Berita</h6>
                <div class="block">
                    <a href="{{ route('berita.create') }}" type="button"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-base font-medium rounded-2xl border border-blue-600 text-blue-600 hover:border-blue-600 hover:text-white hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table id="berita" class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">No.</th>
                            <th scope="col" class="p-4 font-semibold">Judul</th>
                            <th scope="col" class="p-4 font-semibold">Category</th>
                            <th scope="col" class="p-4 font-semibold">Thumbnail</th>
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
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {
            $('#berita').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('api/berita') }}',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'thumbnail',
                        render: function(data, type, row) {
                            return "<img src='/storage/" + data +
                                "' alt='Thumbnail' class='w-16 h-16 object-cover'>";
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (data === "published") {
                                return "Published";
                            } else if (data === "draft") {
                                return "Draft";
                            } else {
                                return "-";
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

        function deleteBerita(id) {
            $.ajax({
                url: `{{ route('berita.destroy', ':id') }}`.replace(':id', id),
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
