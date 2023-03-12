<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\Response;

use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController as ATC;

use Exception;

use App\Services\App\Client;

use App\Models\User;

class OAuthController extends ATC
{
    /**
     * Create a new controller instance.
     *
     * @param AuthorizationServer $server
     * @param TokenRepository $tokens
     * @param JwtParser $jwt
     */
    #[Pure] public function __construct(
        AuthorizationServer $server,
        TokenRepository $tokens,
        JwtParser $jwt,
    )
    {
        parent::__construct($server, $tokens, $jwt);
    }

    /**
     *
     * @param ServerRequestInterface $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function issueToken(ServerRequestInterface $request): JsonResponse
    {
        if (\Laravel\Passport\Client::query()->doesntExist()) {
            return $this->json->OAuthError(
                'Wrong Client data.',
                'invalid_config',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $dbClient = \DB::table('oauth_clients')->where([
            ['password_client', true],
            ['personal_access_client', false],
        ])->first();
        $client = new Client($dbClient->id, $dbClient->secret, $request);

        try {
            $request = $client->parseRequestBody();

            # get grant type
            $grantType = $client->getGrantType();

            if ($grantType === 'password') {
                # get username (default is :email)
                $email = $client->getUsername();

                if (!User::query()->firstWhere('email', $email)) {
                    return response()->json([
                        'message' => 'The user credentials were incorrect.',
                        'type' => 'invalid_credentials',
                    ], Response::HTTP_UNAUTHORIZED);
                }
            }

            # generate token
            $tokenResponse = parent::issueToken($request);
            # convert response to json string
            $content = $tokenResponse->getContent();
            # convert json to array
            $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

            if (isset($data["error"])) {
                return response()->json([
                    'message' => 'The user credentials were incorrect.',
                    'type' => 'invalid_credentials',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json($data, Response::HTTP_OK);

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'type' => OAuthServerException::invalidGrant()->getErrorType(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Logout user and invalidate token.
     *
     * @OA\Get(
     *     path="/logout-side",
     *     security={{ "passport": {"*"} }},
     *     operationId="oauth2 logout",
     *     tags={"oAuth"},
     *     summary="Logout and Token Invalidation",
     *     description="

    Sending an request to logout endpoint with a valid API token will also invalidate that token.
    ### Example URI
     **GET** https://your-website.com/api/v1/logout-side",
     *     @OA\Response(
     *          response="200",
     *          description="**OK** Successful register",
     *     ),
     *     @OA\Response(
     *          response="401",
     *          description="**Unauthorized** Invalid credentials.",
     *     ),
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()?->revoke();

        return $this->json->response([], __('You are successfully logged out'));
    }
}
