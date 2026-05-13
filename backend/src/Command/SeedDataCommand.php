<?php

namespace App\Command;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Event;
use App\Entity\Inscription;
use App\Entity\Journal\EntreeJournal;
use App\Entity\Journal\Habitude;
use App\Entity\Tag;
use App\Entity\TypeEvent;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:seed-data',
    description: 'Seed the database with initial demo data for all modules',
)]
class SeedDataCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Seeding InnerTrack Database');

        // 1. SEED USERS
        $users = [];
        
        $admin = new User();
        $admin->setEmail('admin@innertrack.com')
            ->setFirstName('Admin')
            ->setLastName('InnerTrack')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($admin, 'admin123'))
            ->setIsVerified(true);
        $this->em->persist($admin);
        $users['admin'] = $admin;

        $therapist = new User();
        $therapist->setEmail('therapist@innertrack.com')
            ->setFirstName('Sarah')
            ->setLastName('Johnson')
            ->setRoles(['ROLE_PSYCHOLOGUE'])
            ->setPassword($this->hasher->hashPassword($therapist, 'psy123'))
            ->setIsVerified(true);
        $this->em->persist($therapist);
        $users['therapist'] = $therapist;

        $patient = new User();
        $patient->setEmail('patient@innertrack.com')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($patient, 'user123'))
            ->setIsVerified(true);
        $this->em->persist($patient);
        $users['patient'] = $patient;

        $io->text('Created users: admin, therapist, patient.');

        // 2. SEED CATEGORIES & TAGS
        $cats = [];
        foreach (['Psychologie', 'Bien-être', 'Méditation', 'Nutrition'] as $name) {
            $cat = new Categorie();
            $cat->setNom($name);
            $cat->setDescription('Description pour ' . $name);
            $this->em->persist($cat);
            $cats[] = $cat;
        }

        $tags = [];
        foreach (['Stress', 'Anxiété', 'Bonheur', 'Sommeil'] as $name) {
            $tag = new Tag();
            $tag->setNom($name);
            $this->em->persist($tag);
            $tags[] = $tag;
        }

        // 3. SEED ARTICLES
        for ($i = 1; $i <= 5; $i++) {
            $article = new Article();
            $article->setTitre('Article Demo #' . $i)
                ->setContenu('Ceci est le contenu détaillé de l\'article numéro ' . $i . '. Il traite de sujets importants pour la santé mentale et le bien-être au quotidien.')
                ->setAuteur($therapist)
                ->setCategorie($cats[array_rand($cats)])
                ->addTag($tags[array_rand($tags)]);
            $this->em->persist($article);
        }
        $io->text('Created 5 demo articles.');

        // 4. SEED EVENTS
        $eventNames = [
            ['Titre' => 'Conférence sur l\'Anxiété', 'Type' => TypeEvent::CONFERENCE],
            ['Titre' => 'Atelier Méditation', 'Type' => TypeEvent::ATELIER],
            ['Titre' => 'Forum Santé Mentale', 'Type' => TypeEvent::FORUM],
        ];

        foreach ($eventNames as $data) {
            $event = new Event();
            $event->setTitre($data['Titre'])
                ->setDescription('Une session interactive pour discuter de ' . $data['Titre'])
                ->setDate(new \DateTime('+'.rand(1, 30).' days'))
                ->setType($data['Type'])
                ->setCapacite(20)
                ->setStatut(true);
            $this->em->persist($event);

            // Add some inscriptions
            $ins = new Inscription();
            $ins->setEvenement($event)
                ->setNomParticipant($patient->getFirstName() . ' ' . $patient->getLastName())
                ->setEmailParticipant($patient->getEmail())
                ->setStatut(Inscription::STATUS_CONFIRMED);
            $this->em->persist($ins);
        }
        $io->text('Created events and inscriptions.');

        // 5. SEED JOURNAL ENTRIES
        for ($i = 0; $i < 3; $i++) {
            $entry = new EntreeJournal();
            $entry->setUser($patient)
                ->setHumeur(rand(1, 5))
                ->setNoteTextuelle('Aujourd\'hui, je me sens ' . (['bien', 'moyen', 'fatigué'][$i]) . '. J\'ai réussi à faire mes exercices.')
                ->setDateSaisie(new \DateTime('-'.$i.' days'));
            $this->em->persist($entry);
        }

        $habit = new Habitude();
        $habit->setUser($patient)
            ->setNom('Méditation quotidienne')
            ->setFrequence('Quotidien')
            ->setObjectif(10)
            ->setUnite('minutes');
        $this->em->persist($habit);
        $io->text('Created journal entries and habits.');

        $this->em->flush();

        $io->success('Database successfully seeded!');

        return Command::SUCCESS;
    }
}
