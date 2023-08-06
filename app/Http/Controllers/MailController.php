<?php

namespace App\Http\Controllers;

use App\Mail\BetEmail;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PdfController;
use Carbon\Carbon;
use DB;

class MailController extends Controller
{
    private $theme;
    private $user;
    private $pdfController;

    public function __construct(Theme $theme, User $user)
    {
        $this->theme = $theme;
        $this->user = $user;
        $this->pdfController = new PdfController();
    }

    public function sendEmail()
    {
        try {
            $users = $this->user->all();

            // Gửi email qua theme được kích hoạt
            $themeActive = $this->theme->where('status', 1)->first();
            if (!$themeActive) {
                $themeActive = $this->theme->first();
            }

            $themeData = config('content.theme');
            $themeName = null;
            switch (strtolower($themeActive->theme)) {
                case strtolower($themeData['theme_1']):
                    $themeName = $themeData['theme_1'];
                    break;
                case strtolower($themeData['theme_2']):
                    $themeName = $themeData['theme_2'];
                    break;
                case strtolower($themeData['theme_3']):
                    $themeName = $themeData['theme_3'];
                    break;
                default:
                    $themeName = $themeData['theme_1'];
                    break;
            };

            $data['themeName'] = 'mail.theme.' . $themeName;

            foreach ($users as $user) {
                if ($user->is_admin == 1) {
                    $data['color'] = '#4DE3F3';
                } else {
                    $data['color'] = '#F7BEE5';
                }

                $data['file'] = $this->pdfController->generatePDF($user);

                $mailable = new BetEmail($user, $data);

                // Preview email trước khi bấm nút gửi
                // return $mailable;

                Mail::to($user)->send($mailable);
            };
            return [
                'message' => 'Send Email Success',
                'status' => true,
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'controller' => 'MailController',
                'message' => $e->getMessage(),
                'time' => Carbon::now()->format('d/m/Y H:i')
            ];
        }
    }

    public function theme()
    {
        $themes = config('content.theme');
        $status = config('content.status');
        return view('mail.theme', compact('themes', 'status'));
    }

    public function activeTheme(Request $request)
    {
        $rules = [
            'theme' => 'required',
            'status' => 'required'
        ];

        $message = [
            'theme.required' => 'Vui lòng chọn theme',
            'status.required' => 'Vui lòng chọn status',
        ];

        $request->validate($rules, $message);
        try {
            DB::beginTransaction();
            // Kiểm tra xem cột theme này đã tồn tại trong db chưa. Nếu tồn tại thì chỉ đi cập nhật cột status và cột notes,
            // ngược lại nếu chưa tồn tại thì đi tạo mới cột theme, status và cột notes
            $data = $this->theme->updateOrCreate(
                ['theme' => $request->theme],
                [
                    'status' => (bool)$request->status,
                    'notes' => $request->notes
                ]
            );
            if ($data->wasRecentlyCreated) {
                $message = 'Created ' . $request->theme . ' Success';
            } else {
                $message = 'Updated ' . $request->theme  . ' Success';
            }
            DB::commit();
            return redirect()->route('mail.theme')->with('success', $message);
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
}
