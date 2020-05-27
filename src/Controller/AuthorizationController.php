<?
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Entities;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
class AuthorizationController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/SignUp/")
     */
    public function getSignUp()
    {
        $error = "";
        if(isset($_GET['error']))
            $error = $_GET['error'];
        return $this->render(
            'signup/signup.html.twig',
            [
                'title' => 'SignUp',
                'error' => $error,
                'ValidationError' => false
            ]
        );
    }
    public function postSignUp(Request $req, ValidatorInterface $validator)
    {
        $submit = $req->request->get('token');
        if($this->isCsrfTokenValid('signup', $submit)) {
            $em = $this->getDoctrine()->getManager();

            $res = $this->getDoctrine()
                ->getRepository(Users::class)
                ->findUserByName($req->get('username'));
            if (is_array($res))
                foreach ($res as $item) {
                    if ($item->getName() == $req->get('username')) {
                        return $this->redirect('./SignUp?error=This name already exists.');
                    }
                }
            $user = new Users();
            $user->setName($req->get('username'));
            $user->setEmail($req->get('email'));
            $user->setPassword($req->get('password'));
            $user->setRoleId(1);
            $user->setRegDate(date('Y-m-d G:i:s'));

            $errors = $validator->validate($user);
            if(count($errors) > 0)
            {
                return $this->render(
                    'signup/signup.html.twig',
                    [
                        'title' => 'SignUp',
                        'error' => $errors,
                        'ValidationError' => true,
                    ]
                );
            }

            $em->persist($user);
            $em->flush();
            $this->postSignIn($req);
            return $this->redirect('/');
        }
        return $this->redirect('./SignUp?error=Csrf token invalid.');
    }
    /**
     * @Route("/SignIn/")
     */
    public function getSignIn()
    {
        $error = "";
        if(isset($_GET['error']))
            $error = $_GET['error'];
        return $this->render(
            'signin/signin.html.twig',
            [
                'title' => 'SignIn',
                'error' => $error,
                'ValidationError' => false
            ]
        );
    }
    public function logOut()
    {
        $this->session->remove('object_symfony_session_usr');
        return $this->redirect('/');
    }
    public function postSignIn(Request $req)
    {
        $submit = $req->request->get('token');
        if($this->isCsrfTokenValid('signin', $submit))
        {
            $username = $req->get('username');
            $password = $req->get('password');
            $res = $this->getDoctrine()
                ->getRepository(Users::class)
                ->findUserByPasswordHash($password);

            foreach ($res as $re)
                if($re->getName() == $username)
                {
                    $this->session->set('object_symfony_session_usr', $re);
                    return $this->redirect('/');
                }

            return $this->redirect('./SignIn?error=Incorrect login or password.');
        }
        return $this->redirect('./SignIn?error=Csrf token invalid.');
    }
}