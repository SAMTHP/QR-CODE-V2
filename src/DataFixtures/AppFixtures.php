<?php

namespace App\DataFixtures;

use App\Entity\ApiRole;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Company;
use App\Entity\Discount;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    /**
     * AppFixtures class constructor
     *
     * @param UserPasswordEncoderInterface $encoder
     * @author Samir Founou
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Allow to generate fixtures
     *
     * @param ObjectManager $manager
     * @author Samir Founou
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // Role Admin creation
        $roleAdmin = new ApiRole();
        $roleAdmin->setTitle('ROLE_ADMIN');

        $manager->persist($roleAdmin);

        // Creation of new user
        $user = new User();
        $user->setFirstName("admin")
             ->setLastName('admin')
             ->setEmail('admin@admin.fr')
             ->setPassword($this->encoder->encodePassword($user,'admin'))
             ->setPhone('0101010101')
             ->setHasAgreed(true)
             ->addApiRole($roleAdmin);

        $manager->persist($user);
        
        $currentDay = new \DateTime();

        // Creation of many companies
        for($i = 0; $i < 10; $i++){
            $company = new Company();
            $company->setName("Companie n°".($i+1))
                    ->setContact("company_".$i."@contact.fr");
            
            $manager->persist($company);

            // Creation of many dicount offers
            for($e = 0; $e < 10; $e++){
                $discount = new Discount();
                $discount->setCompany($company)
                         ->setStartDate($currentDay)
                         ->setEndDate(date_add($currentDay, date_interval_create_from_date_string('50 days')))
                         ->setMaxFlash(500)
                         ->setLink("DISCOUNT$e");

                $manager->persist($discount);
                
                // Create one tag for current discount
                $tag = new Tag();
                $tag->setTitle("TAG_".$discount->getLink())
                    ->addDiscount($discount);

                $manager->persist($tag);
            }
        }
        $manager->flush();
    }
}
