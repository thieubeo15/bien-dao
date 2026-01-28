<?php
namespace App\Http\Controllers;

use App\Models\SeaWeather;
use Illuminate\Http\Request;

class SeaWeatherController extends Controller
{
    /**
     * Lưu bản tin hải văn mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'location' => 'required|string|max:255',
            'temp'     => 'required|numeric',
            'wind'     => 'required|string',
            'wave'     => 'required|numeric',
            'status'   => 'required|string',
        ], [
            // Thông báo lỗi bằng tiếng Việt cho dự án biển đảo
            'location.required' => 'Vui lòng nhập tên vùng biển (vị trí).',
            'temp.required'     => 'Nhiệt độ nước biển không được để trống.',
            'wind.required'     => 'Vui lòng nhập cấp gió.',
            'wave.required'     => 'Độ cao sóng biển là bắt buộc.',
            'status.required'   => 'Vui lòng chọn trạng thái biển hiện tại.',
        ]);

        // 2. Tạo bản ghi mới trong bảng sea_weathers
        SeaWeather::create([
            'location' => $request->location,
            'temp'     => $request->temp,
            'wind'     => $request->wind,
            'wave'     => $request->wave,
            'status'   => $request->status,
        ]);

        // 3. Chuyển hướng về danh sách bản tin và hiện thông báo
       return redirect()->route('admin.sea-weather.index')
                 ->with('success', 'Đã cập nhật bản tin hải văn mới thành công!');
    }
}