<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\News;
class ViewContentController extends AbstractController
{
    /**
     * @Route("/dstoi/{id}", name="app_page_content")
     */
    public function page($id)
    {
        $res = $this->getDoctrine()
            ->getRepository(News::class)
            ->findNewsById($id);
        return $this->render(
            'page_content/page_con.html.twig',
            [
                'title' => $res[0]->getTitle(),
                'con_p' => $res
            ]
        );
    }
}
?>