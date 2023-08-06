<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlesDatabaseErrors;


class IsAdminMiddleware
{
    use HandlesDatabaseErrors;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new Exception('L\'utilisateur n\'est pas authentifié', 401);
            }

            if (!$user->is_admin) {
                abort(403, "Vous tentez d'accéder à une action d'administration.");
            }

            return $next($request);
        } catch (Exception $e) {
            return HandlesDatabaseErrors::handleDatabaseError($e);
        }
    }
}
