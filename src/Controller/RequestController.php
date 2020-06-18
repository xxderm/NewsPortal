<?
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
class RequestController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("dstoi/append/request", name = "Req", methods={"GET"})
     */
    public function index()
    {
        return $this->render(
            'requests/request.html.twig',
            [
                'title' => 'Request'
            ]
        );
    }
}