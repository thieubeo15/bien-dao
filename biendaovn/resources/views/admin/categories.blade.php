<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Danh mục</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-white p-6 shadow-sm rounded-lg h-fit">
                    <h3 class="font-bold mb-4">Thêm danh mục</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm mb-2">Tên danh mục</label>
                            <input type="text" name="name" class="w-full border-gray-300 rounded-md" required>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-2 rounded-md">Lưu danh mục</button>
                    </form>
                </div>

                <div class="col-span-2 bg-white p-6 shadow-sm rounded-lg">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="pb-3">ID</th>
                                <th class="pb-3">Tên Danh mục</th>
                                <th class="pb-3 text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                            <tr class="border-b last:border-0 hover:bg-gray-50">
                                <td class="py-3">{{ $cat->id }}</td>
                                <td class="py-3 font-bold">{{ $cat->name }}</td>
                                <td class="py-3 text-right">
                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Xóa danh mục này sẽ xóa hết bài viết bên trong. Chắc chắn?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>