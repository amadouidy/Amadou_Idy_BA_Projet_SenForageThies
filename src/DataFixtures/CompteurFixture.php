<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Compteur;

class CompteurFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
         for($i=1; $i <=5; $i++) {
        $compteur=new Compteur();
        $compteur->setNumeroCompteur("123CA001")
        		 ->setAncienReleve(120)
        		 ->setNouveauReleve(80)
        		 ->setDateReleve(new \DateTime())
        		 ->setConsommation(40);
		$manager->persist($compteur);
	}
        $manager->flush();
    }
}
