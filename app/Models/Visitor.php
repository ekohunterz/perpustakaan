<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getMonthlyData()
    {
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        $data = static::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $values = [];

        // Inisialisasi nilai awal untuk setiap bulan
        foreach ($months as $index => $month) {
            $labels[] = $month;
            $values[] = 0;
        }

        // Mengisi nilai sesuai dengan data yang ada
        foreach ($data as $item) {
            $monthIndex = $item->month - 1;
            $values[$monthIndex] = $item->total;
        }
        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id');
    }
}
