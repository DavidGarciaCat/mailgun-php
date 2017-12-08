<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Mailgun\Api;

use Mailgun\Assert;
use Mailgun\Model\Event\EventResponse;

/**
 * {@link https://documentation.mailgun.com/api-events.html}.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Event extends HttpApi
{
    use Pagination;

    /**
     * @return EventResponse
     */
    public function get(string $domain, array $params = [])
    {
        Assert::stringNotEmpty($domain);

        $response = $this->httpGet(sprintf('/v3/%s/events', $domain), $params);

        return $this->hydrateResponse($response, EventResponse::class);
    }
}