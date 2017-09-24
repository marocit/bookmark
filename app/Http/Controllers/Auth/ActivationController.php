<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function activate(Request $request)
    {
      // $user = User::where('email', $request->email)->where('activation_token', $request->token)->firstOrFail();
      $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();

      $user->update([
        'active' => true,
        'activation_token' => null
      ]);

      Auth::loginUsingId($user->id);

      return redirect()->route('bookmark')
              ->with('success', 'Your account is active');
    }
}
