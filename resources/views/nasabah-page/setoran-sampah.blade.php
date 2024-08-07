@extends('components.nasabah.layout-nasabah')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Setoran Sampah</h1>
    </div>

    <!-- Actions -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <button id="tambahSetoranBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-green-700" onclick="openModal('tambahModal')">
                    Tambah Setoran
                </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Cetak
                </button>
            </div>
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>

        <!-- Table -->
        <!-- Table -->
<div class="overflow-x-auto">
    <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
        <thead class="bg-hijau text-white">
            <tr>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">No</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Nasabah</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Tanggal</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Setor</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Jumlah Setoran</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Total Poin</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Total Setoran</th>
                <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white text-center">
            @foreach($setorans as $index => $setoran)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->nasabah }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->tanggal }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->setor }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->jumlah_setoran }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->total_poin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->total_setoran }}</td>
                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                        <button class="text-blue-500 hover:text-blue-900 mr-2" onclick="openModalDetail('lihatModal-{{ $setoran->id }}')">
                            <i class="fas fa-eye bg-blue-500 p-2 text-white rounded-md"></i>
                        </button>
                        <button class="text-yellow-500 hover:text-yellow-900 mr-2" onclick="openModal('editModal', '{{ $setoran->id }}')">
                            <i class="fas fa-edit bg-yellow-500 p-2 text-white rounded-md"></i>
                        </button>
                        <button class="text-red-500 hover:text-red-900" onclick="openHapusModal('{{ $setoran->id }}')">
                            <i class="fas fa-trash bg-red-500 p-2 text-white rounded-md"></i>
                        </button>

                        

                        <!-- MODAL LIHAT -->
                        <div id="lihatModal-{{ $setoran->id }}" class="fixed z-50 inset-0 overflow-y-auto hidden">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                                    <div class="flex justify-between items-center pb-3">
                                        <h3 class="text-2xl leading-6 font-bold text-primary">Lihat Setoran</h3>
                                        <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('lihatModal-{{$setoran->id}}')">
                                            <span class="material-icons">close</span>
                                        </button>
                                    </div>
                                    <div id="lihatSetoranContent">
                                        
                                    <p><strong>Nasabah:</strong> {{ $setoran->nasabah }}</p>
                                                <p><strong>Jenis Sampah:</strong> {{ $setoran->jenis }}</p>
                                                <p><strong>Berat (Kg):</strong> {{ $setoran->berat }}</p>
                                                <p><strong>Tanggal:</strong> {{ $setoran->tanggal }}</p>
                                                <p><strong>Setor:</strong> {{ $setoran->setor }}</p>
                                                <p><strong>Jumlah Setoran:</strong> {{ $setoran->jumlah_setoran }}</p>
                                                <p><strong>Total Poin:</strong> {{ $setoran->total_poin }}</p>
                                                <p><strong>Total Setoran:</strong> {{ $setoran->total_setoran }}</p>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400" onclick="closeModal('lihatModal-{{$setoran->id}}')">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    
    </div>

    <!-- MODAL TAMBAH SETORAN -->
<div id="tambahModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-2xl leading-6 font-bold text-primary">Tambah Setoran</h3>
                <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('tambahModal')">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <form action="{{ route('setoran.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nasabah" class="block text-sm font-medium text-gray-700">Nasabah</label>
                    <input type="text" id="nasabah" name="nasabah" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis sampah</label>
                    <input type="text" id="jenis" name="jenis" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="berat" class="block text-sm font-medium text-gray-700">Berat (Kg)</label>
                    <input type="text" id="berat" name="berat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="setor" class="block text-sm font-medium text-gray-700">Setor</label>
                    <input type="text" id="setor" name="setor" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="jumlahSetoran" class="block text-sm font-medium text-gray-700">Jumlah Setoran</label>
                    <input type="text" id="jumlahSetoran" name="jumlah_setoran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="totalPoin" class="block text-sm font-medium text-gray-700">Total Poin</label>
                    <input type="text" id="totalPoin" name="total_poin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="mb-4">
                    <label for="totalSetoran" class="block text-sm font-medium text-gray-700">Total Setoran</label>
                    <input type="text" id="totalSetoran" name="total_setoran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400" onclick="closeModal('tambahModal')">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- MODAL EDIT -->
    <div id="editModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-2xl leading-6 font-bold text-primary">Edit Setoran</h3>
                    <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('editModal')">
                        <span class="material-icons">close</span>
                    </button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id" />
                    <!-- Form Edit di sini -->
                    <div class="mb-4">
                        <label for="editNasabah" class="block text-sm font-medium text-gray-700">Nasabah</label>
                        <input type="text" id="editNasabah" name="nasabah" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editJenis" class="block text-sm font-medium text-gray-700">Jenis sampah</label>
                        <input type="text" id="editJenis" name="jenis" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editBerat" class="block text-sm font-medium text-gray-700">Berat (Kg)</label>
                        <input type="text" id="editBerat" name="berat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="editTanggal" name="tanggal" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editSetor" class="block text-sm font-medium text-gray-700">Setor</label>
                        <input type="text" id="editSetor" name="setor" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editJumlahSetoran" class="block text-sm font-medium text-gray-700">Jumlah Setoran</label>
                        <input type="text" id="editJumlahSetoran" name="jumlah_setoran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTotalPoin" class="block text-sm font-medium text-gray-700">Total Poin</label>
                        <input type="text" id="editTotalPoin" name="total_poin" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="mb-4">
                        <label for="editTotalSetoran" class="block text-sm font-medium text-gray-700">Total Setoran</label>
                        <input type="text" id="editTotalSetoran" name="total_setoran" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400" onclick="closeModal('editModal')">Batal</button>
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="hapusModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full p-6">
            <div class="flex justify-between items-center pb-3">
                <h3 class="text-2xl leading-6 font-bold text-primary">Hapus Setoran</h3>
                <button class="text-gray-400 hover:text-gray-500" onclick="closeModal('hapusModal')">
                    <span class="material-icons">close</span>
                </button>
            </div>
            <form id="hapusForm" method="POST">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ingin menghapus setoran ini?</p>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400" onclick="closeModal('hapusModal')">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
    function openHapusModal(id) {
        document.getElementById('hapusForm').action = `/nasabah/setoran-sampah/${id}`;
        openModal('hapusModal');
    }
</script>


<script>
    function openModal(modalId, id = null) {
        document.getElementById(modalId).classList.remove('hidden');
        if (id) {
            // Set the ID for edit/hapus forms if needed
            document.getElementById('editId').value = id;
            document.getElementById('hapusId').value = id;
            // Fetch data and populate fields for 'lihat' and 'edit' modals if needed
        }
    }
    function openModalDetail(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function toggleDetail(id) {
    const detailRow = document.getElementById(`detail-${id}`);
    if (detailRow.classList.contains('hidden')) {
        detailRow.classList.remove('hidden');
    } else {
        detailRow.classList.add('hidden');
    }
}

</script>
@endsection
