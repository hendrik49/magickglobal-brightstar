<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration',
        'max_users',
        'max_customers',
        'max_venders',
        'max_clients',
        'trial',
        'trial_days',
        'description',
        'image',
        'crm',
        'hrm',
        'account',
        'project',
        'pos',
        'chatgpt',
        'koperasi',
        'storage_limit',
    ];

    private static $getplans = NULL;

    public static $arrDuration = [
        'lifetime' => 'Lifetime',
        'month' => 'Per Month',
        'year' => 'Per Year',
    ];

    public function status()
    {
        return [
            __('lifetime'),
            __('Per Month'),
            __('Per Year'),
        ];
    }

    public static function total_plan()
    {
        return Plan::count();
    }

    public static function most_purchese_plan()
    {
        $free_plan = Plan::where('price', '<=', 0)->first()->id;
        $plan =  User::select(DB::raw('count(*) as total') , 'plan')->where('type', '=', 'company')->where('plan', '!=', $free_plan)->groupBy('plan')->first();

        return $plan;
    }

    public static function getPlan($id)
    {
        if(self::$getplans == null)
        {
            $plan = Plan::find($id);
            self::$getplans = $plan;
        }

        return self::$getplans;
    }
    
    public function getModuleFlags()
    {
        $columns = Schema::getColumnListing($this->getTable());
        $moduleAttributes = [];
        
        // Find positions of our boundary columns
        $storagePos = array_search('storage_limit', $columns);
        $descriptionPos = array_search('description', $columns);
        
        if ($storagePos !== false && $descriptionPos !== false) {
            // Get all columns between storage_limit and description
            foreach ($columns as $index => $column) {
                if ($index > $storagePos && $index < $descriptionPos) {
                    $moduleAttributes[$column] = $this->attributes[$column] ?? null;
                }
            }
        }
        
        return $moduleAttributes;
    }
}
