<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 2016-11-23
 * Time: 09:40
 */

namespace Lukana\MailtrapChecker;


class MailtrapChecker
{
    /** @var MailtrapApiGenerator */
    protected $apiGenerator;

    /**
     * start MailboxChecker
     *
     * MailtrapChecker constructor.
     * @param string $apiToken apiToken from Mailtrap
     * @param int|null $inboxId optional inboxId
     */
    public function __construct(string $apiToken, int $inboxId = null)
    {
        $this->apiGenerator = new MailtrapApiGenerator($apiToken);
        if (!$inboxId) {
            $inboxes = $this->getInboxes();
            $inboxId = $inboxes[0]['id'];
        }
        if ($inboxId) $this->setInboxId($inboxId);
    }

    /**
     * Set inboxId
     *
     * @param $inboxId
     */
    public function setInboxId($inboxId)
    {
        $this->apiGenerator->setInboxId($inboxId);
    }

    /**
     * Get all inboxes
     *
     * @return array|mixed
     */
    public function getInboxes()
    {
        return $this->getRequest('inbox');
    }

    /**
     * Get last message in selected earlier inbox
     * Gets also attachments
     *
     * @return array|mixed
     * @throws \Exception
     */
    public function getLastMessage()
    {
        $messages = $this->getRequest('messages');
        if (empty($messages)) throw new \Exception("Don't have any messages on server");

        $res = $this->getRequest('message', ['id' => $messages[0]['id']]);
        $res['attachments'] = $this->getRequest('attachments', ['id' => $messages[0]['id']]);

        return $res;
    }

    private function getRequest($type, $params = [])
    {
        $request = new Request();
        $request->setUrl($this->apiGenerator->generateUrl($type, $params));
        $request->setMethod($this->apiGenerator->generateMethod($type));
        $request->setHeaders([
            'verify'  => false,
            'headers' => [
                'Authorization' => "Token token=" . $this->getApiToken(),
            ],
        ]);

        $res = $this->parseJson((string)$request->sendRequest()->getBody());

        return $res;
    }

    public function getApiToken()
    {
        return $this->apiGenerator->getApiToken();
    }

    protected function parseJson($body)
    {
        $data = json_decode((string)$body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception('Unable to parse response body into JSON: ' . json_last_error());
        }

        return $data === null ? array() : $data;
    }
}