<?php

namespace App\Modules\Vehicle\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Repositories\VehicleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    protected VehicleRepository $repository;

    public function __construct(VehicleRepository $repository)
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
            'make' => 'required|string',
            'model' => 'required|string',
            'type' => 'required|string',
            'registration_number' => 'required|string|unique:vehicles',
            'price_per_day' => 'required|numeric',
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
