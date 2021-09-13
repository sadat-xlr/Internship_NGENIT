<?php

namespace App\Http\Controllers;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Illuminate\Http\Request;

class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
  public function redirect()
  {
      return Socialite::driver('facebook')->redirect();
  }

  /**
   * Return a callback method from facebook api.
   *
   * @return callback URL from facebook
   */
  public function callback(SocialFacebookAccountService $service)
  {

    try {
      
      $client = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
      return redirect()->to('/client-dashboard');

    } catch (\Throwable $th) {
      return back()->withError($th->getMessage())->withInput();
    }
    
    

    
  }
}
