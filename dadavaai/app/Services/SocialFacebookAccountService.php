<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\Client;
use Session;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            // $client = Client::whereEmail($providerUser->getEmail())->first();
            $client = Client::where('email', $providerUser->getEmail())->first();
            

            if (!$client) {
                $client = new Client;
                $client->clientName =   $providerUser->getName();
                $client->email      =   $providerUser->getEmail();
                $client->password   =   md5(rand(1,10000));
                $client->status     =   true;
                $client->token      =   str_random(40);
                $client->save();
                // $client = Client::create([
                //     'clientName' => $providerUser->getName(),
                //     'email' => $providerUser->getEmail(),
                //     'password' => md5(rand(1,10000)),
                // ]);
            }
            Session::put('CLIENT_ID', $client->id);
            Session::put('CLIENT_Name', $client->clientName);
            Session::put('CLIENT_Email', $client->email);

            
            $account->client()->associate($client);
            $account->save();

            return $client;
        }
    }
}