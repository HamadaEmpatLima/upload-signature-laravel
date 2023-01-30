<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Repositories\DocumentRepository;
use App\Services\FileService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    private $fileService;

    private $documentRepository;

    public function __construct()
    {
        $this->fileService = new FileService;

        $this->documentRepository = new DocumentRepository;
    }

    public function index()
    {
        $documents = $this->documentRepository->getAll();

        return response()->json([
            'status' => 'success',
            'data'   => $documents
        ]);
    }

    public function find(int $id)
    {
        $document = $this->documentRepository->find($id);

        return response()->json([
            'status' => 'success',
            'data'   => $document
        ]);
    }

    public function store(DocumentRequest $request)
    {
        $formData = $request->all();
        if ($request->hasFile('content')) {
            $formData['content'] = $this->fileService->storeReturnUrl($request->content, 'document', 'document');
        }
        if ($request->hasFile('signin')) {
            $formData['signing'] = $this->fileService->storeReturnUrl($request->signin, 'signin', 'signin');
        }
        if ($request->signin64 && $request->signin == null) {
            $formData['signing'] = $this->fileService->storeReturnUrlBase64($request->signin64, 'signin', 'signin');
        }

        $this->documentRepository->create($formData);

        return response()->json([
            'status' => 'success',
            'message'   => 'Document has been created!',
            'data' => $formData
        ]);
    }

    public function update(DocumentRequest $request, int $id)
    {
        $formData = $request->all();
        $document = $this->documentRepository->find($id);
        if ($request->hasFile('content')) {
            $formData['content'] = $this->fileService->storeReturnUrl($request->content, 'document', 'document');
            if ($document->content) {
                $this->fileService->destroyByUrl($document->content);
            }
        }
        if ($request->hasFile('signin')) {
            $formData['signing'] = $this->fileService->storeReturnUrl($request->signin, 'signin', 'signin');
            if ($document->signing) {
                $this->fileService->destroyByUrl($document->signing);
            }
        }
        if ($request->signin64 && $request->signin == null) {
            $formData['signing'] = $this->fileService->storeReturnUrlBase64($request->signin64, 'signin', 'signin');
            if ($document->signing) {
                $this->fileService->destroyByUrl($document->signing);
            }
        }

        $document = $this->documentRepository->update($formData, $id);
        if (!$document) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Document not found!',
            ]);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Document has been updated!',
            'data'    => $document
        ]);
    }

    public function destroy(int $id)
    {
        $document = $this->documentRepository->find($id);
        if ($document) {
            if ($document->content) {
                $this->fileService->destroyByUrl($document->content);
            }
            if ($document->signing) {
                $this->fileService->destroyByUrl($document->signing);
            }
        }
        $this->documentRepository->delete($id);
        return response()->json([
            'status'  => 'success',
            'message' => 'Document has been deleted!',
        ]);
    }
}
