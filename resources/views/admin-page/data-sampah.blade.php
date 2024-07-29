@extends('components.admin.layout-admin')

@section('content')
    <!-- Main content -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Action Button -->
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="addWasteButton" class="bg-hijau text-white font-bold py-2 px-4 rounded-md hover:bg-green-600">
                    <span class="material-icons align-middle">add</span>
                    <span class="align-middle">Tambah Jenis Sampah</span>
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>

        <!-- Waste Data Table -->
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-hijau text-white">
                <tr>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">No</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Tanggal</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Kategori</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Jenis Sampah</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">KG</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Debet</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Kredit</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Saldo</th>
                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border-2 border-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white" id="wasteTableBody">
                @foreach ($wastes as $index => $waste)
                    <tr>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->date }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->category }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->type }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->kg }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->debet }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->kredit }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">{{ $waste->saldo }}</td>
                        <td class="px-6 py-4 text-center border-2 border-gray-300">
                            <button class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600" onclick="openEditModal({{ $waste }})">
                                <span class="material-icons align-middle">edit</span>
                            </button>
                            <button class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 ml-2" onclick="openDeleteModal({{ $waste->id }})">
                                <span class="material-icons align-middle">delete</span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Sampah -->
    <div id="addWasteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="closeModal('addWasteModal')">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-xl font-bold mb-4">Tambah Jenis Sampah</h2>
                <form action="{{ route('waste.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="inputDate" class="block text-sm font-bold mb-2">Tanggal Penginputan</label>
                        <input type="date" name="date" id="inputDate" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="categorySelectModal" class="block text-sm font-bold mb-2">Pilih Kategori Sampah</label>
                        <select name="category" id="categorySelectModal" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="plastik">Plastik</option>
                            <option value="logam">Logam</option>
                            <option value="kertas">Kertas</option>
                            <option value="botol_kaca">Botol Kaca</option>
                            <option value="minyak_jelanta">Minyak Jelanta</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="wasteTypeSelect" class="block text-sm font-bold mb-2">Pilih Jenis Sampah</label>
                        <select name="type" id="wasteTypeSelect" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <option value="bengkel">Bengkel</option>
                            <option value="rumah">Rumah</option>
                            <option value="perabotan">Perabotan</option>
                            <option value="kantor">Kantor</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="inputKg" class="block text-sm font-bold mb-2">Jumlah (kg)</label>
                        <input type="number" name="kg" id="inputKg" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="inputDebet" class="block text-sm font-bold mb-2">Debet</label>
                        <input type="number" name="debet" id="inputDebet" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="inputKredit" class="block text-sm font-bold mb-2">Kredit</label>
                        <input type="number" name="kredit" id="inputKredit" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="inputKredit" class="block text-sm font-bold mb-2">saldo</label>
                        <input type="number" name="saldo" id="inputKredit" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2" onclick="closeModal('addWasteModal')">Batal</button>
                        <button type="submit" class="bg-hijau text-white font-bold py-2 px-4 rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Sampah -->
    <div id="editWasteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="closeModal('editWasteModal')">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-xl font-bold mb-4">Edit Jenis Sampah</h2>
                <form action="" method="POST" id="editWasteForm">
                    @csrf
                    @method('PUT') <!-- Use PUT for updating -->
                    <div class="mb-4">
                        <label for="editInputDate" class="block text-sm font-bold mb-2">Tanggal Penginputan</label>
                        <input type="date" name="date" id="editInputDate" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editCategorySelect" class="block text-sm font-bold mb-2">Pilih Kategori Sampah</label>
                        <select name="category" id="editCategorySelect" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="plastik">Plastik</option>
                            <option value="logam">Logam</option>
                            <option value="kertas">Kertas</option>
                            <option value="botol_kaca">Botol Kaca</option>
                            <option value="minyak_jelanta">Minyak Jelanta</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editWasteTypeSelect" class="block text-sm font-bold mb-2">Pilih Jenis Sampah</label>
                        <select name="type" id="editWasteTypeSelect" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            <!-- Opsi akan diisi secara dinamis berdasarkan kategori -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editInputKg" class="block text-sm font-bold mb-2">Jumlah (kg)</label>
                        <input type="number" name="kg" id="editInputKg" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editInputDebet" class="block text-sm font-bold mb-2">Debet</label>
                        <input type="number" name="debet" id="editInputDebet" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="editInputKredit" class="block text-sm font-bold mb-2">Kredit</label>
                        <input type="number" name="kredit" id="editInputKredit" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2" onclick="closeModal('editWasteModal')">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Sampah -->
    <div id="deleteWasteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full relative">
                <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800" onclick="closeModal('deleteWasteModal')">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-xl font-bold mb-4">Hapus Jenis Sampah</h2>
                <p>Apakah Anda yakin ingin menghapus jenis sampah ini?</p>
                <form action="" method="POST" id="deleteWasteForm">
                    @csrf
                    @method('DELETE') <!-- Use DELETE for removing -->
                    <div class="flex justify-end mt-4">
                        <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md mr-2" onclick="closeModal('deleteWasteModal')">Batal</button>
                        <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addWasteModal').classList.remove('hidden');
        }

        function openEditModal(waste) {
            document.getElementById('editWasteModal').classList.remove('hidden');

            // Populate fields with waste data
            document.getElementById('editInputDate').value = waste.date;
            document.getElementById('editCategorySelect').value = waste.category;
            document.getElementById('editWasteTypeSelect').value = waste.type;
            document.getElementById('editInputKg').value = waste.kg;
            document.getElementById('editInputDebet').value = waste.debet;
            document.getElementById('editInputKredit').value = waste.kredit;

            // Set form action to update
            document.getElementById('editWasteForm').action = '/waste/' + waste.id;
        }

        function openDeleteModal(wasteId) {
            document.getElementById('deleteWasteModal').classList.remove('hidden');

            // Set form action to delete
            document.getElementById('deleteWasteForm').action = '/waste/' + wasteId;
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.getElementById('addWasteButton').addEventListener('click', openAddModal);
    </script>
@endsection
