<?php
namespace App\Http\Controllers\Api; use App\Http\Controllers\Controller; use App\Models\ContactMessage; use Illuminate\Http\Request; use Illuminate\Support\Facades\Log; use Illuminate\Support\Facades\Mail;
class ContactMessageController extends Controller {
    public function store(Request $r){
        $msg = ContactMessage::create($r->validate([
            'name'=>'required|max:60',
            'house_no'=>'nullable|max:40',
            'phone'=>'required|max:20',
            'email'=>'nullable|email|max:80',
            'message'=>'required|max:1000',
        ]));
        $recipients = array_filter(array_map('trim', explode(',', (string) env('COMMITTEE_NOTIFY_EMAIL'))));
        if($recipients){
            try{
                Mail::raw("SBMN Contact form message\n\nName: {$msg->name}\nPlot: {$msg->house_no}\nPhone: {$msg->phone}\nEmail: {$msg->email}\n\n{$msg->message}", function($m) use ($recipients, $msg){
                    $m->to($recipients)->subject('SBMN contact form message from '.$msg->name);
                });
            }catch(\Throwable $e){
                Log::warning('Failed to email contact message notification: '.$e->getMessage());
            }
        }
        return response()->json($msg, 201);
    }
}
