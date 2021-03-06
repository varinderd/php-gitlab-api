<?php


namespace Gitlab\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Prefix requests path with /api/v4/ if required.
 *
 * @author Fabien Bourigault <bourigaultfabien@gmail.com>
 */
class ApiVersion implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $uri = $request->getUri();

        if (substr($uri->getPath(), 0, 8) !== '/api/v4/') {
            $request = $request->withUri($uri->withPath('/api/v4/'.$uri->getPath()));
        }

        return $next($request);
    }
}
