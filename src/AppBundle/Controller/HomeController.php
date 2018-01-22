<?php
/**
 * Created by PhpStorm.
 * User: charlotteprieur
 * Date: 22/01/2018
 * Time: 17:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package AppBundle\Controller
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findBy([], ['updatedDate' => 'DESC'], 10);

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/article/{slug}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {
        return $this->render('article/show.html.twig', array(
            'article' => $article,
        ));
    }

}