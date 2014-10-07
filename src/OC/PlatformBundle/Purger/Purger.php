<?php
namespace OC\PlatformBundle\Purger;

use Doctrine\ORM\EntityManagerInterface;

class Purger
{
    protected $_em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }
    
    public function purge($days)
    {
        return $this->_em->getRepository('OCPlatformBundle:Advert')->purge($days);
    }
}
