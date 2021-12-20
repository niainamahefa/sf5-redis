<?php


namespace App\Message;

/*
 * Enveloppe du message, description du message que l'on va envoyer
 */

class MailNotification
{
    private $description;
    private $id;
    private $from;

    public function __construct(string $description, int $id, string  $from)
    {
        $this->description = $description;
        $this->id = $id;
        $this->from = $from;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }
}