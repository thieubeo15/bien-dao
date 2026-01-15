<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Duyệt bài viết') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="alert alert-success bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="min-w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="p-3 font-bold text-gray-700">Hình ảnh</th>
                            <th class="p-3 font-bold text-gray-700">Tiêu đề bài viết</th>
                            <th class="p-3 font-bold text-gray-700">Tác giả</th>
                            <th class="p-3 font-bold text-gray-700">Ngày đăng</th>
                            <th class="p-3 font-bold text-gray-700 text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                @if($post->image)
                                    <img src="{{ asset('storage/'.$post->image) }}" class="h-12 w-16 object-cover rounded border">
                                @else
                                    <span class="text-gray-400 text-xs bg-gray-100 px-2 py-1 rounded">No Image</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <a href="{{ route('posts.show', $post->id) }}" target="_blank" class="font-medium text-blue-700 hover:underline text-lg">
                                    {{ $post->title }}
                                </a>
                                <p class="text-gray-500 text-xs truncate w-64">{{ $post->summary }}</p>
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                {{ $post->user->name ?? 'Admin' }}
                            </td>
                            <td class="p-3 text-sm text-gray-500">
                                {{ $post->created_at->format('d/m/Y') }}
                            </td>
                            <td class="p-3 text-right">
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('CẢNH BÁO: Bạn có chắc chắn muốn xóa bài viết này vĩnh viễn không?');">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="bg-red-100 text-red-600 px-3 py-1.5 rounded text-sm hover:bg-red-600 hover:text-white transition font-bold">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>