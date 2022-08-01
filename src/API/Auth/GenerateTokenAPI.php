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

    private string $environment;

    protected string $baseUrl;

    /**
     * @throws \ErrorException
     */
    public function __construct(string $environment = PandagoClient::ENVIRONMENT_SANDBOX)
    {
        switch ($environment) {
            // @codeCoverageIgnoreStart
            case PandagoClient::ENVIRONMENT_PRODUCTION:
                $this->baseUrl = (string) config('pandago-sdk.url.auth.production');

                break;
            case PandagoClient::ENVIRONMENT_SANDBOX:
                $this->baseUrl = (string) config('pandago-sdk.url.auth.sandbox');

                break;
                // @codeCoverageIgnoreEnd
            case PandagoClient::ENVIRONMENT_TESTING:
                $this->baseUrl = 'http://sample-pandago-auth-api.test';

                break;
            default:
                throw new ErrorException("Invalid environment `$environment`.");
        }

        $this->environment = $environment;
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
                ->retry((int) config('pandago-sdk.retry'))
                ->asForm()
                ->acceptJson()
                ->post(self::URL, ((array)config('pandago-sdk.auth')) + [
                    'client_assertion' => self::generateClientAssertion(),
                    ])
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    public function generateClientAssertion(): string
    {
        if (app()->runningUnitTests()) {
            return 'fake-jwt';
        }

        $fileName = 'pandago-private.key';

        if ($this->environment === PandagoClient::ENVIRONMENT_SANDBOX) {
            $fileName = 'sandbox-pandago-private.key';
        }

        $privateKey = file_get_contents(storage_path($fileName));

        if ($privateKey === false) {
            abort(500, 'must have generate private key');
        }

        return JWT::encode([
            'iss' => config('pandago-sdk.auth.client_id'),
            'sub' => config('pandago-sdk.auth.client_id'),
            'jti' => config('pandago-sdk.jwt.jti'),
            'exp' => now()->addMinutes((int)config('pandago-sdk.jwt.expire_in_minutes'))->timestamp,
            'aud' => config('pandago-sdk.jwt.aud'),
        ], $privateKey, 'RS256', (string) config('pandago-sdk.jwt.key_id'));
    }
}
