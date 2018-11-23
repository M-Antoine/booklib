<?php


namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/** Class BookController
 * @package App\Controller
 * @Route("/author")
 */
class AuthorController extends BaseController
{
    /**
     * @Route("/new", name="author_new")
     */
    public function new(Request $request)
    {
        $author = new Author();

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute("homepage");
        }

        return $this->render('author/new.html.twig', ['form' => $form->createView()]);
    }

}