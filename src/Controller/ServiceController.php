<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;

class ServiceController extends Controller
{
    public function list()
    {
        $repo = $this->getDoctrine()
            ->getRepository(Menu::class);
        $menu = new Menu($repo);


        return $this->render('service/list.html.twig', array(
            'menu' => $menu->getList()
        ));
    }
}
