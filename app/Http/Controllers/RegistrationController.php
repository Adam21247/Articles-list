<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Services\RegistrationService;
use App\Models\User;
use Laracasts\Flash\Flash;

class RegistrationController extends Controller
{

    private $registrationService;

    /**
     * RegistrationController constructor.
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }


    public function registration()
    {
        return view("auth.registration");
    }

    public function registerUser(RegistrationRequest $request)
    {
        $input = $request->all();
        $res = $this->registrationService->save($input);



        if (!$res) {
            return view(trans('validation.reject_registration'));
        } else {
            return redirect('login')->with('success','You have been registered');
        }
    }
}

