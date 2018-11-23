<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findLast(6);
        $categories = $this->getDoctrine()->getRepository(Category::class)->findBy(array(),array('name' => 'ASC'));

        return $this->render('default/homepage.html.twig', [
            "books" => $books,
            "categories" => $categories
        ]);
    }

}