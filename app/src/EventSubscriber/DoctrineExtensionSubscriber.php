<?php


namespace App\EventSubscriber;


use Gedmo\Blameable\BlameableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DoctrineExtensionSubscriber implements EventSubscriberInterface
{
    private $blameableListener;

    private $requestStack;

    private $tokenStorage;

    public function __construct(
        BlameableListener $blameableListener,
        RequestStack $requestStack,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->blameableListener = $blameableListener;
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(): void
    {
        if ($this->tokenStorage !== null &&
            $this->tokenStorage->getToken() !== null &&
            $this->tokenStorage->getToken()->isAuthenticated() === true
        ) {
            $this->blameableListener->setUserValue($this->tokenStorage->getToken()->getUser());
        } else {
            $this->blameableListener->setUserValue($this->requestStack->getCurrentRequest()->getHost());
        }
    }
}