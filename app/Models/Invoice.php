<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at']; // This ensures the 'deleted_at' column is cast to a Carbon instance




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

    public function attachments()
    {
        return $this->hasMany(InvoiceAttachment::class);
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }


}
