<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
        ];
    }       

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $expense = new Expense();
            $expense->setMontant($faker->randomFloat(2, 10, 1000)); // Choisir un montant aléatoire entre 10 et 1000 (avec 2 décimales max)
            $expense->setDescription($faker->paragraph());
            $expense->setDate($faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d')); // Si je ne met pas de format, ça ne fonctionne pas

            $user = $this->getReference('user_' . $faker->numberBetween(1, 10), UserFixtures::class); // Récupérer un utilisateur aléatoire
            $expense->setUser($user);

            $category = $this->getReference('category_' . $faker->randomElement(['nourriture', 'transport', 'sante', 'divertissement', 'services publics']), CategoryFixtures::class); // Récupérer une catégorie aléatoire
            $expense->setCategory($category);
            $this->addReference('expense_' . $i, $expense); // Ajouter une référence pour chaque dépense

            $manager->persist($expense);
        }

        $manager->flush();
    }
}


