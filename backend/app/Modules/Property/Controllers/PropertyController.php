<?php

namespace App\Modules\Property\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Property\Repositories\PropertyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    protected PropertyRepository $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json($this->repository->search($request->all()));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|string',
            'city' => 'required|string',
            'price_per_month' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $data['owner_id'] = auth('api')->id();

        return response()->json($this->repository->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->repository->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($id, $request->all());
        return response()->json($this->repository->find($id));
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(null, 204);
    }
}
