<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
    public function list()
    {
        $repo = $this->getDoctrine()
            ->getRepository(Menu::class);
        $menu = new Menu($repo);
        

        return $this->render('client/list.html.twig', array(
            'menu' => $menu->getList()
        ));
    }
}
