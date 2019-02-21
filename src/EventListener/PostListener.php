<?php
namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class PostListener implements EventSubscriberInterface
{

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onLeave(Event $event)
    {
        $this->logger->alert(
            sprintf('Post (id: "%s") passou pela transaction "%s"',
                $event->getSubject()->getId(),
                $event->getTransition()->getName(),
                implode(', ', array_keys($event->getMarking()->getPlaces())),
                implode(', ', $event->getTransition()->getTos())
            ));
        
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.post.leave' => 'onLeave'
        ];
    }
}