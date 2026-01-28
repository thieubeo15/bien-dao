<div class="sidebar">
    <div class="section-title mb-3">
        <h3 class="bg-primary text-white p-2 fs-6 uppercase mb-0"><i class="fas fa-bell me-2"></i> Thông báo</h3>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="list-group list-group-flush">
            @if(isset($documents) && $documents->count() > 0)
                @foreach($documents as $doc)
                    <div class="list-group-item p-3 border-bottom border-dashed">
                        <small class="text-muted d-block mb-1">{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</small>
                        <a href="{{ $doc->link ?? '#' }}" class="text-decoration-none text-dark fw-bold small">
                            @if($doc->is_new) <span class="badge bg-danger me-1">MỚI</span> @endif
                            {{ $doc->title }}
                        </a>
                    </div>
                @endforeach
            @else
                <div class="p-3 text-center text-muted">Không có thông báo mới</div>
            @endif
        </div>
    </div>
      {{-- Bản đồ Windy --}}
<div class="section-title mt-4 mb-3">
    <h3 class="bg-primary text-white p-2 fs-6 uppercase mb-0"><i class="fas fa-wind me-2"></i> Bản đồ Sóng & Gió</h3>
</div>
<div class="card border-0 shadow-sm overflow-hidden mb-4">
    <div class="ratio ratio-4x3">
        <iframe 
            src="https://embed.windy.com/embed2.html?lat=16.000&lon=110.000&zoom=5&overlay=waves" 
            style="border: none; width: 100%; height: 100%;">
        </iframe>
    </div>
</div>

    <div class="section-title mb-3">
        <h3 class="bg-primary text-white p-2 fs-6 uppercase mb-0"><i class="fas fa-camera me-2"></i> Hình ảnh - Video</h3>
    </div>
    <div class="card border-0 shadow-sm overflow-hidden mb-4">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/36BZOR9ypMk" title="Video Biển đảo" allowfullscreen></iframe>
        </div>
        <img src="{{ asset('images/ban-do.webp') }}" class="img-fluid mt-2" alt="Bản đồ Việt Nam">
        <div class="p-2 text-center bg-light"><small class="text-muted">Bản đồ Việt Nam</small></div>
    </div>
</div>