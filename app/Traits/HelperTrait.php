<?php

namespace App\Traits;

trait HelperTrait
{
    public function filter($query, $request)
    {
        if ($request->has('cep')) {
            $query->where('cep', $request->input('cep'));
        }

        if ($request->has('neighborhood')) {
            $query->where('neighborhood', $request->input('neighborhood'));
        }

        $hasMatchingRecords = $query->exists();

        if ($hasMatchingRecords) {
            $perPage = $request->input('per_page', 10);
            return $query->paginate($perPage);
        }

        return collect();
    }
}

