<?php

namespace App\Utility;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthHelper
{
    public static function getAllRuleByGroup(int $group) : string {
        $access_ids = DB::table('auth_accesses')
            ->where('group', $group)
            ->pluck('id')
            ->toArray();

        return AuthHelper::getAccessIdsAsString($access_ids);
    }


    public static function getAccessIdsAsString(array $access_ids):string{
        return implode( ':',$access_ids);
    }

    public static function getUser(){
        $user_id = Auth::id();

        if(env('CACHING')){
            $user_cache_key = 'user_' . $user_id;
            $roles_cache_key = 'user_roles_' . $user_id;
    
            if (!cache()->has($user_cache_key)) {
               $user = Auth::user();
               cache()->put($user_cache_key, $user, 60 * 60);
            }
    
            if (!cache()->has($roles_cache_key)) {
                $roles = DB::table('auth_permissions')->where('user_id', $user_id)->pluck('access_id')->toArray();
                cache()->put($roles_cache_key, $roles, 60 * 60);
             }
    
            return[
                'user' =>  cache()->get($user_cache_key),
                'roles' =>  cache()->get($roles_cache_key),
            ];
        }else{
            return[
                'user' =>  Auth::user(),
                'roles' => DB::table('auth_permissions')->where('user_id', $user_id)->pluck('access_id')->toArray(),
            ];
        } 
    }

    public static function checkAuthAccess($access_ids) {
        if(is_array($access_ids))
            $access_ids = implode(',', $access_ids);

        return "CheckAuthAccess:$access_ids";
    }
    
}
