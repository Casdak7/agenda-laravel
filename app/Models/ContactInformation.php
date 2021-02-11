<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $fillable = ["information", "contact_id", "information_type_id"];

    public function contact()
    {
        return $this->belongsTo(Contact::class, "contact_id");
    }

    public function informationType()
    {
        return $this->belongsTo(InformationType::class, "information_type_id");
    }
}
