<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'invoice_lines';

    protected $fillable = [
        'invoice_id',
        'track_id',
        'unit_price',
        'quantity',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
