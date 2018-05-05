<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;

class InvoiceController extends Controller
{
    public function list()
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find(1);

        $repo = $this->getDoctrine()
            ->getRepository(Menu::class);

        $menu = new Menu($repo);

        $number = mt_rand(0, 100);

        return $this->render('invoice/list.html.twig', array(
            'menu' => $menu->getList(),
            'product' => $product,
            'number'         => $number,
        ));

        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );*/
    }
}
