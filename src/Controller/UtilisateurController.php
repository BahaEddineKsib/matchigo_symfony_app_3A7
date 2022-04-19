<?php


namespace App\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use  App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Form\FormSType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/utilisateur")
 */

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="app_utilisateur_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $utilisateurs = $entityManager
            ->getRepository(Utilisateur::class)
            ->findAll();

        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }


    /**
     * @Route("/new", name="app_utilisateur_new", methods={"GET", "POST"})
     */
    public function new(UserPasswordEncoderInterface $encoder,Request $request, EntityManagerInterface $entityManager): Response
    {

        $utilisateur = new Utilisateur();
        $form = $this->createForm(FormSType::class, $utilisateur);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $passwordEncoded = $encoder->encodePassword($utilisateur, $form->get('mdp')->getData());
            $utilisateur->setMdp($passwordEncoded);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            $session = $this->get('session'); //peut-être ça pour créer une variable de session
            $session->set('id', $utilisateur->getId());
            $session->set('nom', $utilisateur->getNom());
            $session->set('prenom', $utilisateur->getPrenom());




            return $this->redirectToRoute('app_utilisateur_showf', ['id' => $session->get('id')], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,

            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/front/{id}", name="app_utilisateur_showf", methods={"GET"})
     */
    public function showf(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/user.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_utilisateur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_index', ['id' => $utilisateur->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit/front", name="app_utilisateur_useredit", methods={"GET", "POST"})
     */
    public function edit2(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_showf', ['id' => $utilisateur->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/useredit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_utilisateur_delete", methods={"POST"})
     */
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
    public function searchAction(Request  $request)
    {
$em=$this->getDoctrine()->getManager();
$requestString =$request->get('q');
$users=$em->getRepository('App:Post')->findEntitiesByString($requestString);
  if(!$users)
  {
      $result['users']['error']="User not found";
  }
  else
  {
      $result['users']=$this->getRealEntities($users);

  }
  return new Response(json_encode($result));

    }

    public function getRealEntitsies($users)
    {
        foreach ($users as $users)
        {
            $realEntities[$users->getId()]=[$users->getNom(),$users->getPrenom()];
        }
        return $realEntities;
    }
}

