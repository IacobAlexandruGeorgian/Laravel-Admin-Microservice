<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserService
{
    private $endpoint = 'host.docker.internal:8001/api';

    public function headers()
    {
        return [
            'Authorization' => request()->headers->get('Authorization')
        ];
    }

    public function getUser()
    {
        $json = Http::withHeaders($this->headers())->get("{$this->endpoint}/user")->json();

        $user = new User();
        $user->id = $json['id'];
        $user->first_name = $json['first_name'];
        $user->last_name = $json['last_name'];
        $user->email = $json['email'];
        $user->is_influencer = $json['is_influencer'];

        return $user;
    }

    public function isAdmin()
    {
        return Http::withHeaders($this->headers())->get("{$this->endpoint}/admin")->successful();
    }

    public function isInfluencer()
    {
        return Http::withHeaders($this->headers())->get("{$this->endpoint}/influencer")->successful();
    }
}
