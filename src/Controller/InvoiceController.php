<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;

class InvoiceController extends Controller
{
    public function list()
    {
        $invoices = $this->getDoctrine()->getRepository(Invoice::class)
            ->findAll();

        $repo = $this->getDoctrine()
            ->getRepository(Menu::class);

        $menu = new Menu($repo);

        return $this->render('invoice/list.html.twig', array(
            'invoices'=>$invoices,
            'menu' => $menu->getList()
        ));

        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );*/
    }
}
