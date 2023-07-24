<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function buku()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class, 'pinjam_id');
    }
}
