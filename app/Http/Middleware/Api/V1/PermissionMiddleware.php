<?php


namespace App\Http\Middleware\Api\V1;

use App\Helpers\Api\V1\MakeResponse;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class PermissionMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // trim the permission key
        $permission = str_replace('/', '.', explode('api/v1/', $request->url())[1]);

        // get user's permission
        $permissions = (array)$request->user()->_permissions;

        // check the permission
        if (in_array($permission, $permissions, true)) {
            return $next($request);

        }

        // check all permission
        $permission = str_replace('/', '.', explode('api/v1/', $request->url())[1]);
        $permission = explode('.', $permission);
        foreach ($permission as $key => $item) {
            if (strlen($item) > 23) {
                $permission[$key] = '*';
            }
        }
        $permission = implode('.', $permission);

        // $request->user()->push('_permissions', $permission, true);

        // check the permission
        if (!in_array($permission, $permissions, true)) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'accessDenied',
            ]);
            return response()->json($data, 401);
        }

        return $next($request);
    }
}
