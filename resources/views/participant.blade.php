<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        table {
            width: 100% !important
        }
    </style>
    <title>Tambah Data</title>
</head>

<body class="bg-gray-50">
    @if (session('message'))
        <div class="mx-auto w-full md:w-4/6 bg-gray-50 overflow-y-auto p-3">
            <div id="alert" class="flex p-4 bg-green-200 text-green-800 rounded-lg" role="alert">
                <i class="fa-solid fa-circle-check"></i>
                <div class="ml-3 text-sm font-medium">
                    {{ session('message') }}
                </div>
                <button type="button" class="ml-auto mr-2" data-dismiss-target="#alert" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>
    @endif
    <main class="mx-auto w-full md:w-4/6 bg-gray-50 overflow-y-auto p-3">
        <!-- Main content -->
        <div class="bg-white p-4 md:p-8 rounded-lg shadow-sm space-y-3">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-1">
              <div class="space-y-2">
                <h1 class="font-bold text-2xl">Data Beasiswa Siswa</h1>
                <p class="text-sm text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. In, quis?
                </p>
              </div>
                <a href="{{ route('dashboard.create') }}"
                    class="inline-block bg-teal-500 hover:bg-teal-600 px-3 py-1 text-white rounded-md text-sm">Download
                    Hasil</a>
            </div>
            <hr class="my-2 hidden">
            <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data" class="hidden">
                @csrf
                <input type="file" name="file" id="file"
                    class="border px-2 py-1 rounded-md text-gray-900 bg-gray-50 text-sm">
                <button type="submit"
                    class="bg-sky-500 hover:bg-sky-600 px-3 py-1 text-white rounded-md text-sm disabled">Upload</button>
            </form>
            <hr class="my-2">
            <div>
                <form action="{{ route('dashboard.add') }}" method="POST">
                    @csrf
                    <div class="flex flex-col md:flex-row items-start md:items-end gap-2 mb-3">
                        <div class="w-full flex flex-col">
                            <label class="text-sm mb-1">Nama Lengkap:</label>
                            <input type="text" name="name" placeholder="Tulis nama lengkap disini..."
                                class="w-full border px-2 py-1 rounded-md text-gray-900 bg-gray-50 text-sm">
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="text-sm mb-1">Asal sekolah:</label>
                            <input type="text" name="school" placeholder="Tulis asal sekolah disini..."
                                class="w-full border px-2 py-1 rounded-md text-gray-900 bg-gray-50 text-sm">
                        </div>
                        <button type="submit" name="button"
                            class="bg-sky-500 hover:bg-sky-600 px-3 py-1 text-white rounded-md text-sm">Simpan</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="relative overflow-x-auto">
                <table class="table-tailwindcss w-92 text-sm text-left text-gray-800" id="users-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 rounded-l-lg">Kode</th>
                            <th class="px-6 py-2">Nama lengkap</th>
                            <th class="px-6 py-2">Sekolah</th>
                            <th class="px-6 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700"></tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                ajax: {
                    url: 'api/schoolarship',
                    dataSrc: 'students'
                },
                columns: [{
                        data: 'code'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'school'
                    },{
                      data: 'status',
                      render: (data, type, row) => {
                        return data == '1' ? '<i class="fa-solid fa-circle-check text-teal-600"></i>' : '<i class="fa-solid fa-circle-xmark text-red-600"></i>'
                      }
                    }
                ],
            });
        });
    </script>
</body>

</html>
