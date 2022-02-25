<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobFormType;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="job_list", methods={"GET"})
     */
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findNoneExpiredJobs();
        return $this->render('job/list.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/job/{id}", name="job_show", methods={"GET"}, requirements={"id" : "\d+"})
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }

    /**
     * @Route("/job/new", name="job_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $job = new Job();
        $form = $this->createForm(JobFormType::class, $job);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($job);
            $entityManager->flush();
            $this->redirectToRoute('job_list');
        }
        return $this->renderForm('job/new.html.twig',[ 'form' => $form]);
    }
}
