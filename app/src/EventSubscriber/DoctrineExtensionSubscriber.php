<?php


namespace App\EventSubscriber;


use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Gedmo\Blameable\BlameableListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DoctrineExtensionSubscriber implements EventSubscriberInterface
{
    private $blameableListener;

    private $request;

    private $tokenStorage;

    public function __construct(
        BlameableListener $blameableListener,
        Request $request,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->blameableListener = $blameableListener;
        $this->request = $request;
        $this->tokenStorage = $tokenStorage;
    }

    public function getSubscribedEvents(): array
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
            $this->blameableListener->setUserValue($this->request->getHost());
        }
    }
}