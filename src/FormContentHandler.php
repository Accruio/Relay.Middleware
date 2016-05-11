<?php
/**
 *
 * This file is part of Relay for PHP.
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @copyright 2015-2016, Relay for PHP
 *
 */
namespace Relay\ResponseMiddleware;

/**
 *
 * Handles URL-encoded content.
 *
 * @package Relay.Middleware
 *
 */
class FormContentHandler extends ContentHandler
{
    /**
     * @inheritdoc
     */
    protected function isApplicableMimeType($mime)
    {
        return 'application/x-www-form-urlencoded' === $mime;
    }

    /**
     * @inheritdoc
     */
    protected function getParsedBody($body)
    {
        parse_str($body, $parsed);
        return $parsed;
    }
}
