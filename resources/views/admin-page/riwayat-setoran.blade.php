@extends('components.admin.layout-admin')

@section('content')
    <div class="mb-6">
        <h1 class="font-bold text-3xl text-gray-900">Riwayat Setoran Sampah</h1>
    </div>
    <!-- Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div>
                <input type="text" placeholder="Cari nama nasabah..." class="px-4 py-2 border border-gray-300 rounded-lg" />
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-2 border-gray-200 divide-y divide-gray-200">
                <thead class="bg-hijau text-white">
                    <tr>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            No
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Nasabah
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Setor
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Jumlah Setoran
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Total Poin
                        </th>
                        <th class="px-6 py-3 text-center font-bold uppercase tracking-wider border border-gray-300">
                            Total Setoran
                        </th>
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
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ $setoran->total_setoran}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

