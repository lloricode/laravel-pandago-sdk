<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use ErrorException;
use Firebase\JWT\JWT;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
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
                $this->baseUrl = 'http://sample-pandaogo-api.test';

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
        return new Token(
            Http::baseUrl($this->baseUrl)
                ->retry(config('pandago-sdk.retry'))
                ->asForm()
                ->acceptJson()
                ->post(self::URL, config('pandago-sdk.auth') + [
                    'client_assertion' => self::generateClientAssertion(),
                    ])
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    public static function generateClientAssertion(): string
    {
        if (app()->runningUnitTests()) {
            return 'fake-jwt';
        }

        $privateKey = file_get_contents(storage_path('pandago-private.key'));

        if ($privateKey === false) {
            abort('must have generate private key');
        }

        return JWT::encode([
            'iss' => config('pandago-sdk.auth.client_id'),
            'sub' => config('pandago-sdk.auth.client_id'),
            'jti' => config('pandago-sdk.jwt.jti'),
            'exp' => config('pandago-sdk.jwt.exp'),
            'aud' => config('pandago-sdk.jwt.aud'),
        ], $privateKey, 'RS256', config('pandago-sdk.jwt.key_id'));
    }
}
