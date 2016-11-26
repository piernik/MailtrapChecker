<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2016-11-23
 * Time: 10:09
 */

namespace Lukana\MailtrapChecker;


class MailtrapApiGenerator
{
    protected $apiToken;
    protected $urlCore = 'https://mailtrap.io/api/v1/';
    protected $inboxId;

    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function generateUrl($type, $params = [])
    {
        switch ($type) {
            case "inbox":
                return $this->urlCore . "inboxes";
                break;
            case "messages":
                return $this->urlCore . "inboxes/" . $this->getInboxId() . "/messages";
                break;
            case "message":
                return $this->urlCore . "inboxes/" . $this->getInboxId() . "/messages/{$params['id']}";
                break;
            case "attachments":
                return $this->urlCore . "inboxes/" . $this->getInboxId() . "/messages/{$params['id']}/attachments";
                break;
            default:
                throw new \Exception("Can't generate URL for $type");
                break;
        }
    }

    public function generateMethod($type)
    {
        switch ($type) {
            default:
                return "GET";
                break;
        }
    }

    public function setInboxId(int $inboxId)
    {
        $this->inboxId = $inboxId;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getInboxId()
    {
        if (!$this->inboxId) throw new \Exception("Don't have InboxID");

        return $this->inboxId;
    }
}