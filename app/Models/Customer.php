<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'fax',
        'email',
        'support_rep_id',
    ];

    public function supportRep()
    {
        return $this->belongsTo(Employee::class, 'support_rep_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
