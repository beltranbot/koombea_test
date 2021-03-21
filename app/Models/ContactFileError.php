<?php

namespace App\Models;

use App\DTO\ContactFileError as DTOContactFileError;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFileError extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_file_id',
        'field',
        'description',
        'line',
        'error_message',
    ];

    public function registerContactFileError(DTOContactFileError $dtoContactFileError)
    {
        $contactFileError = new ContactFileError($dtoContactFileError->asArray());
        $contactFileError->save();
    }

    public function insertBatch(Array $insertBatch)
    {
        ContactFileError::insert($insertBatch);
    }
}
