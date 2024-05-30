<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"]
        ];
    }

    public function authenticate() {
        $email = $this->input("email", null);
        $password = $this->input("password", null);

        

        $success = Auth::attempt([
            "email" => $email,
            "password" => $password
        ], true);

        /* if($success == true) {
            $rawUser = DB::table("users")->select()->where("email", "=", $email)->get()->first();
            $user = User::find($rawUser[0]->id);

            Auth::login($user, true);
            dd(Auth::user());
        } */

        return $success;
    }
}
