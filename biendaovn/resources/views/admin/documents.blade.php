<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Thông báo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 shadow-sm rounded-lg mb-6">
                <form action="{{ route('admin.documents.store') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div class="flex-1">
                        <label class="block text-sm font-medium">Nội dung thông báo / Văn bản</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md" required placeholder="Ví dụ: Lịch tiếp dân tháng 5...">
                    </div>
                    <div class="w-1/3">
                        <label class="block text-sm font-medium">Đường dẫn / Link tải (nếu có)</label>
                        <input type="text" name="link" class="w-full border-gray-300 rounded-md" placeholder="http://...">
                    </div>
                    <button class="bg-green-600 border border-green-700  px-6 py-2 rounded-md hover:bg-green-700">Đăng</button>
                </form>
            </div>

            <div class="bg-white p-6 shadow-sm rounded-lg">
                <ul>
                    @foreach($documents as $doc)
                    <li class="flex justify-between items-center border-b py-3 last:border-0">
                        <div>
                            <span class="text-xs text-gray-500 block">{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</span>
                            <a href="{{ $doc->link }}" class="text-blue-700 font-medium hover:underline">{{ $doc->title }}</a>
                            @if($doc->is_new) <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded ml-2">Mới</span> @endif
                        </div>
                        <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Xóa thông báo này?');">
                            @csrf @method('DELETE')
                            <button class="text-gray-400 hover:text-red-600"><i class="fas fa-trash"></i> Xóa</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>