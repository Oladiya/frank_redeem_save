<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'address',
        'phone',
        'service_id',
        'other_service',
        'date',
        'payment_method',
        'status',
        'cancel_reason',
        'user_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts()
    {
        return [
            'date' => 'datetime',
        ];
    }

    public static function getPaymentMethodOptions(): array
    {
        return [
            ['name' => 'наличные', 'value' => 'cash'],
            ['name' => 'банковская карта', 'value' => 'bank card'],
        ];
    }

    public static function getStatusOptions(): array
    {
        return [
            ['name' => 'новая заявка', 'value' => 'new'],
            ['name' => 'в работе', 'value' => 'in work'],
            ['name' => 'выполнено', 'value' => 'completed'],
            ['name' => 'отменено', 'value' => 'cancelled'],
        ];
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $this->formatPhone($value),
            get: fn($value) => $value
        );
    }

    private function formatPhone(string $value): string
    {
        $digits = preg_replace('/\D+/', '', $value);
        if (strlen($digits) === 10) {
            $digits = '7' . $digits;
        }

        return sprintf(
            '+7(%s)-%s-%s-%s',
            substr($digits, 1, 3),
            substr($digits, 4, 3),
            substr($digits, 7, 2),
            substr($digits, 9, 2),
        );
    }
}
