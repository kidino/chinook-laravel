<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'reports_to',
        'birth_date',
        'hire_date',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone',
        'fax',
        'email',
    ];

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'reports_to');
    }

    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'reports_to');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'support_rep_id');
    }

    public function getFormattedHireDateAttribute()
    {
        return $this->hire_date ? \Carbon\Carbon::parse($this->hire_date)->format('Y-m-d') : null;
    }

    public function getFormattedBirthDateAttribute()
    {
        return $this->birth_date ? \Carbon\Carbon::parse($this->birth_date)->format('Y-m-d') : null;
    }
}
