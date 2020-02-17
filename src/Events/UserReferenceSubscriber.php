<?php
namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Repository\ApiRoleRepository;
use App\Repository\DiscountRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserReferenceSubscriber implements EventSubscriberInterface
{
    /**
     * Encoder
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

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
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUserRelations', EventPriorities::PRE_WRITE]
        ];
    }

    public function setUserRelations(ViewEvent $event)
    {
        $user = $event->getControllerResult();
        
        $method = $event->getRequest()->getMethod(); // POST, GET, PUT, ...

        if($user instanceof User && $method === "POST") {
            // $discounts = $user->discounts;
            // $apiRoles = $user->apiRoles;
            // dd($discounts);
            // if(count($discounts) > 0){
            //     foreach($discounts as $discountLink){
            //         $discount = $discountRepository->findOneByLink($discountLink);
            //         $user->addDiscount($discount);
            //     }
            // }
            // if(count($apiRoles) > 0){
            //     foreach($apiRoles as $roleTitle){
            //         $role = $apiRoleRepository->findOneByTitle($$roleTitle);
            //         $user->addApiRole($role);
            //     }
            // }
            // dd($user);
        }
    }

}