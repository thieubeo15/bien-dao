<div class="card border-0 shadow-sm mb-4">
    <table class="table table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th class="small">Vùng biển</th>
                <th class="small text-center">Gió</th>
                <th class="small text-center">Sóng</th>
                <th class="small text-center">TT</th>
            </tr>
        </thead>
        <tbody>
            {{-- Giả sử bạn truyền biến $weathers từ Controller --}}
            @foreach($weathers as $w)
            <tr>
                <td class="small fw-bold">{{ $w->location }}</td>
                <td class="small text-center">{{ $w->wind }}</td>
                <td class="small text-center">{{ $w->wave }}m</td>
                <td class="small text-center">
                    <span class="badge {{ $w->status == 'Biển động' ? 'bg-danger' : 'bg-success' }}">
                        {{ $w->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>