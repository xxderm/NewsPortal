<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entities;
use App\Entity\Users;
use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class HomeController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/home/")
     */
    public function index(Request $req)
    {
        $res = $this->getDoctrine();
        // Если поиск по категории:
        if(! is_null($req->get('Category')))
        {
            $entities = $this->getDoctrine()
                ->getRepository(Entities::class)
                ->findEntitiesByName($req->get('Category'));
            $res = $res->getRepository(News::class)->findNewsByEntityID($entities[0]->getId());
        }
        else
        {
            $res = $res->getRepository(News::class)->findAllNews();
        }		
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

        //$data_file = 'http://api.openweathermap.org/data/2.5/weather?q=magnitogorsk&units=metric&APPID=6c7a8ba74435652b4c9d56dca00e0fc8';
        //$j = file_get_contents($data_file);
        // //$data = json_decode($j);
        //json_decode($j);
        //var_dump(json_decode($j, true)["main"]["temp"]);
        //echo $j["temp"];
        //die();

        return $this->render(
            'home/home.html.twig',
            [
                'title' => 'Home',
                'conn' => $res
            ]
        );
    }
    public function getNavContent()
    {
        $NavContentArray = [];
        foreach($this->getDoctrine()
                    ->getRepository(Entities::class)
                    ->findAll() as $value) {
            $NavContentArray[] = ['Name' => $value->getName()];
            $NavContentArray[] = ['id' => $value->getId()];
        }
        return $NavContentArray;
    }
}
?>