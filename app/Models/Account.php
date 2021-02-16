<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function getCreatedAtAttribute($value)
    {
        return carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return carbon::parse($value)->format('d-m-Y');
    }

    public function expense()
    {
        return $this->hasOne(Expense::class);
    }
}
