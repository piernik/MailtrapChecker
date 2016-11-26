Mailtrap Checker
================

Usage
-----
```
$mailtrap = new MailtrapChecker($apiToken, $inboxId); //$inboxId is optional

//get all inboxes 
$inboxes = $mailtrap->getInboxes();

//get last message in inbox
$res = $mailtrap->getLastMessage();

```