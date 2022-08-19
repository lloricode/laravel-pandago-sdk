<?php

namespace Lloricode\LaravelPandagoSdk\API\Auth;

use ErrorException;
use Firebase\JWT\JWT;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Lloricode\LaravelPandagoSdk\DTO\Auth\Token;
use Lloricode\LaravelPandagoSdk\PandagoClient;
use Symfony\Component\Process\Process;

class GenerateTokenAPI
{
    protected const URL = 'oauth2/token';

    protected string $environment;

    protected string $baseUrl;

    public const PRIVATE_KEY = 'pandago-private.key';

    public const PUBLIC_KEY = 'pandago-public.key';

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

    public static function fake(): FakeGenerateTokenAPI
    {
        return app(FakeGenerateTokenAPI::class);
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
        $privateKey = file_get_contents($this->privateKeyFileName());

        return JWT::encode([
            'iss' => config('pandago-sdk.auth.client_id'),
            'sub' => config('pandago-sdk.auth.client_id'),
            'jti' => config('pandago-sdk.jwt.jti', Str::uuid()),
            'exp' => now()->addMinutes((int)config('pandago-sdk.jwt.expire_in_minutes'))->timestamp,
            'aud' => config('pandago-sdk.jwt.aud'),
        ], $privateKey, 'RS256', (string) config('pandago-sdk.jwt.key_id'));
    }

    private function getFileNameDirectory(bool $private, bool $checkIfExist = true): string
    {
        $fileName = $private ? self::PRIVATE_KEY : self::PUBLIC_KEY;

        if ($this->environment !== PandagoClient::ENVIRONMENT_PRODUCTION) {
            $fileName = $this->environment.'-'.$fileName;
        }

        $fullPathFile = config('pandago-sdk.key_pair_path').DIRECTORY_SEPARATOR.$fileName;

        if ($checkIfExist && ! File::exists($fullPathFile)) {
            abort(400, "$fullPathFile not exist.");
        }

        return $fullPathFile;
    }

    public function deleteKeyPair(): void
    {
        File::delete($this->publicKeyFileName());
        File::delete($this->privateKeyFileName());
    }

    public function publicKeyFileName(bool $checkIfExist = true): string
    {
        return $this->getFileNameDirectory(false, $checkIfExist);
    }

    public function privateKeyFileName(bool $checkIfExist = true): string
    {
        return $this->getFileNameDirectory(true, $checkIfExist);
    }

    public function generateKeyPair(): bool
    {
        $privateKeyFile = $this->privateKeyFileName(false);
        $publicKeyFile = $this->publicKeyFileName(false);

        $process = Process::fromShellCommandline(
            "openssl genrsa -out $privateKeyFile 2048"
        );

        $process->run();

        if (! $process->isSuccessful()) {
            return false;
        }

        $process = Process::fromShellCommandline(
            "openssl rsa -in $privateKeyFile -pubout > $publicKeyFile"
        );

        $process->run();

        return $process->isSuccessful();
    }
}
