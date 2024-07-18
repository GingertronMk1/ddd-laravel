<?php

declare(strict_types=1);

namespace App\Framework\Http\Controllers;

use App\Infrastructure\User\UserFinder;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function __invoke(
        UserFinder $userFinder
    ): Response {
        dd(iterator_to_array($userFinder->all()));
    }
}
