<?php

namespace App\Models;

use App\DTO\Contact as DTOContact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'date_of_birth',
        'phone',
        'address',
        'cc_number',
        'cc_length',
        'cc_last_four_digits',
        'brand',
        'email',
    ];
    protected $hidden = [
        "cc_number"
    ];

    public function registerContact(DTOContact $dtoContact)
    {
        $contact = new Contact($dtoContact->asArray());
        $contact->save();
    }
}
