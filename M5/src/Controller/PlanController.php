<?php

namespace App\Controller;

use App\Entity\Plan;
use App\Entity\PlanImage;
use App\Entity\PlanPlace;
use App\Form\PlanImageType;
use App\Form\PlanPlaceType;
use App\Form\PlanType;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plan")
 */
class PlanController extends AbstractController
{
    /**
     * @Route("/", name="app_plan_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $planImages = $entityManager
            ->getRepository(PlanImage::class)
            ->findAll();
        $plans = $entityManager
            ->getRepository(Plan::class)
            ->findAll();

        if(Plan::__SESSION__ == "ADMIN")
        {
            return $this->render('plan/back_office/index.html.twig', [
                'plans' => $plans,
                ]);
        }
        elseif(Plan::__SESSION__ == "CLIENT")
        {

            return $this->render('plan/front_office/client/index.html.twig', [
                'plans' => $plans,
                'planImages' => $planImages]);
        }
        elseif(Plan::__SESSION__ == "GUIDE")
        {
            $plans = $entityManager
                ->getRepository(Plan::class)
                ->findBy(array('idguide'=>60));

            return $this->render('plan/front_office/guide/index.html.twig', [
                'plans' => $plans,
                'planImages' => $planImages]);
        }
        else
        {
            return $this->render('sign in / sign up');
        }


    }

    /**
     * @Route("/new", name="app_plan_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,FlashyNotifier $flashy): Response
    {
        $plan = new Plan();
        $plan->setNote(0);
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plan->setNmbrplacesreste($plan->getNmbrplacesmax());
            $entityManager->persist($plan);
            $entityManager->flush();
            $flashy->success('Plan: '.$plan->getTitre(). "ajouter avec succes");
            return $this->redirectToRoute('app_plan_index', [], Response::HTTP_SEE_OTHER);
        }
        if(Plan::__SESSION__ == "ADMIN")
        {
            return $this->render('plan/back_office/new.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),
            ]);
        }
        elseif(Plan::__SESSION__ == "CLIENT")
        {
            return $this->render('plan/front_office/client/new.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),
            ]);
        }
        elseif(Plan::__SESSION__ == "GUIDE")
        {

            return $this->render('plan/front_office/guide/new.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),
            ]);
        }
        else
        {
            return $this->render('sign in / sign up');
        }

    }

    /**
     * @Route("/{id}", name="app_plan_show", methods={"GET", "POST"}))
     */
    public function show(Request $request, EntityManagerInterface $entityManager ,Plan $plan,FlashyNotifier $flashy): Response
    {
        $planPlace = new PlanPlace();
        $planPlace->setIdplan($plan);
        $planPlaceForm = $this->createForm(PlanPlaceType::class, $planPlace);
        $planPlaces = $entityManager
            ->getRepository(PlanPlace::class)
            ->findBy(array('idplan'=>$plan));

        $planImage = new PlanImage();
        $planImage->setIdplan($plan);
        $planImageForm = $this->createForm(PlanImageType::class, $planImage);
        $planImages = $entityManager
            ->getRepository(PlanImage::class)
            ->findBy(array('idplan'=>$plan));

        if(Plan::__SESSION__ == "ADMIN")
        {
            return $this->render('plan/back_office/show.html.twig', [
                'plan'          => $plan,
                'planPlaces'    => $planPlaces,
                'planPlaceForm' => $planPlaceForm->createView(),
                'planImages'    => $planImages,
                'planImageForm' => $planImageForm->createView()
            ]);
        }
        elseif(Plan::__SESSION__ == "CLIENT")
        {
            return $this->render('plan/front_office/client/show.html.twig', [
                'plan'          => $plan,
                'planPlaces'    => $planPlaces,
                'planPlaceForm' => $planPlaceForm->createView(),
                'planImages'    => $planImages,
                'planImageForm' => $planImageForm->createView()
            ]);
        }
        elseif(Plan::__SESSION__ == "GUIDE")
        {
            return $this->render('plan/front_office/guide/show.html.twig', [
                'plan'          => $plan,
                'planPlaces'    => $planPlaces,
                'planPlaceForm' => $planPlaceForm->createView(),
                'planImages'    => $planImages,
                'planImageForm' => $planImageForm->createView()
            ]);
        }
        else
        {
            return $this->render('sign in / sign up');
        }

    }

    /**
     * @Route("/{id}/edit", name="app_plan_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Plan $plan, EntityManagerInterface $entityManager,FlashyNotifier $flashy): Response
    {
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flashy->success('Modifier Plan: '.$plan->getTitre());
            $entityManager->flush();

            return $this->redirectToRoute('app_plan_index', [], Response::HTTP_SEE_OTHER);
        }
        if(Plan::__SESSION__ == "ADMIN")
        {
            return $this->render('plan/back_office/edit.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),
            ]);
        }
        elseif(Plan::__SESSION__ == "CLIENT")
        {

            return $this->render('plan/front_office/client/edit.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),

            ]);
        }
        elseif(Plan::__SESSION__ == "GUIDE")
        {
            $planImages = $entityManager
                ->getRepository(PlanImage::class)
                ->findBy(array('idplan'=>$plan));
            return $this->render('plan/front_office/guide/edit.html.twig', [
                'plan' => $plan,
                'form' => $form->createView(),
                'planImages' => $planImages
            ]);
        }
        else
        {
            return $this->render('sign in / sign up');
        }

    }

    /**
     * @Route("/delete/{id}", name="app_plan_delete", methods={"POST"})
     */
    public function delete(Request $request, Plan $plan, EntityManagerInterface $entityManager,FlashyNotifier $flashy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plan->getId(), $request->request->get('_token'))) {
            $flashy->error(' Plan: '.$plan->getTitre().' est supprimer');
            $entityManager->remove($plan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plan_index', [], Response::HTTP_SEE_OTHER);
    }
}
