<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationType extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function contactInformations()
    {
        return $this->hasMany(ContactInformation::class, "information_type_id");
    }
}
