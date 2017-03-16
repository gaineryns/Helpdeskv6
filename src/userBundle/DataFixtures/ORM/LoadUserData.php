<?php
/**
 * Created by PhpStorm.
 * User: gaineryns
 * Date: 16/03/2017
 * Time: 07:39
 */

namespace userBundle\DataFixture\ORM;

use userBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData
    extends AbstractFixture
    implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('test');
        $user->setEmail('test@test.com');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');
        $this->addReference('user-admin', $user);
        $userManager->updateUser($user);


        $user1 = $userManager->createUser();
        $user1->setUsername('admin');
        $user1->setEmail('admin@admin.com');
        $user1->setPlainPassword('admin');
        $user1->setEnabled(true);
        $user1->addRole('ROLE_SUPER_ADMIN');
        $this->addReference('admin-admin', $user1);
        $userManager->updateUser($user1);
    }

    /**
     * Sets the container.
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}