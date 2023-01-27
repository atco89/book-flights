<?php

namespace App\Models;

use App\Models\Scopes\WithoutTrashedScope;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class AuthModel extends Authenticatable implements JWTSubject
{
    use HasApiTokens, SoftDeletes, HasFactory, Notifiable;

    /**
     * @return void
     */
    protected static function booted(): void
    {
        parent::booted();
        static::addGlobalScope(new WithoutTrashedScope());
    }

    /**
     * @return void
     * @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpUndefinedMethodInspection
     */
    protected static function booting(): void
    {
        parent::booting();
        static::creating(function (Model $model): void {
            $model->uid = Uuid::uuid4()->toString();
        });

        static::deleting(function (Model $model): void {
            if (!$model->isForceDeleting()) {
                $model->deleted_at = self::currentDateTime();
                $model->update();
            }
        });
    }

    /**
     * @return string
     */
    private static function currentDateTime(): string
    {
        $dateTime = new DateTime();
        return $dateTime->format(DateTimeInterface::W3C);
    }
}
