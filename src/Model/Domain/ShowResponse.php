<?php

declare(strict_types=1);

/*
 * Copyright (C) 2013 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace Mailgun\Model\Domain;

use Mailgun\Model\ApiResponse;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
final class ShowResponse implements ApiResponse
{
    /**
     * @var Domain
     */
    private $domain;

    /**
     * @var DnsRecord[]
     */
    private $inboundDnsRecords;

    /**
     * @var DnsRecord[]
     */
    private $outboundDnsRecords;

    /**
     * @return self
     */
    public static function create(array $data)
    {
        $rx = [];
        $tx = [];
        $domain = null;

        if (isset($data['domain'])) {
            $domain = Domain::create($data['domain']);
        }

        if (isset($data['receiving_dns_records'])) {
            foreach ($data['receiving_dns_records'] as $item) {
                $rx[] = DnsRecord::create($item);
            }
        }

        if (isset($data['sending_dns_records'])) {
            foreach ($data['sending_dns_records'] as $item) {
                $tx[] = DnsRecord::create($item);
            }
        }

        return new self($domain, $rx, $tx);
    }

    /**
     * @param DnsRecord[] $rxRecords
     * @param DnsRecord[] $txRecords
     */
    private function __construct(Domain $domainInfo, array $rxRecords, array $txRecords)
    {
        $this->domain = $domainInfo;
        $this->inboundDnsRecords = $rxRecords;
        $this->outboundDnsRecords = $txRecords;
    }

    /**
     * @return Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return DnsRecord[]
     */
    public function getInboundDNSRecords()
    {
        return $this->inboundDnsRecords;
    }

    /**
     * @return DnsRecord[]
     */
    public function getOutboundDNSRecords()
    {
        return $this->outboundDnsRecords;
    }
}
