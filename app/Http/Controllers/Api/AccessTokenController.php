<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Captain;
use App\Models\Vehical;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Response;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class AccessTokenController extends ATC
{
    public function issueToken(ServerRequestInterface $request)
    {
        try {
            //get username (default is :email)
            $params = $request->getParsedBody();

            extract($params);

            if ($grant_type == 'password') {

                $user = User::where(['username' => $username ])->first();

                $hasProfile = true;

                if(is_null($user)){

                    $user = User::create([
                        'name' => 'user',
                        'email' => $username,
                        'password' => Hash::make($password),
                        'username' => $username,
                        'locked' => false,
                        'verified' => false
                    ]);
                    
                    $hasProfile = false;
                }


                //generate token
                $tokenResponse = parent::issueToken($request);

                //convert response to json string
                $content = $tokenResponse->getContent();

                //convert json to array
                $data = json_decode($content, true);

                if(isset($data["error"]))
                    throw new OAuthServerException('The user credentials were incorrect.', 6, 'invalid_credentials', 401);

                //add access token to user

                $code = rand(1000,9999);
                //$message = "<#> Your verification code is: $code $hash";
                // sned code through api 

                $client = Client::find($client_id);
                $user_id = $user->id;
                $accountLocked = $user->locked == 1;
                $accountInActive = $user->verified == 0;                

                $user = collect($user);
                $user->put('access_token', $data['access_token']);
                $user->put('verificationCode', $code);
                $user->put('hasProfile', $hasProfile);
                $user->put('client', $client->name);
                $hasVehical = false;
                $activeTrip = false;

                if($client->name == 'captain-app'){
                    $captain = Captain::with(['trips' => function($q){ $q->where(['is_active' => 1]); }])
                                        ->where(['user_id' => $user_id])
                                        ->first();

                    if(isset($captain)){

                        $vehicals_count = Vehical::where(['captain_id' => $user_id])->count(); 

                        if($vehicals_count > 0){
                            $hasVehical = true;
                        }
                        if(sizeof($captain->trips) > 0){
                            $activeTrip = true;
                        }
                    }
                }
                
                $user->put('hasVehical', $hasVehical);
                $user->put('activeTrip', $activeTrip);
                $user->put('accountInActive', $accountInActive);
                $user->put('accountLocked', $accountLocked);

                return Response::json($user);
            }else{
                return response(["message" => "The user credentials were incorrect.', 6, 'invalid_credentials"], 500);
            }
        }
        catch (ModelNotFoundException $e) { // email notfound
            //return error message
            return response(["message" => "User not found"], 500);
        }
        catch (OAuthServerException $e) { //password not correct..token not granted
            //return error message
            return response(["message" => "The user credentials were incorrect.', 6, 'invalid_credentials"], 500);
        }
        catch (Exception $e) {
            ////return error message
            return response(["message" => $e->getMessage()], 500);
        }
    }
}