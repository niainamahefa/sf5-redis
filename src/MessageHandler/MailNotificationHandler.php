<?php


namespace App\MessageHandler;

/*
 * Gestionnaire (handler), traitement à opérer sur le message
 */

use App\Message\MailNotification;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class MailNotificationHandler implements MessageHandlerInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    private function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(MailNotification $message)
    {
        $email = (new Email())
            ->from($message->getFrom())
            ->to('superadmin@my-website.io')
            ->subject('New Message #' . $message->getId() . ' - ' . $message->getFrom())
            ->html('<p>' . $message->getDescription() . '</p>');

        sleep(10);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
}