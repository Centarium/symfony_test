<?php
namespace App\Controller;
use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\AppBundle\Form\UserType;
use App\Entity\User;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request,  AuthenticationUtils $authenticationUtils)
    {
        //$request = Request::createFromGlobals();
        /*$entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        try{
            $user->createTestUser($entityManager);
        }catch (\Exception $e){}*/

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new User();
        $user->setUsername($lastUsername);
        $loginForm = $this->createForm(UserType::class, $user);

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'form' => $loginForm->createView()
        ));
    }
}