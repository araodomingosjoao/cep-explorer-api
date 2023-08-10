<?php

namespace App\Traits;

trait HelperTrait
{
    public function filter($query, $request)
    {
        if ($request->has('cep')) {
            $query->where('postal_code', $request->input('cep'));
        }

        if ($request->has('logradouro')) {
            $query->where('street', 'LIKE', '%' . $request->input('logradouro') . '%');
        }

        $hasMatchingRecords = $query->exists();

        if ($hasMatchingRecords) {
            $perPage = $request->input('per_page', 10);
            return $query->paginate($perPage);
        }

        return collect();
    }
}

