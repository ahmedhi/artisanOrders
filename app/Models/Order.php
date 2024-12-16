<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'customer_id'];

    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_SHIPPED = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_CANCELLED = 4;

    // Add order Ref #0001

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function getOrderAmountAttribute()
    {
        return $this->orderProducts->sum(function ($orderProduct) {
            return $orderProduct->product->price * $orderProduct->quantity;
        });
    }

    public function name()
    {
        return '#' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function getStatus()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_CONFIRMED:
                return 'Confirmed';
            case self::STATUS_SHIPPED:
                return 'Shipped';
            case self::STATUS_DELIVERED:
                return 'Delivered';
            case self::STATUS_CANCELLED:
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
