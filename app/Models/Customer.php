<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'family_name', 'phone_number', 'user_id'];

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->family_name}";
    }

    public function ref()
    {
        return '#' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
