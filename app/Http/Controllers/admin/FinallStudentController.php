<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\FinalExamResult;
use App\Models\VoucherCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FinallStudentController extends Controller
{
    public function AllFinallStudent()
    {
        $users = User::where('role', 'user')->get();
        $category = Category::all();
        return view('admin.backend.allfinallstudent.allfinallstudent', compact('users','category'));
    }


    public function createVoucher(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'category_id' => 'required',
    ]);

    $code = strtoupper(Str::random(10)); // generate voucher

    VoucherCode::create([
        'code' => $code,
        'user_id' => $request->user_id,
        'category_id' => $request->category_id,
        'is_used' => false,
    ]);

    return back()->with('success', 'Voucher generated successfully!');
}


    // ------------------------------
    // Generate Voucher for the user
    // ------------------------------
    public function GenerateVoucher($user_id)
    {
        $voucher = Str::upper(Str::random(10)); // EX: K8HD92LQXZ

        VoucherCode::create([
            'code' => $voucher,
            'user_id' => $user_id,
            'category_id' => null,   // you can change this to exam id
            'expired_at' => now()->addHours(2),
        ]);

        return back()->with('success', 'Voucher Generated Successfully: ' . $voucher);
    }

    // ------------------------------
    // Show all vouchers for a user
    // ------------------------------
    public function ShowVoucher($user_id)
    {
        $vouchers = VoucherCode::where('user_id', $user_id)->get();
        $user = User::find($user_id);

        return view('admin.backend.allfinallstudent.showvoucher', compact('vouchers', 'user'));
    }

     public function sendVoucher(VoucherCode $voucher)
    {
        $user = $voucher->user;

        if (!$user->phone) {
            return redirect()->back()->with('error', 'User has no phone number!');
        }

        $message = "Hello {$user->name}, your voucher code is: {$voucher->code}";

        $this->sendWhatsAppMessage($user->phone, $message);

        return redirect()->back()->with('success', "Voucher sent to {$user->name} successfully!");
    }

    private function sendWhatsAppMessage($toNumber, $message)
    {
        $instanceId = "instance146985";  // your instance ID
        $token = "6pjzvrba0p6stssf";     // your token

        Http::post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
            'token' => $token,
            'to' => $toNumber,
            'body' => $message,
            'priority' => 'high',
        ]);
    }

    // All Passed Students
    public function AllPassedStudents() {
        $passed = FinalExamResult::with(['user', 'category'])->get();
        return view('admin.backend.passed_students.index', compact('passed'));
    }


}
