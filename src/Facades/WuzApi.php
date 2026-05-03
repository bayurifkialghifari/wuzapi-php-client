<?php

namespace Bayurifkialghifari\WuzApi\Facades;

use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Facade;

/**
 * @see WuzApiClient
 *
 * @method static \Bayurifkialghifari\WuzApi\Modules\SessionModule session()
 * @method static \Bayurifkialghifari\WuzApi\Modules\ChatModule chat()
 * @method static \Bayurifkialghifari\WuzApi\Modules\UserModule user()
 * @method static \Bayurifkialghifari\WuzApi\Modules\GroupModule group()
 * @method static \Bayurifkialghifari\WuzApi\Modules\AdminModule admin()
 * @method static \Bayurifkialghifari\WuzApi\Modules\WebhookModule webhook()
 */
class WuzApi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WuzApiClient::class;
    }
}
