<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viết bài mới') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <div class="mb-4">
                            <label class="block font-bold mb-2">Tiêu đề bài viết</label>
                            <input type="text" name="title" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Nhập tiêu đề...">
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Chọn Danh mục</label>
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Ảnh đại diện</label>
                            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Tóm tắt ngắn</label>
                            <textarea name="summary" rows="3" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Mô tả ngắn gọn nội dung..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-2">Nội dung chi tiết</label>
                            <textarea name="content" rows="10" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Viết nội dung ở đây..."></textarea>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 font-bold">
                            ĐĂNG BÀI NGAY
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>