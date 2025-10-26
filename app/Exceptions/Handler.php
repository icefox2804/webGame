<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Xử lý lỗi file upload quá lớn
        if ($exception instanceof PostTooLargeException) {
            return back()->withErrors([
                'error' => '❌ File upload quá lớn! Vui lòng kiểm tra:
                
• Giới hạn upload hiện tại: upload_max_filesize = 2M, post_max_size = 8M
• Video bạn đang upload có thể vượt quá giới hạn này
                
📝 Cách khắc phục:
1. Mở file php.ini tại: E:\phanmem\HocTap_FullDemo\PHP\LyThuyet\php-8.2.29-Win32-vs16-x64\php.ini
2. Sửa các dòng:
   - upload_max_filesize = 50M
   - post_max_size = 100M
3. Khởi động lại server (Ctrl+C và chạy lại: php artisan serve)
4. Hoặc nén video xuống nhỏ hơn 2MB'
            ])->withInput();
        }

        return parent::render($request, $exception);
    }
}
