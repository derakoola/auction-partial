<?php


namespace App\Http\Middleware\Api\V1;

use App\Helpers\Api\V1\MakeResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class JwtAutoAuthMiddleware extends BaseMiddleware
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
        if (!$token = $this->auth->setRequest($request)->getToken()) {
            return $next($request);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'tokenExpired',
            ]);
            return response()->json($data, $e->getStatusCode());
        } catch (JWTException $e) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'tokenInvalid',
            ]);
            return response()->json($data, $e->getStatusCode());
        }

        if (!$user) {
            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'userNotFound',
            ]);
            return response()->json($data, 404);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}
