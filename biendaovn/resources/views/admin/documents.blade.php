<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Thông báo</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- FORM THÊM MỚI (Đã nâng cấp) --}}
            <div class="bg-white p-6 shadow-sm rounded-lg mb-6">
                <h3 class="font-bold text-lg mb-4 text-gray-700 border-b pb-2">Đăng thông báo mới</h3>
                
                <form action="{{ route('admin.documents.store') }}" method="POST">
                    @csrf
                    
                    {{-- 1. Tiêu đề --}}
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nội dung thông báo / Văn bản</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="Ví dụ: Lịch tiếp dân tháng 5...">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- 2. [MỚI] Chọn bài viết có sẵn --}}
                        <div class="bg-blue-50 p-4 rounded-md border border-blue-100">
                            <label class="block text-sm font-bold text-blue-800 mb-1">
                                <i class="fas fa-newspaper mr-1"></i> Cách 1: Chọn từ Bài viết
                            </label>
                            <p class="text-xs text-gray-500 mb-2">Hệ thống sẽ tự động lấy link của bài viết này.</p>
                            
                            <select name="post_id_link" class="w-full border-gray-300 rounded-md text-sm">
                                <option value="">-- Chọn bài viết liên quan --</option>
                                {{-- Biến $posts được truyền từ AdminController --}}
                                @if(isset($posts))
                                    @foreach($posts as $post)
                                        <option value="{{ route('posts.show', $post->id) }}">
                                            {{ Str::limit($post->title, 50) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        {{-- 3. Nhập Link thủ công --}}
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-1">
                                <i class="fas fa-link mr-1"></i> Cách 2: Dán Link thủ công
                            </label>
                            <p class="text-xs text-gray-500 mb-2">Dùng cho link Google Drive, văn bản PDF ngoài...</p>
                            
                            <input type="text" name="link" class="w-full border-gray-300 rounded-md text-sm" placeholder="https://...">
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="bg-blue-600 text-white font-bold px-8 py-2.5 rounded-md hover:bg-blue-700 shadow-lg transition duration-150">
                            <i class="fas fa-paper-plane mr-2"></i> Đăng Thông Báo
                        </button>
                    </div>
                </form>
            </div>

            {{-- DANH SÁCH THÔNG BÁO (Giữ nguyên logic cũ) --}}
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <h3 class="font-bold text-lg mb-4 text-gray-700">Danh sách đã đăng</h3>
                <ul>
                    @foreach($documents as $doc)
                    <li class="flex justify-between items-center border-b py-3 last:border-0 hover:bg-gray-50 px-2 transition">
                        <div>
                            <span class="text-xs text-gray-500 block mb-1">
                                <i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y H:i') }}
                            </span>
                            <a href="{{ $doc->link }}" target="_blank" class="text-blue-700 font-semibold hover:underline text-base">
                                {{ $doc->title }}
                            </a>
                            @if($doc->is_new) 
                                <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded ml-2 border border-red-200">Mới</span> 
                            @endif
                        </div>
                        
                        <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa thông báo này?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded transition" title="Xóa">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>