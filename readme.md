Mailtrap Checker
================

Usage
-----
```
$mailtrap = new MailtrapChecker($apiToken, $inboxId); //$inboxId is optional

//get all inboxes 
$inboxes = $this->getInboxes();

//get last message in inbox
$res = $this->mailtrap->getLastMessage();

```