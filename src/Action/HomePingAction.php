<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * HomePingAction.
 */
class HomePingAction extends AbstractAction
{
    /**
     * Action (Json).
     *
     * @param Request $request
     * @param Response $response
     *
     * @return ResponseInterface Json response
     */
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $data = $request->getParsedBody();

        return $response->withJson($data);
    }
}
