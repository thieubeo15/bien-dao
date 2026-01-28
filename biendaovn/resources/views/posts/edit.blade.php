<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fas fa-edit mr-2 text-blue-600"></i> Chỉnh sửa bài viết
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- TIÊU ĐỀ --}}
                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-1">Tiêu đề bài viết</label>
                        <div class="relative">
                            <input type="text" name="title"
                                value="{{ old('title', $post->title) }}"
                                class="w-full rounded-md px-3 py-2 pr-10 border-2 transition-all focus:outline-none
                                {{ $errors->has('title') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-200' : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100' }}"
                                placeholder="Nhập tiêu đề...">
                            
                            @error('title')
                                <i class="fas fa-exclamation-circle text-red-500 absolute right-3 top-3"></i>
                            @enderror
                        </div>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- DANH MỤC --}}
                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-1">Chọn danh mục</label>
                        <select name="category_id"
                            class="w-full rounded-md px-3 py-2 border-2 transition-all focus:outline-none
                            {{ $errors->has('category_id') ? 'border-red-500 bg-red-50' : 'border-gray-300 focus:border-blue-500' }}">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ẢNH --}}
                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-1">Ảnh đại diện</label>
                        <input type="file" name="image"
                            class="w-full rounded-md px-3 py-2 border-2 
                            {{ $errors->has('image') ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">
                        
                        @if($post->image)
                            <div class="mt-3 p-2 border rounded bg-gray-50 w-fit">
                                <p class="text-xs text-gray-500 mb-1 uppercase font-bold">Ảnh hiện tại:</p>
                                <img src="{{ asset('storage/'.$post->image) }}" class="h-32 rounded shadow-sm object-cover">
                            </div>
                        @endif
                        @error('image')
                            <p class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- TÓM TẮT --}}
                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-1">Tóm tắt ngắn</label>
                        <div class="relative">
                            <textarea name="summary" rows="3"
                                class="w-full rounded-md px-3 py-2 pr-10 border-2 transition-all focus:outline-none
                                {{ $errors->has('summary') ? 'border-red-500 bg-red-50 focus:ring-2 focus:ring-red-200' : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100' }}"
                                placeholder="Mô tả ngắn gọn nội dung...">{{ old('summary', $post->summary) }}</textarea>
                            
                            @error('summary')
                                <i class="fas fa-exclamation-circle text-red-500 absolute right-3 top-3"></i>
                            @enderror
                        </div>
                        @error('summary')
                            <p class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NỘI DUNG --}}
                    <div class="mb-6">
                        <label class="block font-bold text-gray-700 mb-1">Nội dung chi tiết</label>
                        <div class="relative">
                           <div class="mb-3">
    <textarea name="content" id="editor" class="form-control" rows="10">
        {{ old('content', $post->content ?? '') }}
    </textarea>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<style>
    /* Chỉnh chiều cao khung soạn thảo cho dễ viết */
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

<script>
   ClassicEditor
    .create(document.querySelector('#editor'), {
        ckfinder: {
            uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}"
        },
        // THÊM CẤU HÌNH NÀY ĐỂ CÓ NÚT CHỈNH ẢNH
        image: {
            toolbar: [
                'imageTextAlternative', 
                'toggleImageCaption', 
                'imageStyle:inline', 
                'imageStyle:block', 
                'imageStyle:side'
            ]
        }
    })
    .catch(error => {
        console.error(error);
    });
</script>
                            
                            @error('content')
                                <i class="fas fa-exclamation-circle text-red-500 absolute right-3 top-3"></i>
                            @enderror
                        </div>
                        @error('content')
                            <p class="text-red-600 text-sm mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 border-t pt-6">
                        {{-- Nút Hủy --}}
                        <a href="{{ url()->previous() }}" 
                           class="px-6 py-2 bg-white text-gray-700 rounded-md hover:bg-gray-50 transition font-bold border-2 border-gray-300">
                            HỦY BỎ
                        </a>

                        {{-- Nút Cập nhật --}}
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition font-bold shadow-md">
                            <i class="fas fa-save mr-1"></i> CẬP NHẬT
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>