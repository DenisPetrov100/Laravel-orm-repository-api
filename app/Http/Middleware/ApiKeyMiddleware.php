<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class ApiKeyMiddleware
{
  public function handle($request, Closure $next)
  {
    if(!$key = $request->get('apikey') or $key !== config('app.api_key')){
      throw new AuthenticationException('Wrong api key');
    }
    return $next($request);
  }
}
