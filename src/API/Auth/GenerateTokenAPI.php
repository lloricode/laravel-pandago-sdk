<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use ErrorException;
use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\DTO\Auth\Token;
use Lloricode\LaravelPandagoSdk\PandagoClient;

class GenerateTokenAPI
{
    protected const URL = 'oauth2/token';

    public const BASE_URL_PRODUCTION = 'https://sts.deliveryhero.io';
    public const BASE_URL_SANDBOX = 'https://sts-st.deliveryhero.io';
    protected string $baseUrl;

    public function __construct(string $environment = PandagoClient::ENVIRONMENT_SANDBOX)
    {
        switch ($environment) {
            // @codeCoverageIgnoreStart
            case PandagoClient::ENVIRONMENT_PRODUCTION:
                $this->baseUrl = self::BASE_URL_PRODUCTION;

                break;
            case PandagoClient::ENVIRONMENT_SANDBOX:
                $this->baseUrl = self::BASE_URL_SANDBOX;

                break;
            // @codeCoverageIgnoreEnd
            case PandagoClient::ENVIRONMENT_TESTING:
                $this->baseUrl = 'http://sample-api.test';

                break;
            default:
                throw new ErrorException("Invalid environment `$environment`.");
        }
    }

    public static function new(): self
    {
        return app(static::class);
    }

    public static function newFake(): FakeGenerateTokenAPI
    {
        return app(FakeGenerateTokenAPI::class);
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function token(): Token
    {
        $response = Http::baseUrl($this->baseUrl)
            ->asJson()
            ->acceptJson()
            ->post(self::URL, config('pandago-sdk.auth'));

        $response->throw();

        return new Token($response->collect()->toArray());
    }
}
