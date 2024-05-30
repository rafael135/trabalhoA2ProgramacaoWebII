<?php

namespace App\Http\Requests;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"],
            "passwordConfirm" => ["required", "string", "same:password"]
        ];
    }

    public function authenticate() {
        $name = $this->input("name");
        $email = $this->input("email");
        $password = $this->input("password");

        //dd($name, $email, $password, $passwordConfirm);

        

        $userExists = User::select()->where("email", "=", $email)->get();
        if(count(($userExists))) {
            return redirect()->route("registerView")->with("errors", [
                "existentUser" => true
            ]);
        }

        try {
            User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password)
            ]);
        } catch(Exception $ex) {
            return redirect()->route("register.view")->with("errors", [
                "serverError" => true
            ]);
        }
        

        $success = Auth::attempt([
            "email" => $email,
            "password" => $password
        ], true);

        return $success;
        
    }
}
