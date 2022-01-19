<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/", name="job_list")
     */
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findNoneExpiredJobs();
        return $this->render('job/list.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/job/{id}", name="job_show")
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }
}
