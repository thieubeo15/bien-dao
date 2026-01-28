<x-guest-layout>
    <div class="p-8 sm:p-12">
        <div class="text-center mb-10">
            <div class="inline-block p-4 bg-white rounded-full shadow-lg mb-4">
                <img src="{{ asset('images/vodic.gif') }}" class="w-20 h-20" alt="Logo">
            </div>
            <h1 class="text-2xl font-black text-blue-900 uppercase">Đăng nhập hệ thống</h1>
            <div class="flex justify-center mt-2">
                <div class="h-1.5 w-16 bg-blue-600 rounded-full"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- EMAIL --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-blue-800 uppercase mb-2 ml-1">
                    Tài khoản
                </label>

                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full pl-4 pr-10 py-3.5 border-2 rounded-2xl outline-none transition shadow-sm
                        {{ $errors->has('email')
                            ? 'border-red-500 bg-red-50 focus:ring-4 focus:ring-red-100'
                            : 'bg-gray-50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500' }}"
                        placeholder="admin@biendao.vn">

                    {{-- ICON ! --}}
                </div>

                @error('email')
                    <p class="text-red-600 text-xs mt-2 ml-1 font-bold">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-blue-800 uppercase mb-2 ml-1">
                    Mật khẩu
                </label>

                <div class="relative">
                    <input type="password" name="password"
                        class="w-full pl-4 pr-10 py-3.5 border-2 rounded-2xl outline-none transition shadow-sm
                        {{ $errors->has('password')
                            ? 'border-red-500 bg-red-50 focus:ring-4 focus:ring-red-100'
                            : 'bg-gray-50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500' }}"
                        placeholder="••••••••">

                    {{-- ICON ! --}}
                </div>

                @error('password')
                    <p class="text-red-600 text-xs mt-2 ml-1 font-bold">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- REMEMBER --}}
            <div class="flex items-center justify-between mb-8 px-1">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-500 font-medium">
                        Lưu phiên làm việc
                    </span>
                </label>

                <a href="{{ route('password.request') }}"
                    class="text-xs text-blue-600 font-bold uppercase">
                    Quên mật khẩu?
                </a>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-black py-4 rounded-2xl shadow-xl transition uppercase tracking-widest">
                Đăng nhập ngay
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600">
                <i class="fas fa-arrow-left"></i> Quay lại trang chủ
            </a>
        </div>
    </div>
</x-guest-layout>
