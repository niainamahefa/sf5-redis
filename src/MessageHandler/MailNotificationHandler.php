<?php


namespace App\MessageHandler;

/*
 * Gestionnaire (handler), traitement à opérer sur le message
 */

use App\Message\MailNotification;
use Symfony\Component\Mailer\MailerInterface;
use Twig\TokenParser\EmbedTokenParser;

class MailNotificationHandler
{
    private function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(MailNotification $mmessage)
    {

    }
}