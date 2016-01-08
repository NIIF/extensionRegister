<?php
namespace NIIF\ExtensionRegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use NIIF\ExtensionRegisterBundle\Entity\Extension;

class DefaultController extends Controller
{
    /**
     * @Route("/getExtension/{nameId}")
     * @Method("GET")
     */
    public function getExtensionAction($nameId)
    {
        // Authorization by IP address
        $enabled_ips = $this->container->getParameter('extension_register.enabled_ips');
        if (! in_array($_SERVER['REMOTE_ADDR'], $enabled_ips)) {
            throw $this->createAccessDeniedException(
                'You cant access this page form your IP address! '. $_SERVER['REMOTE_ADDR']
            );
        }
        $response = new JsonResponse();
        try {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NIIFExtensionRegisterBundle:Extension')->findOneByNameId($nameId);
            if (count($entity) == 0) {
                $entity = $this->createExtension($nameId);
            }
            $response->setData(
                array(
                    "success" => "true",
                    "data" => array(
                        "extension" => $entity->getExtension()
                    )
                )
            );
        } catch (\Exception $e) {
            $response->setStatusCode(507);
            $response->setData(
                array(
                    "succes" => "false",
                    "data" => $e->getMessage()
                )
            );
        }
        return $response;
    }

    /**
     * @Route("/getHealth")
     * @Template()
     */
    public function getHealthAction()
    {
        try {
            $next = $this->getNextExtension();
        } catch (\Exception $e) {
            if ($e->getCode() == 507) {
                return array(
                    'remainingExtensions' => 0
                );
            }
        }
        
        $last  = $this->container->getParameter('extension_register.last_extension');
        
        return array(
            'remainingExtensions' => $last - $next
        );
    }

    /**
     * Return the next extension.
     * @return integer next extension.
     */
    private function getNextExtension()
    {
        $first = $this->container->getParameter('extension_register.first_extension');
        $last  = $this->container->getParameter('extension_register.last_extension');
        
        $em = $this->getDoctrine()->getManager();
        
        $last_entity = $em->createQueryBuilder()
            ->select('e')
            ->from('NIIFExtensionRegisterBundle:Extension', 'e')
            ->orderBy('e.extension', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if (! $last_entity) {
            return $first;
        }

        $lastExtension = $last_entity->getExtension();
        
        if ($lastExtension >= $last) {
            throw new \Exception("There is no free extension", 507);
        }
        return $lastExtension + 1;
    }
    /**
     * Set new extension to user
     * @param  string $nameId nameId of the user
     * @return Extension the extension
     */
    private function createExtension($nameId)
    {
        $nextExtension = $this->getNextExtension();

        $entity = new Extension();
        $entity->setNameId($nameId);
        $entity->setLastLogin(new \DateTime());
        $entity->setExtension($nextExtension);

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        return $entity;
    }
}
