<?php

namespace App\Http\Controllers;

use App\DTO\ContactFile;
use App\Http\Requests\ContactPostUploadRequest;
use App\Models\ContactFile as ContactFileModel;
use App\Models\ContactFileError;
use App\Services\contactFileService;
use App\Services\ContactServiceInterface;
use App\Utils\DTOs\ContactIndexDTO;
use App\Utils\DTOs\ContactsFilesIndexDTO;
use App\Utils\ResponseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function __construct(
        ContactServiceInterface $contactService,
        contactFileService $contactFileService
    ) {
        $this->contactService = $contactService;
        $this->contactFileService = $contactFileService;
    }

    public function index(Request $request)
    {
        $contactsIndexDTO = new ContactIndexDTO(Auth::user()->id, $request);
        $contacts = $this->contactService->getPaginated($contactsIndexDTO);
        return response()->json($contacts, 200);
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

    public function files(Request $request)
    {
        $filesIndexDTO = new ContactsFilesIndexDTO(Auth::user()->id, $request);
        $contactFiles = $this->contactFileService->getPaginated($filesIndexDTO);
        return response()->json($contactFiles, 200);
    }

    public function errors($contact_file_id)
    {
        $contact_file = ContactFileModel::where("id", $contact_file_id)->firstOrFail();
        if ($contact_file->user_id != Auth::id()) {
            return response()->json(["message" => "UNAUTHORIZED"], ResponseCode::UNAUTHORIZED);
        }
        $contact_file_errors = ContactFileError::where("contact_file_id", $contact_file_id)->paginate(10);
        return response()->json($contact_file_errors);
    }

    public function show(ContactFileModel $contactFile)
    {
        $file = Storage::disk("s3")->get($contactFile->location);
        $file = explode("\n", $file);
        return $file[1];
    }
}
