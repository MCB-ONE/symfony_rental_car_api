<?php

declare(strict_types=1);

namespace Mailer\Service\Mailer;

use Mailer\Templating\TwigTemplates;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Twig\Environment;
use Symfony\Component\Mime\Email;

class MailerService 
{
    private const TEMPLATE_SUBJECT_MAP = [
        TwigTemplates::USER_REGISTER => 'Bienvenid@!',
        TwigTemplates::REQUEST_RESET_PASSWORD => 'Restablecer contraseña'
    ];

    private MailerInterface $mailer;
    private Environment $engine; 
    private LoggerInterface $logger;
    private string $mailerDefaultSender;

    public function __construct(MailerInterface $mailer, Environment $engine, LoggerInterface $logger, string $mailerDefaultSender)
    {
        $this->mailer = $mailer;
        $this->engine = $engine;
        $this->logger = $logger;
        $this->mailerDefaultSender = $mailerDefaultSender;
    }

    /**
     * @throws \Exception
     */
    public function send(string $reciver, string $template, array $payload): void
    {
        $email = (new Email())
            ->from($this->mailerDefaultSender)
            ->to($reciver)
            ->subject(self::TEMPLATE_SUBJECT_MAP[$template])
            ->html($this->engine->render($template, $payload));

            try{
                $this->mailer->send($email);
            }catch(TransportExceptionInterface $e){
                $this->logger->error(\sprintf('Error al envíar email: %s', $e->getMessage()));
            }
    }

}
