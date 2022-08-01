<?php

namespace Lloricode\LaravelPandagoSdk;

use ErrorException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\API\Auth\GenerateTokenAPI;
use Lloricode\LaravelPandagoSdk\DTO\Auth\Token;

class PandagoClient
{
    public const ENVIRONMENT_SANDBOX = 'sandbox';
    public const ENVIRONMENT_PRODUCTION = 'production';
    public const ENVIRONMENT_TESTING = 'testing';

    private string $base_url;
    private Token $token;

    /**
     * @throws \ErrorException
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function __construct(GenerateTokenAPI $generateTokenAPI, string $environment)
    {
        switch ($environment) {
            // @codeCoverageIgnoreStart
            case self::ENVIRONMENT_PRODUCTION:
                $this->base_url = (string) config('pandago-sdk.url.base.production');

                break;
            case self::ENVIRONMENT_SANDBOX:
                $this->base_url = (string) config('pandago-sdk.url.base.sandbox');

                break;
                // @codeCoverageIgnoreEnd
            case self::ENVIRONMENT_TESTING:
                $this->base_url = 'http://sample-pandago-base-api.test';

                $generateTokenAPI->fake();

                break;
            default:
                throw new ErrorException("Invalid environment `$environment`.");
        }

        $this->token = $generateTokenAPI->generate();
    }

//    /**
//     * @throws \Exception
//     * @throws \Psr\SimpleCache\InvalidArgumentException
//     */
//    public static function storeAccessToken(GenerateTokenAPI $generateTokenAPI): void
//    {
//        if (cache()->has(config('pandago-sdk.cache_key'))) {
//            return;
//        }
//
//        $token = $generateTokenAPI->token();
//
//        cache()->put(
//            config('pandago-sdk.cache_key'),
//            $token->access_token,
//            now()->addSeconds($token->expires_in)
//        );
//    }

    public function client(): PendingRequest
    {
        return Http::baseUrl($this->base_url)
            ->withToken($this->token->access_token, $this->token->token_type)
            ->retry((int) config('pandago-sdk.retry'))
            ->asJson()
            ->acceptJson();
    }

    public function fake(string $url, PromiseInterface $response): self
    {
        Http::fake([
            $this->base_url.'/'.$url => $response,
        ]);

        return $this;
    }
}
