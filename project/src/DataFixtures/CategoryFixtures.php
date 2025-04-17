<?php 

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $categories = ['Nourriture', 'Transport', 'Santé', 'Divertissement', 'Services publics'];

        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->addReference('category_' . strtolower($categoryName), $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}

?>