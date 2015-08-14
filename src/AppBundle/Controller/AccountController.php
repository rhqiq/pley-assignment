<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AccountController extends Controller
{

    /**
     * @Route("/register", name="register")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $user = new User();

            $user->setFirstname($request->request->get('form-first-name'));
            $user->setLastname($request->request->get('form-last-name'));
            $user->setEmail($request->request->get('form-email'));
            $user->setPlainPassword($request->request->get('form-password'));

            $em->persist($user);
            $em->flush();
            $json = json_encode(
                [
                    'result' => 'Thank You for Registering.',
                ]
            );

            $response = new Response($json);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        return $this->render(
            ':account:register.html.twig'
        );
    }
}
