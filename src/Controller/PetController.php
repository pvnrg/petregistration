<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Form\PetType;
use App\Repository\PetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class PetController extends AbstractController
{
    #[Route('/pets', name: 'pet_list')]
    public function index(PetRepository $petRepository): Response
    {
        return $this->render('pet/index.html.twig', [
            'pets' => $petRepository->findAll(),
        ]);
    }

    #[Route('/pet/new', name: 'pet_new')]
    public function new(Request $request, EntityManagerInterface $em)
    {
        $pet = new Pet();
        $form = $this->createForm(PetType::class, $pet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Determine dangerous breed
            $dangerousBreeds = ['Pitbull', 'Mastiff'];
            if (in_array($pet->getBreed(), $dangerousBreeds)) {
                $pet->setIsDangerousAnimal(true);
            }

            $em->persist($pet);
            $em->flush();

            return $this->redirectToRoute('pet_summary', ['id' => $pet->getId()]);
        }

        return $this->render('pet/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pet/{id}', name: 'pet_summary')]
    public function summary(int $id, PetRepository $petRepository)
    {
        $pet = $petRepository->find($id);
        
        if (!$pet) {
            throw $this->createNotFoundException('Pet not found.');
        }

        return $this->render('pet/summary.html.twig', [
            'pet' => $pet,
        ]);
    }

    #[Route('/pet/delete/{id}', name: 'pet_delete', methods: ['POST'])]
    public function delete(Pet $pet, EntityManagerInterface $em): Response
    {
        $em->remove($pet);
        $em->flush();

        return $this->redirectToRoute('pet_list');
    }

}
