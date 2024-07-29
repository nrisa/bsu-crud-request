@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">
            Data Nasabah Bank Sampah Pelita Bangsa
        </h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <button id="tambahNasabahBtn" class="bg-primary text-white font-bold py-2 px-4 rounded-md hover:bg-green-600">
                <span class="material-icons align-middle">add</span>
                <span class="align-middle">Tambah Nasabah</span>
            </button>
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">No</th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">No. Induk</th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">Nama</th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">Alamat</th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">Jumlah Orang/KK</th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($nasabahs as $nasabah)
                        <tr>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $nasabah->no_induk }}</td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $nasabah->name }}</td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $nasabah->alamat }}</td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $nasabah->jumlah }}</td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                <button class="text-blue-600 hover:text-blue-900 mr-2" onclick="openModal('lihatModal')">
                                    <i class="fas fa-eye bg-blue-500 p-2 text-white rounded-md"></i>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 mr-2" onclick="openModal('editModal')">
                                    <i class="fas fa-edit bg-yellow-500 p-2 text-white rounded-md"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" onclick="openModal('hapusModal')">
                                    <i class="fas fa-trash bg-red-500 p-2 text-white rounded-md"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH NASABAH -->
    <div id="modal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Nasabah</h3>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form action="{{ route('nasabah.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="password" value="admin1234">
                    <input type="hidden" name="email" value="test@test.com">
                    <div class="mb-4">
                        <label for="no_induk" class="block text-sm font-medium text-gray-700">No. Induk</label>
                        <input type="text" name="no_induk" id="no_induk" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" id="alamat" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Orang/KK</label>
                        <input type="number" name="jumlah" id="jumlah" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400" id="closeModalBtn2">Cancel</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const tambahNasabahBtn = document.getElementById('tambahNasabahBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalBtn2 = document.getElementById('closeModalBtn2');
        const modal = document.getElementById('modal');

        tambahNasabahBtn.addEventListener('click', function () {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', function () {
            modal.classList.add('hidden');
        });

        closeModalBtn2.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    </script>
@endsection
