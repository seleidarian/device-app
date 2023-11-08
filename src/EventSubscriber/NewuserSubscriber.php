<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Event\AbstractLifecycleEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class NewuserSubscriber implements EventSubscriberInterface
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {

    }

    public function onBeforeEntityPersistedEvent(AbstractLifecycleEvent $event): void
    {
        $entityInstance = $event->getEntityInstance();

        if(!($entityInstance instanceof Users)) {
            return;
        }

        $entityInstance->setPassword(
            $this->userPasswordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPassword('password')
            )
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityPersistedEvent'
        ];
    }
}
