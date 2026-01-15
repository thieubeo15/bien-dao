<x-guest-layout>
    <div class="p-8 sm:p-12">
        <div class="text-center mb-10">
            <div class="inline-block p-4 bg-white rounded-full shadow-lg mb-4 transform hover:rotate-6 transition-transform duration-300">
                <img src="{{ asset('images/vodic.gif') }}" class="w-20 h-20" alt="Logo">
            </div>
            <h1 class="text-2xl font-black text-blue-900 tracking-tight uppercase">Hệ Thống Quản Trị</h1>
            <div class="flex justify-center mt-2">
                <div class="h-1.5 w-16 bg-blue-600 rounded-full"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-xs font-black text-blue-800 uppercase mb-2 ml-1">Tài khoản cán bộ</label>
                <div class="relative group">
  
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all duration-300 shadow-sm"
                        placeholder="admin@biendao.vn">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label class="block text-xs font-black text-blue-800 uppercase mb-2 ml-1">Mật mã bảo mật</label>
                <div class="relative group">
                    <input id="password" type="password" name="password" required 
                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all duration-300 shadow-sm"
                        placeholder="••••••••">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mb-8 px-1">
                <label class="flex items-center group cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition cursor-pointer">
                    <span class="ml-2 text-sm text-gray-500 group-hover:text-blue-700 transition font-medium">Lưu phiên làm việc</span>
                </label>
                <a class="text-xs text-blue-600 hover:text-blue-800 font-bold uppercase tracking-tighter" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            </div>

            <button type="submit" class="group relative w-full bg-blue-700 hover:bg-blue-800 text-white font-black py-4 rounded-2xl shadow-xl hover:shadow-blue-200 transition-all duration-300 active:scale-95 overflow-hidden">
                <span class="relative z-10 flex items-center justify-center uppercase tracking-widest">
                    Đăng nhập ngay <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </span>
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="/" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-blue-600 transition-colors">
                <i class="fas fa-long-arrow-alt-left mr-2"></i> Quay lại cổng thông tin
            </a>
        </div>
    </div>
</x-guest-layout>