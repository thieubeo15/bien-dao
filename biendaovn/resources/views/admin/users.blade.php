<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Thành viên</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <h3 class="font-bold mb-4">Thêm thành viên mới</h3>
                <form action="{{ route('admin.users.store') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium">Tên hiển thị</label>
                        <input type="text" name="name" class="border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" class="border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Mật khẩu</label>
                        <input type="text" name="password" class="border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Quyền hạn</label>
                        <select name="role" class="border-gray-300 rounded-md shadow-sm">
                            <option value="btv">Biên tập viên</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Thêm</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quyền</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs  {{ $user->role == 'admin' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($user->id !== Auth::id()) <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900">Xóa</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>