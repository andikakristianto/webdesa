@extends('layouts.dashboard')


@section('title', 'Layanan KK')

@section('content')
    <div class="card mt-5 mb-5">
        <div class="card-title">
            <h1 class="p-4 font-bold">Kartu Keluarga</h1>
        </div>
        <div class="card-body">
            <div class="relative overflow-x-auto">
                <table id="KK" class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">No.</th>
                            <th scope="col" class="p-4 font-semibold">NIK</th>
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

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#KK').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('kkuser') }}',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'message',
                        render: function(data, type, row) {
                            return data ? data : "Empty";
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

            $('#KTP').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('ktpuser') }}',
                columns: [{
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'message',
                        render: function(data, type, row) {
                            return data ? data : "Empty";
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
    </script>
@endpush
