<?php

namespace App\Http\Controllers;

use App\DTO\ContactFile;
use App\Http\Requests\ContactPostUploadRequest;
use App\Models\ContactFile as ModelsContactFile;
use App\Models\ContactFileError;
use App\Services\ContactServiceInterface;
use App\Utils\ResponseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function upload(ContactPostUploadRequest $request)
    {
        $contactFile = new ContactFile($request);
        $response = $this->contactService->registerContactFileToQueue($contactFile);
        return response()->json(
            $response->getResponse(),
            $response->getHttpCode()
        );
    }

    public function files()
    {
        $files = ModelsContactFile::where("user_id", Auth::id())->paginate(10);
        return response()->json($files);
    }

    public function errors($contact_file_id)
    {
        $contact_file = ModelsContactFile::where("id", $contact_file_id)->firstOrFail();
        if ($contact_file->user_id != Auth::id()) {
            return response()->json(["message" => "UNAUTHORIZED"], ResponseCode::UNAUTHORIZED);
        }
        $contact_file_errors = ContactFileError::where("contact_file_id", $contact_file_id)->paginate(10);
        return response()->json($contact_file_errors);
    }
}
