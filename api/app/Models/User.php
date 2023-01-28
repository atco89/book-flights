<?php

namespace App\Models;

use App\Casts\PasswordCast;
use App\Notifications\MailVerification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Throwable;

class User extends AuthModel implements MustVerifyEmail
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'birth_date',
        'passport_number',
        'phone',
        'email',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'password',
        'verification_code',
        'verified_at',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'birth_date'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'password' => PasswordCast::class,
    ];

    /**
     * @return void
     * @noinspection PhpUndefinedFieldInspection
     */
    protected static function booting(): void
    {
        parent::booting();
        static::creating(function (Model $model): void {
            $model->verification_code = sha1(Uuid::uuid4()->toString());
            $model->verified_at = null;
        });
    }

    /**
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->verified_at !== null;
    }

    /**
     * @return void
     * @throws Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function markEmailAsVerified(): void
    {
        $this->verified_at = now();
        $this->updateOrFail();
    }

    /**
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new MailVerification());
    }

    /**
     * @return void
     */
    public function getEmailForVerification(): void
    {
        return;
    }

    /**
     * @return int
     */
    public function getJWTIdentifier(): int
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
