<?php

namespace App\Models;

use App\Traits\ModelTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends \Spatie\Permission\Models\Role
{
    use ModelTrait, SearchTrait;

    public const DEFAULT_ROLE_SUPER_ADMIN = 'Super Admin';
    public const DEFAULT_ROLE_EMPLOYEE = 'Employee';

    public const DEFAULT_ROLE = [
        self::DEFAULT_ROLE_SUPER_ADMIN,
        self::DEFAULT_ROLE_EMPLOYEE,
    ];

    const FIXED_ROLE_ADMIN = 1;
    const FIXED_ROLE_EMPLOYEE = 2;
    const FIXED_ROLE = [
        self::FIXED_ROLE_ADMIN,
        self::FIXED_ROLE_EMPLOYEE
    ];

    public const ADDITIONAL_PERMISSIONS = [];

    protected array $filters = [
        'keyword',
        'type'
    ];
    protected array $searchable = ['name'];

    protected $casts = ['status' => 'boolean'];
    public array $definedRelations = ['users'];

    protected $fillable = [
        'name', 'guard_name', 'status',
    ];
    public function scopeOfType($query, $type = null)
    {
        if (($type == 'new') || $type == 'exist') {
            $query = $query->whereNotIn('id', [self::FIXED_ROLE_EMPLOYEE]);
        }
        return $query;
    }
}
