<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadApplication.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Application;

class LoadApplication implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // on va enregistrer 3 applications pour avoir un peu de matière
        for ($i = 0; $i < 3; $i++) {
            // Création de l'entité Advert
            $advert = new Advert();
            // ajout d'un chiffre aléatoire en fin de chaîne pour contourner la contrainte unique sur nos données de test :p
            $advert->setTitle('Recherche développeur Symfony2. ' . mt_rand(100, 200));
            $advert->setAuthor('Plop');
            $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");
            
            // Création de l'entité Image
            $image = new Image();
            $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
            $image->setAlt('Job de rêve');
            
            // On lie l'image à l'annonce
            $advert->setImage($image);
            
            // on postule à l'annonce
            $application = new Application();
            $application->setAuthor('Toto ' . mt_rand(10, 30));
            $application->setContent('Je postule à cette super offre parce que je le vaux bien');
            $application->setAdvert($advert);
            
            // et on persiste le tout !
            $manager->persist($advert);
            $manager->persist($application);
        }
        
        $manager->flush();
    }
}