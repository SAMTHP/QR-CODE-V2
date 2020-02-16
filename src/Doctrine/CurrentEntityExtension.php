<?php
namespace App\Doctrine;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use App\Entity\ApiRole;
use App\Entity\Company;
use App\Entity\Discount;
use App\Entity\Tag;

class CurrentEntityExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        // Current User
        $user = $this->security->getUser();

        if($resourceClass === ApiRole::class || $resourceClass === Company::class || $resourceClass === Discount::class || $resourceClass === Tag::class) {
            $routeAlias = $queryBuilder->getRootAliases()[0];

            if($resourceClass === Discount::class){
                
            }
            dd($routeAlias);
        }

    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {

    }

}