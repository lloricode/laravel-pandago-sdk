<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use ErrorException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\DTO\Auth\Token;
use Lloricode\LaravelPandagoSdk\PandagoClient;

class GenerateTokenAPI
{
    protected const URL = 'oauth2/token';

    public const BASE_URL_PRODUCTION = 'https://sts.deliveryhero.io';
    public const BASE_URL_SANDBOX = 'https://sts-st.deliveryhero.io';
    protected string $baseUrl;

    /**
     * @throws \ErrorException
     */
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

    public static function fake(?PromiseInterface $response = null): FakeGenerateTokenAPI
    {
        return app(FakeGenerateTokenAPI::class)->fakeGenerate($response);
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function generate(): Token
    {
        $response = Http::baseUrl($this->baseUrl)
            ->retry(config('pandago-sdk.retry'))
            ->asJson()
            ->acceptJson()
            ->post(self::URL, config('pandago-sdk.auth'));

        $response->throw();

        return new Token($response->collect()->toArray());
    }
}
