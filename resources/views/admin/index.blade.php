<x-app-layout>
    <x-sidebar>
        <div class="bg-white w-full min-h-screen border px-6 py-4 rounded-md shadow-md flex flex-col">

            <div class="flex justify-between items-center mb-6 flex-shrink-0">
                <h1 class="text-2xl font-bold text-blue-600">Data Meja</h1>
                <a href="{{ route('admin.meja') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition font-semibold">
                    + Tambah Meja
                </a>
            </div>

            <div class="overflow-auto max-h-[450px] flex-grow">
                <table class="w-full text-center border-collapse border">
                    <thead class="bg-blue-500 text-white sticky top-0">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Kapasitas</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($meja->isEmpty())
                            <tr>
                                <td colspan="4" class="py-8 text-gray-500">Belum ada data yang masuk</td>
                            </tr>
                        @else
                            @foreach ($meja as $mj)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-6 py-4 w-1/6 border">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 w-1/4 border">{{ $mj->kapasitas }}</td>
                                    <td class="px-6 py-4 w-1/4 border">
                                        @if ($mj->status === 'kosong')
                                            <span class="text-green-500 font-bold text-xl">✅</span>
                                        @elseif ($mj->status === 'terisi')
                                            <span class="text-red-500 font-bold text-xl">❌</span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 w-1/12 border ">
                                        <div class="flex justify-center space-x-4">
                                            <a href="{{ route('edit.meja',['id'=>$mj->id]) }}" class="text-blue-500 font-medium hover:underline">Edit</a>
                                        <form action="{{ route('hapus.meja',['id'=>$mj->id]) }}" id="delete-form-{{ $mj->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $mj->id }})" class="text-red-500 font-medium hover:underline">Delete</button>
                                        </form>
                                        </div>
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </x-sidebar>
</x-app-layout>
