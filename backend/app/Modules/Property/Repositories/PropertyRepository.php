<?php

namespace App\Modules\Property\Repositories;

use App\Models\Property;
use App\Modules\Core\Repositories\BaseRepository;

class PropertyRepository extends BaseRepository
{
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    public function search(array $filters)
    {
        $query = $this->model->newQuery();

        if (isset($filters['city'])) {
            $query->where('city', $filters['city']);
        }

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->paginate($filters['per_page'] ?? 15);
    }
}
