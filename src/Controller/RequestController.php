<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entities;
use App\Entity\Requests;
use App\Entity\Users;
use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class RequestController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("dstoi/request", name = "Req", methods={"GET"})
     */
    public function index()
    {
        // Если сессия пользователя == null -> редирект на главную
        if(is_null($this->session->get('object_symfony_session_usr')))
            return $this->redirect('/');
        // Если роль - Админ -> Показать реквесты
        if($this->session->get('object_symfony_session_usr')->getRoleId() == 2)
        {
            $rvec = $this
                ->getDoctrine()
                ->getRepository(Requests::class)
                ->findAllReq();

            // Для каждого реквеста
            foreach ($rvec as $rv)
            {
                $users = $this->getDoctrine()
                    ->getRepository(Users::class)
                    ->findUserById($rv->getUserId());

                if(isset($users[0]))
                    $rv->setUserId($users[0]->getName());
                else
                    $rv->setUserId("DELETED USER");

                $entities = $this->getDoctrine()
                    ->getRepository(Entities::class)
                    ->findEntitiesById($rv->getEntityId());
                $rv->setEntityId($entities[0]->getName());
            }

            return $this->render(
                'requests/request.html.twig',
                [
                    'title' => 'Request',
                    'req_vec' => $rvec
                ]
            );
        }
        else
        {
            return $this->redirect('/');
        }
    }
}
?>