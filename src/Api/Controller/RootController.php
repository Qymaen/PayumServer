<?php
declare(strict_types=1);

namespace App\Api\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class RootController
 * @package App\Api\Controller
 */
class RootController
{
    /**
     * @return JsonResponse
     */
    public function rootAction() : JsonResponse
    {
        return new JsonResponse([
            'name' => 'PayumServer',
            'version' => '1.0.x',
            'tagline' => 'Payment processing server. Setup once and rule them all',
        ]);
    }
}