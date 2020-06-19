<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\News;
use App\Entity\Requests;
class ViewContentController extends AbstractController
{
    /**
     * @Route("/dstoi/{id}", name="app_page_content")
     */
    public function page($id, Request $req)
    {
        $res = $this->getDoctrine();
        // Если просмотр реквеста -> показать содержимое реквеста
        if($req->get('viewrequest') == 1)
        {
            $res = $res
                ->getRepository(Requests::class)
                ->findReqById($id);
        }
        // Иначе показать сожержимое новости
        else
        {
            $res = $res
                ->getRepository(News::class)
                ->findNewsById($id);
        }
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