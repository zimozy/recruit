<?php

/*
 The MIT License (MIT)

Copyright (c) 2018 Tim Hawkins / IBG Software

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

namespace ScoopM\Middleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\Body;

/**
 * Minify-Middleware is a summary of stackoverflow answers to reduce html traffic
 * by removing whitespaces, tabs, empty lines and comments.
 * */
class Minifier
{
    /**
     * minify html content
     *
     * @param string $html
     * @return string
     */
    private function minifyHTML($html)
    {
        return preg_replace(
            array(
                '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/',
                 '/\n/',
                '/\>[^\S ]+/s',
                '/[^\S ]+\</s',
                '/(\s)+/s',
                '/<!--.*?-->/',
                '/>\s+</'
            ),
            array(
                '',
                '',
                '>',
                '<',
                '\\1',
                '',
                '><'
            ),
            $html
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return static
     */
    public function __invoke(Request $request, Response $response, callable $next) {
        
        $newResponse = $next($request,$response);

        $newBody = new Body(
            fopen('php://temp', 'r+')
        );

        $newBody->write(
            $this->minifyHTML(
                (string) ($newResponse->getBody())
            )
        );

        return $newResponse->withBody($newBody);
    }
}

