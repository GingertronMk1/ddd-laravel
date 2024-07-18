<?php

declare(strict_types=1);

namespace App\Infrastructure\User;

use App\Models\User;
use Illuminate\Database\Connection;
use Carbon\Carbon;
use Generator;

class UserFinder
{
    public function __construct(
        private readonly Connection $connection
    ) {}

    public function find(string $id): User
    {
        $val = $this
            ->connection
            ->table('users')
            ->where(column: 'id', value: $id)
            ->first()
        ;
        return $this->fromResult($val);
    }

    public function all(): Generator
    {
        $vals = $this
            ->connection
            ->table('users')
            ->get()
        ;

        foreach($vals as $val) {
            yield $this->fromResult($val);
        }
    }


    private function fromResult(mixed $val): User
    {
        return new User([
            'id' => $val->id,
            'name' => $val->name,
            'email' => $val->email,
            'password' => $val->password,
            'rememberToken' => $val->remember_token,
            'emailVerifiedAt' => new Carbon($val->email_verified_at)
        ]);
    }
}
