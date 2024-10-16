<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    // تأكد من أن لديك جدول بالاسم الصحيح في قاعدة البيانات
    // protected $table = 'medicines'; // استخدم هذا إذا كان اسم الجدول غير قياسي

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'duration',
        'form',
        'reminder_time',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // إذا كنت ترغب في إضافة أي علاقات أخرى أو طرق أخرى يمكن استخدامها في API
    // يمكنك إضافتها هنا
}
