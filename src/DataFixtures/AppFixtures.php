<?php

namespace App\DataFixtures;

use App\Entity\Aluno;
use App\Entity\Produtos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i =1; $i <= 50; $i++){
            $produto = new Aluno();
            $produto->setNome("Produto -" . $i);
            $produto->setEmail("Descricao do produto " . $i);
            $produto->setMatricula($i);

            $manager->persist($produto);
        }

        $manager->flush();
    }
}
