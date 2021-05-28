<?php

namespace App\Http\Controllers;

use App\Repositories\ContactFileErrorRepository;
use App\Services\contactFileService;
use App\Services\ContactServiceInterface;
use App\Utils\DTOs\ContactIndexDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(
        ContactServiceInterface $contactService,
        contactFileService $contactFileService,
        ContactFileErrorRepository $contactFileErrorRepository
    ) {
        $this->contactService = $contactService;
        $this->contactFileService = $contactFileService;
        $this->contactFileErrorRepository = $contactFileErrorRepository;
    }

    public function index(Request $request)
    {
        $contactsIndexDTO = new ContactIndexDTO(Auth::user()->id, $request);
        $contacts = $this->contactService->getPaginated($contactsIndexDTO);
        return response()->json($contacts, 200);
    }
}
