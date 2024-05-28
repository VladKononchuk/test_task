<?php

declare(strict_types=1);

namespace AppBundle\Service;

use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Dotenv\Dotenv;

final class Mailer
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    public function __construct(
        Swift_Mailer $mailer
    ) {
        $this->mailer = $mailer;

        (new Dotenv())->load('/home/vladislav/test_task/.env');
    }

    public function send(): void
    {
        $email = (new Swift_Message('Hello'))
            ->setFrom($_ENV['SENDER_ADDRESS'])
            ->setTo($_ENV['DELIVERY_ADDRESS'])
            ->setBody('Automobile data have been changed');

        $this->mailer->send($email);
    }
}
