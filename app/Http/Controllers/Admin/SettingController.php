<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $carouselVideos = json_decode(Setting::get('carousel_videos', '[]'), true);
        
        return view('admin.setting.index', compact('carouselVideos'));
    }
    
    public function update(Request $request)
    {
        // Validate với giới hạn 2MB (2048 KB) theo PHP config hiện tại
        $request->validate([
            'videos.*' => 'nullable|mimes:mp4,webm,mov,avi|max:102400',
            'titles.*' => 'nullable|string|max:255',
            'subtitles.*' => 'nullable|string|max:255',
        ], [
            'videos.*.mimes' => 'Video phải có định dạng: MP4, WEBM, MOV, AVI',
            'videos.*.max' => 'Video không được vượt quá 2MB. Để upload video lớn hơn, vui lòng tăng upload_max_filesize trong php.ini',
        ]); 
    
        $carouselVideos = [];
        $titles = $request->input('titles', []);
        $subtitles = $request->input('subtitles', []);
        $oldVideos = $request->input('old_videos', []);
        
        // Debug logging
        \Log::info('Carousel Update - Titles:', $titles);
        \Log::info('Carousel Update - Old Videos:', $oldVideos);
        \Log::info('Carousel Update - Has Files:', ['count' => count($request->allFiles())]);
        
        foreach($titles as $index => $title){
            // Bỏ qua nếu không có title
            if(empty($title)) {
                continue;
            }
            
            $videoPath = null;

            // Kiểm tra nếu có upload video mới
            if($request->hasFile("videos.{$index}")){
                // Xóa video cũ nếu có
                if(isset($oldVideos[$index]) && !empty($oldVideos[$index])){
                    Storage::disk('public')->delete($oldVideos[$index]);
                }
                // Upload video mới
                $videoPath = $request->file("videos.{$index}")->store('videos', 'public');
            } else {
                // Giữ nguyên video cũ
                $videoPath = $oldVideos[$index] ?? null;
            }

            // Chỉ thêm vào array nếu có video
            if($videoPath) {
                $carouselVideos[] = [
                    'title' => $title,
                    'subtitle' => $subtitles[$index] ?? '',
                    'video_path' => $videoPath,
                ];
            }
        }

        // Lưu vào database
        Setting::set('carousel_videos', json_encode($carouselVideos));

        // Log để debug
        \Log::info('Carousel saved:', ['count' => count($carouselVideos), 'data' => $carouselVideos]);

        return redirect()->back()->with('success', '✅ Cập nhật carousel thành công! Đã lưu ' . count($carouselVideos) . ' video.');
    }
}
