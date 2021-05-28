<?php

namespace App\Http\Controllers;

use App\DTO\ContactFile;
use App\Http\Requests\ContactFilePostStoreRequest;
use App\Services\ContactFileService;
use App\Utils\DTOs\ContactsFilesIndexDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactFile as ContactFileModel;
use App\Services\ContactService;
use App\Services\ContactServiceInterface;
use App\Utils\ResponseCode;
use Illuminate\Support\Facades\Storage;

class ContactFileController extends Controller
{

    public function __construct(
        ContactFileService $contactFileService,
        ContactServiceInterface $contactService
    ) {
        $this->contactFileService = $contactFileService;
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        $filesIndexDTO = new ContactsFilesIndexDTO(Auth::user()->id, $request);
        $contactFiles = $this->contactFileService->getPaginated($filesIndexDTO);
        return response()->json($contactFiles, 200);
    }

    public function store(ContactFilePostStoreRequest $request)
    {
        $contactFile = new ContactFile($request);
        $response = $this->contactService->registerContactFileToQueue($contactFile);
        return response()->json(
            $response->getResponse(),
            $response->getHttpCode()
        );
    }

    public function errors($contact_file_id)
    {
        $contact_file = ContactFileModel::where("id", $contact_file_id)->firstOrFail();
        if ($contact_file->user_id != Auth::id()) {
            return response()->json(["message" => "UNAUTHORIZED"], ResponseCode::UNAUTHORIZED);
        }
        $contactFileErrors = $this->contactFileErrorRepository->getByContactFileId($contact_file_id);
        return response()->json($contactFileErrors, 200);
    }

    public function show(ContactFileModel $contactFile)
    {
        $file = Storage::disk("s3")->get($contactFile->location);
        $file = explode("\n", $file);
        return $file[1];
    }
}
