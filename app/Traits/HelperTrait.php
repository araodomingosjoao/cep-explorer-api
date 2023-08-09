<?php

namespace App\Traits;

use Carbon\Carbon;

trait HelperTrait
{
    public function filter($data, $request) {
        $filter = $request->filter;
        
        if ($filter){
            $filter = is_string($filter)? json_decode($request->filter) : (object) $filter;
            if (isset($filter->from) && isset($filter->to)){
                $data = $data->whereBetween('created_at', [ Carbon::parse($filter->from)->startOfDay(), Carbon::parse($filter->to)->endOfDay()]);
            }
            if (isset($filter->search)){
                $data = $data->where('posta_code', 'like', '%' . $filter->search . '%');
            }
        }

        if ($request->sort && $request->sort_by){
            $data = $data->orderBy($request->sort_by, $request->sort);
        }

        return $data->orderBy('created_at')->get();
    }
}

