<?
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class ProfileController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("dstoi/Profile", name = "Profile")
     */
    public function index()
    {
        $usr = $this->session->get('object_symfony_session_usr');
        return $this->render(
            'profile/profile.html.twig',
            [
                'title' => 'Profile',
                'usr' => $usr
            ]
        );
    }
}