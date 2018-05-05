<?php
namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @ORM\Table(name="menu_items")
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $parent_id;
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $route;

    private $menu;

    public function __construct(EntityRepository $menuRepository)
    {
        $this->menu = $menuRepository->findAll();
    }

    public function getList()
    {
        return $this->menu;
    }

    public function isCurrentPage()
    {
        global $kernel;
        $container = $kernel->getContainer();

        $path = $container->get('router')->getRouteCollection()->get( $this->route )->getPath();
        $router = $container->get('router')->getContext()->getPathInfo();

        if( $router == $path ) return 'underline';
        return '';
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentoo_id;
    }

    /**
     * @param mixed $parentoo_id
     */
    public function setParentId($parentoo_id)
    {
        $this->parentoo_id = $parentoo_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }
}