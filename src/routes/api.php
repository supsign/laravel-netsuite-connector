<?php

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Supsign\NetsuiteConnector\Models\NetSuiteCall;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::post('api/auth/token', function (Request $request): array {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        $loginAttemptResult = $this->guard()->attempt($request->only('email', 'password'));

        if (!$loginAttemptResult) {
            abort(401);
        }

        $token = $request->user()->createToken('auto');

        return ['token' => $token->plainTextToken];
    })->name('api.auth.loginForToken');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('api/tokens/create', function (Request $request): array {
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    });

    Route::post('api/netsuite', function (Request $request): Response {
        $call = NetSuiteCall::create(['body' => $request->getContent()]);

        if (!$request->input()) {
            abort(400);
        }

        if ($request->timestamp) {
            $call->remote_timestamp = Carbon::createFromTimestamp((int)($request->timestamp / 1000));
        }

        $call->method = $request->action;
        $call->entity_name = $request->entityName;
        $call->entity_content = $request->entity;
        $call->save();

        return response()->noContent(201);
    })->name('api.netsuite.post');

    Route::get('api/netsuite/unparsed', fn (): JsonResponse => response()->json((object)[
        'count' => NetSuiteCall::where('is_parsed', 0)->count()
    ]))->name('api.netsuite.getUnparsed');
});