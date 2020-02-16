<?php
namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        // Get user
        $user = $event->getUser();

        // Set JWT
        $data = $event->getData();
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();
        $data['phone'] = $user->getPhone();
        $data['hasAgreed'] = $user->getHasAgreed();
        $data['discounts'] = $user->getDiscounts();

        $event->setData($data);
    }
}