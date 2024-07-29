@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Manajemen Admin</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="tambahAdminBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700">
                    Tambah Admin
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari admin..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            No
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Nama
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Alamat
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            No. HP/WA
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Email
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Jabatan
                        </th>
                        <th class="px-6 py-3 text-center text-sm font-bold uppercase tracking-wider border-2 border-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>    
                <tbody class="bg-white">
                    @foreach($admins as $admin)
                        <tr>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $admin->nama }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $admin->alamat }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $admin->no_hp }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $admin->email }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                {{ $admin->jabatan }}
                            </td>
                            <td class="px-6 py-4 text-center border-2 border-gray-300">
                                <button class="text-blue-600 hover:text-blue-900 mr-2" onclick="openModal('lihatModal', {{ $admin->id }})">
                                    <i class="fas fa-eye bg-blue-500 p-2 text-white rounded-md"></i>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 mr-2" onclick="openModal('editModal', {{ $admin->id }})">
                                    <i class="fas fa-edit bg-yellow-600 p-2 text-white rounded-md"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-900" onclick="openModal('hapusModal', {{ $admin->id }})">
                                    <i class="fas fa-trash bg-red-600 p-2 text-white rounded-md"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH ADMIN --}}
    <div id="tambahModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('tambahModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="password" value="test1234">
                    <div class="mb-4">
                        <label for="namaAdmin" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="namaAdmin" name="name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="alamatAdmin" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <input type="text" id="alamatAdmin" name="alamat"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="noHpAdmin" class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                        <input type="text" id="noHpAdmin" name="no_hp"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="emailAdmin" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="emailAdmin" name="email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="jabatanAdmin" class="block text-sm font-medium text-gray-700">Jabatan</label>
                        <select id="jabatanAdmin" name="jabatan"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm">
                            <option value="Admin">Admin</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Sekretaris">Sekretaris</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                            onclick="closeModal('tambahModal')">Cancel</button>
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL LIHAT ADMIN --}}
    <div id="lihatModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Lihat Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <p id="lihatNamaAdmin" class="mt-1 text-gray-900"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <p id="lihatAlamatAdmin" class="mt-1 text-gray-900"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                    <p id="lihatNoHpAdmin" class="mt-1 text-gray-900"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p id="lihatEmailAdmin" class="mt-1 text-gray-900"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <p id="lihatJabatanAdmin" class="mt-1 text-gray-900"></p>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT ADMIN --}}
<div id="editModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-2xl leading-6 font-bold text-primary">Edit Admin</h3>
                <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <form id="editForm" action="{{ route('admin.update', ['id' => 'id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="editNamaAdmin" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="editNamaAdmin" name="nama"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="editAlamatAdmin" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" id="editAlamatAdmin" name="alamat"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="editNoHpAdmin" class="block text-sm font-medium text-gray-700">No.Hp/Wa</label>
                    <input type="text" id="editNoHpAdmin" name="no_hp"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="editEmailAdmin" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmailAdmin" name="email"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="editJabatanAdmin" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select id="editJabatanAdmin" name="jabatan"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-hijau focus:border-hijau sm:text-sm">
                        <option value="Admin">Admin</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Sekretaris">Sekretaris</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400"
                        onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit"
                        class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


    {{-- MODAL HAPUS ADMIN --}}
    <div id="hapusModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Hapus Admin</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('hapusModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form id="hapusForm" action="{{ route('admin.destroy', 0) }}" method="POST">
    @csrf
    @method('DELETE')
    <p class="mb-4">Apakah Anda yakin ingin menghapus admin ini?</p>
    <div class="flex justify-end">
        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400" onclick="closeModal('hapusModal')">Cancel</button>
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Delete</button>
    </div>
</form>

            </div>
        </div>
    </div>


    <script>
    document.getElementById('tambahAdminBtn').addEventListener('click', function() {
        openModal('tambahModal');
    });

    function openModal(modalId, adminId = null) {
    document.getElementById(modalId).classList.remove('hidden');
    
    if (modalId === 'editModal' && adminId) {
        fetch(`/admin/${adminId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editNamaAdmin').value = data.nama;
                document.getElementById('editAlamatAdmin').value = data.alamat;
                document.getElementById('editNoHpAdmin').value = data.no_hp;
                document.getElementById('editEmailAdmin').value = data.email;
                document.getElementById('editJabatanAdmin').value = data.jabatan;
                document.getElementById('editForm').action = `/admin/${adminId}`;
            });
    }
    
    if (modalId === 'lihatModal' && adminId) {
        fetch(`/admin/${adminId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('lihatNamaAdmin').textContent = data.nama;
                document.getElementById('lihatAlamatAdmin').textContent = data.alamat;
                document.getElementById('lihatNoHpAdmin').textContent = data.no_hp;
                document.getElementById('lihatEmailAdmin').textContent = data.email;
                document.getElementById('lihatJabatanAdmin').textContent = data.jabatan;
            });
    }

    if (modalId === 'hapusModal' && adminId) {
        document.getElementById('hapusForm').action = `/admin/${adminId}`;
    }
}


    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>

@endsection
