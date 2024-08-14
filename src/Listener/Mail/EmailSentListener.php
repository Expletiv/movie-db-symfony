<?php

namespace App\Listener\Mail;

use App\Entity\EmailLog;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mailer\Event\SentMessageEvent;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Throwable;

#[AsEventListener]
readonly class EmailSentListener
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(SentMessageEvent $event): void
    {
        try {
            $message = $event->getMessage();
            $email = $message->getMessage();
            if (!$email instanceof Email) {
                return;
            }
            $emailLog = $this->createEmailLog($email);
            $this->entityManager->persist($emailLog);
            $this->entityManager->flush();
        } catch (Throwable $e) {
            $this->logger->error('Error saving email log', ['exception' => $e]);
        }
    }

    private function createEmailLog(Email $email): EmailLog
    {
        $emailLog = new EmailLog();
        $emailLog->setSubject($email->getSubject());
        $emailLog->setSentAt(new DateTimeImmutable());
        $emailLog->setSender($email->getSender()?->getAddress());
        $recipients = $email->getTo();
        // For now there will only be one receiver, but in the future there could be more
        /** @var Address|false $firstReceiver */
        $firstReceiver = reset($recipients);
        $emailLog->setRecipient($firstReceiver ? $firstReceiver->getAddress() : null);
        $emailLog->setHtml($email->getHtmlBody() ?? '');

        return $emailLog;
    }
}
