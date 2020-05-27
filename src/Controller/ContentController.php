<?
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Users;
use App\Entity\Entities;
use App\Entity\News;
use App\Entity\Requests;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
class ContentController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("dstoi/append", name = "append", methods={"GET"})
     */
    public function index(Request $req)
    {
        $usr = $this->session->get('object_symfony_session_usr');
        if(!isset($usr))
            return $this->redirect('/');
        // Delete news
        if(is_string($req->get('Remove')) )
        {
            $res = $this->getDoctrine()
                ->getRepository(News::class)
                ->findNewsById($req->get('Remove'));
            foreach ($res as $re)
            {
                // Find username in db && add to $res
                $users = $this->getDoctrine()
                    ->getRepository(Users::class)
                    ->findUserById($re->getUserId());
                $re->setUserId($users[0]->getName());
                $entities = $this->getDoctrine()
                    ->getRepository(Entities::class)
                    ->findEntitiesById($re->getEntityId());
                $re->setEntityId($entities[0]->getName());
            }
            if($res[0]->getUserId() == $usr->getName() or $usr->getName() == "Admin")
            {
                $entityManager = $this->getDoctrine()->getManager();
                $news = $entityManager
                    ->getRepository(News::class)
                    ->findNewsById($req->get('Remove'));
                $entityManager->remove($news[0]);
                $entityManager->flush();
            }
            return $this->redirect('/');
        }
        // Update news
        if(is_string($req->get('id')))
        {
            $res = $this->getDoctrine()
                ->getRepository(News::class)
                ->findNewsById($req->get('id'));
            foreach ($res as $re)
            {
                $users = $this->getDoctrine()
                    ->getRepository(Users::class)
                    ->findUserById($re->getUserId());
                $re->setUserId($users[0]->getName());
                $entities = $this->getDoctrine()
                    ->getRepository(Entities::class)
                    ->findEntitiesById($re->getEntityId());
                $re->setEntityId($entities[0]->getName());
            }
            if($res[0]->getUserId() == $usr->getName() or $usr->getName() == "Admin")
            {
                return $this->render(
                    'content_man/content_man.html.twig',
                    [
                        'title' => 'Content Manager',
                        'usr' => $usr,
                        'changecontent' => $res,
                    ]
                );
            }
            unset($res);
            return $this->redirect('/');
        }
        // Request | Append mode
        return $this->render(
            'content_man/content_man.html.twig',
            [
                'title' => 'Content Manager',
                'usr' => $usr,
                'changecontent' => False,
            ]
        );
    }
    /**
     * @Route("dstoi/append", name = "append", methods={"POST"})
     */
    public function postContent(Request $req)
    {
        // if not update
        if(!is_string($req->get('IsUpdate'))) {
            $em = $this->getDoctrine()->getManager();
            $vdata[] = $req->get('category');
            $vdata[] = $req->get('title');
            $vdata[] = $req->get('desc');
            $vdata[] = $req->get('append_data');
            $res = $this->getDoctrine()
                ->getRepository(Entities::class)
                ->findEntitiesByName($vdata[0]);
            $catId = $res[0]->getId();
            $usr = $this->session->get('object_symfony_session_usr');
            // id Admin ? -> append news
            if ($usr->getRoleId() == 2) {
                $news = new News();
                $news->setTitle($vdata[1]);
                $news->setDescription($vdata[2]);
                $news->setDate(date('Y-m-d G:i:s'));
                $news->setContent($vdata[3]);
                $news->setUserId($usr->getId());
                $news->setEntityId($catId);
                $em->persist($news);
                $em->flush();
            } elseif ($usr->getRoleId() == 1) {
                $reqr = new Requests();
                $reqr->setTitle($vdata[1]);
                $reqr->setDescription($vdata[2]);
                $reqr->setDate(date('Y-m-d G:i:s'));
                $reqr->setContent($vdata[3]);
                $reqr->setUserId($usr->getId());
                $reqr->setEntityId($catId);
                $em->persist($reqr);
                $em->flush();
            }
        }
        else
        {
            $res = $this->getDoctrine()
                ->getRepository(Entities::class)
                ->findEntitiesByName($req->get('category'));
            $catId = $res[0]->getId();
            $usr = $this->session->get('object_symfony_session_usr');
            $id = $req->get('IsUpdate');
            $em = $this->getDoctrine()->getManager();
            $currNews = $em->getRepository(News::class)->findNewsById($id);
            $currNews[0]->setTitle($req->get('title'));
            $currNews[0]->setDescription($req->get('desc'));
            $currNews[0]->setDate(date('Y-m-d G:i:s'));
            $currNews[0]->setContent($req->get('append_data'));
            $currNews[0]->setUserId($usr->getId());
            $currNews[0]->setEntityId($catId);
            $em->flush();
        }
        return $this->redirect('/');
    }
}