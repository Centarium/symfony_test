<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;

class InvoiceController extends Controller
{
    public function list()
    {

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find(1);


        $number = mt_rand(0, 100);

        return $this->render('invoice/list.html.twig', array(
            'product' => $product,
            'number'         => $number,
        ));

        /*return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );*/
    }
}
