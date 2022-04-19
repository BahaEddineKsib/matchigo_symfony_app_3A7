<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Utilisateur;
use App\Form\ReclamationType;
use App\Repository\BlogRepository;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ReCaptcha\ReCaptcha; // Include the recaptcha lib


/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="app_reclamation_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager,ReclamationRepository $rep): Response
    {
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();
            /*
            $rep->findByExampleField(51);
        */
        $reclamationEAtt=$rep->countEnAttent();
        $reclamationTraite=$rep->counttraite();
        $reclamationTot=$rep->countall();


        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
            'reclamationEAtt'=>$reclamationEAtt,
            'reclamationTraite'=>$reclamationTraite,
            'reclamationTot'=>$reclamationTot,

        ]);
    }

    /**
     * @Route("/new", name="app_reclamation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,ReclamationRepository $rep,\Swift_Mailer $mailer,FlashyNotifier $flashy): Response
    {


        $user=new Utilisateur();
        $user=$entityManager->getRepository(Utilisateur::class)->find(51);
        $random = random_bytes(8);

        $reclamation = new Reclamation();
        $rec=new Reclamation();
        $rec=$rep->findByExampleField(51);



        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($_POST['submit'])) {
                $secret = "6Ldwe3kfAAAAABR7mqR1DkVXIqsjvzo5LPLvhSQo";
                $response = $_POST['g-recaptcha-response'];
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
                $data = file_get_contents($url);
                $row = json_decode($data, true);


                if ($row['success'] == "true") {

                    $reclamation->setUser($user);
                    $reclamation->setEtat('en attent');
                    $reclamation->setDate(new \DateTime('now'));
                    $reclamation->setRecReference($random);
                    $entityManager->persist($reclamation);
                    $entityManager->flush();

                    $msg = (new \Swift_Message('Reclamation ♥'))
                        ->setFrom('mootez.mejdoub@esprit.tn')
                        ->setTo($user->getEmail())
                        ->setBody('Votre demande sera prise en compte et nous vous répondrons dans les meilleurs délais.
 Vous serez notifiés via une maill les details de traitement de votre reclamation
 Merci !!');
                    $mailer->send($msg);

                    $flashy->success('Reclamation envoyee !');

                    return $this->redirectToRoute('app_reclamation_new', [], Response::HTTP_SEE_OTHER);
                }
                else


                $flashy->error('Captcha is Required!');
            }
        }



        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
            'rec'=>$rec,
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}", name="app_reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {

        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager,$id): Response
    {

        $reclamation=$entityManager->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reclamation_delete", methods={"POST"})
     */
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/stats/admin", name="app_reclamation_stats")
     */
    public function stats(EntityManagerInterface $entityManager,ReclamationRepository $rep,BlogRepository $blogrep){
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        $reclamationEAtt=$rep->countEnAttent();
        $reclamationTraite=$rep->counttraite();
        $reclamationTot=$rep->countall();
        $sousse=$blogrep->countSousse();
        $bizerte=$blogrep->countBizerte();
        $tozeur=$blogrep->countTozeur();
        $kef=$blogrep->countKef();
        $mehdia=$blogrep->countMahdia();
        $nabeul=$blogrep->countNabeul();

        return $this->render('reclamation/statistics.html.twig', [
            'reclamations' => $reclamations,
            'reclamationEAtt'=>$reclamationEAtt,
            'reclamationTraite'=>$reclamationTraite,
            'reclamationTot'=>$reclamationTot,
            'mehdia'=> $mehdia,
            'kef'=>$kef,
            'tozeur'=>$tozeur,
            'bizerte'=>$bizerte,
            'nabeul'=>$nabeul,
            'sousse'=>$sousse,


        ]);
    }



}
