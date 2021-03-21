<?php

namespace App\Models;

use App\DTO\ContactFileEntry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'contact_file_status_id',
        'location',
        'filename',
    ];

    public function register(ContactFileEntry $contactFileEntry)
    {
        $contactFile = new ContactFile($contactFileEntry->asArray());
        $contactFile->save();
        return $contactFile;
    }
}
