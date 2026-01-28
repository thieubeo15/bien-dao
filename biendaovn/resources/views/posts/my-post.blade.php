<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bài viết của tôi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Quản lý nội dung đã đăng</h3>
                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        <i class="fas fa-plus mr-2"></i> Viết bài mới
                    </a>
                </div>

              <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
            <tr>
                <th scope="col" class="px-6 py-3 w-32">Ảnh</th>
                <th scope="col" class="px-6 py-3">Tiêu đề</th>
                <th scope="col" class="px-6 py-3 w-40 text-center">Ngày đăng</th>
                <th scope="col" class="px-6 py-3 w-40 text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             class="h-12 w-20 object-cover rounded shadow-sm mx-auto md:mx-0">
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 leading-relaxed">
                        {{ $post->title }}
                    </td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        {{ $post->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center space-x-4">
                            <a href="{{ route('posts.edit', $post->id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 font-bold no-underline flex items-center">
                                 <a href="{{ route('posts.edit', $post->id) }}"
           class="inline-flex items-center px-3 py-1.5 text-sm font-medium
                  text-white bg-blue-600 rounded-md
                  hover:bg-blue-700 transition">
             Sửa
        </a>
                            </a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" 
                                  onsubmit="return confirm('Xác nhận xóa bài viết này?')">
                                @csrf
                                @method('DELETE')
                               <button type="submit"
                class="inline-flex items-center px-3 py-1.5 text-sm font-medium
                       text-white bg-red-600 rounded-md
                       hover:bg-red-700 transition">
                Xóa
            </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                        Chưa có dữ liệu bài viết nào.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>