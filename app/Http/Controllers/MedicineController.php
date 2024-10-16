<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function store(Request $request)
    {
        // تحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'form' => 'required|string|max:255',
            'reminder_time' => 'required',
            'description' => 'nullable|string',
        ]);

        // إنشاء السجل الجديد في قاعدة البيانات
        $medicine = Medicine::create([
            'user_id' => auth()->id(), // تأكد من أن المستخدم مسجل دخوله
            'name' => $validated['name'],
            'amount' => $validated['amount'],
            'duration' => $validated['duration'],
            'form' => $validated['form'],
            'reminder_time' => $validated['reminder_time'],
            'description' => $validated['description'],
        ]);

        // إعادة استجابة JSON
        return response()->json([
            'message' => 'تم إضافة التذكير بالدواء بنجاح.',
            'medicine' => $medicine
        ], 201);
    }
}
