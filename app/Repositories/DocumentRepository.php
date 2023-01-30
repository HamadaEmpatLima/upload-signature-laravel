<?php

namespace App\Repositories;

use App\Models\Document;

class DocumentRepository
{
    public function getAll()
    {
        return Document::latest()->get();
    }

    public function find(int $id)
    {
        return Document::find($id);
    }

    public function create(array $formData)
    {
        return Document::create($formData);
    }

    public function update(array $formData, int $id)
    {
        $document = $this->find($id);
        if ($document) {
            $document->update($formData);
            $document->save();
        }
        return $document;
    }

    public function delete(int $id)
    {
        return Document::whereId($id)->delete();
    }
}
