<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Teacher extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["*"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Customer full name.
     *
     * @return  string
     */
    public function name()
    {
        return ucwords("$this->first_name $this->last_name");
    }

    /**
     * Interact with the user's image.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value != null && file_exists(public_path($value)) ? asset($value) : asset("assets/images/student/default.png"),
            // set: fn ($value) => strtolower($value),
        );
    }

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $abilities
     * @param  \DateTimeInterface|null  $expiresAt
     * @return \Laravel\Sanctum\NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(70)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }
}
