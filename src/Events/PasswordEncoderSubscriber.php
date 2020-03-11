<?php
namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    /**
     * Encoder
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * PasswordEncoderSubscriber class constructor
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     * 
     * @author Samir Founou
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * Allow to encode password
     *
     * @param ViewEvent $event
     * 
     * @author Samir Founou
     * @return void
     */
    public function encodePassword(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        $request = $event->getRequest();
        
        $pass = "";
        if(isset(\json_decode($request->getContent())->password)){
            $pass =\json_decode($request->getContent())->password;
        }
        
        $method = $event->getRequest()->getMethod(); // POST, GET, PUT, ...

        if($user instanceof User && $method === "POST") {
            $hash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
        } elseif($user instanceof User && $method === "PUT" || $user instanceof User && $method === "PATCH"){
            if($pass != null){
                $hash = $this->encoder->encodePassword($user, $pass);
                $user->setPassword($hash);
            }
        }
    }

}