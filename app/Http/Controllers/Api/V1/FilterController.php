<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerGroupResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\DriverResource;
use App\Http\Resources\DriverTypeResource;
use App\Http\Resources\NoteResource;
use App\Http\Resources\SegmentResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WarehouseResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FilterController extends Controller
{
    public function __invoke($model, Request $request): JsonResponse
    {
        $model = app( 'App\\Models\\' . $model);
        $request = $request->merge(['scope' => 'micro', 'withoutRelation' => true]);
        $only = (array) $request->only;
        $except = (array) $request->except;
        $modelFilters = $model->getFilterModels();
        if (!empty($only)){
            $modelFilters = array_intersect($modelFilters, $only);
        }elseif (!empty($except)){
            $modelFilters = array_diff($modelFilters, $except);
        }
        $data = [];
        $filters = $request->all();
        foreach($modelFilters as $modelFilter)
        {
            $modelRepo = app( 'App\\Repositories\\Contracts\\' . $modelFilter .'Contract');
            if ($modelFilter == 'Segment')
            {
                $childModelRepo = app( 'App\\Repositories\\Contracts\\' . $modelFilter .'Contract');
                $data = array_merge($data, ['subSegments' => $this->getResource($modelFilter, $childModelRepo->searchBySelected(null, [], array_merge(['isChild' => true], $request->except('isParent'))))]);
            }
            $data = array_merge($data, [lcfirst($modelFilter).'s' => $this->getResource($modelFilter, $modelRepo->searchBySelected(null, [], $filters))]);

        }
        return response()->json($data);
    }


    public function getResource($model, $data): AnonymousResourceCollection
    {
         return match ($model){
             'Warehouse' => WarehouseResource::collection($data),
             'Segment' => SegmentResource::collection($data),
             'Note' => NoteResource::collection($data),
             'Driver' => DriverResource::collection($data),
             'Customer' => CustomerResource::collection($data),
             'DriverType' => DriverTypeResource::collection($data),
             'CustomerGroup' => CustomerGroupResource::collection($data),
             'User' => UserResource::collection($data)
         };
    }
}
