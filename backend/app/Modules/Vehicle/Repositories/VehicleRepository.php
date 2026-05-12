<?php

namespace App\Modules\Vehicle\Repositories;

use App\Models\Vehicle;
use App\Modules\Core\Repositories\BaseRepository;

class VehicleRepository extends BaseRepository
{
    public function __construct(Vehicle $model)
    {
        parent::__construct($model);
    }

    public function search(array $filters)
    {
        $query = $this->model->newQuery();

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->paginate($filters['per_page'] ?? 15);
    }
}
