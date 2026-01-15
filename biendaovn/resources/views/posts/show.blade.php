<x-guest-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] p-8 md:p-12">
                
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 mb-8 transition">
                    <i class="fas fa-arrow-left mr-2"></i> QUAY LẠI TRANG CHỦ
                </a>

                <h1 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight mb-4">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center space-x-4 mb-8 pb-8 border-b border-gray-100">
                    <img src="https://ui-avatars.com/api/?name={{ $post->user->name ?? 'Admin' }}&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ $post->user->name ?? 'Ban Biên Tập' }}</p>
                        <p class="text-xs text-slate-400 uppercase tracking-widest">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                @if($post->image)
                    <div class="mb-10">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-auto rounded-[1.5rem] shadow-lg" alt="{{ $post->title }}">
                    </div>
                @endif

                <div class="text-xl font-semibold text-slate-600 italic mb-8 leading-relaxed border-l-4 border-blue-500 pl-6">
                    {{ $post->summary }}
                </div>

                <div class="prose prose-blue max-w-none text-slate-700 leading-7 text-lg">
                    {!! nl2br(e($post->content)) !!}
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>