<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Rezzza\RestApiBehatExtension\Rest\RestApiBrowser;
use Rezzza\RestApiBehatExtension\Json\JsonInspector;

use Symfony\Component\HttpFoundation\Session\Session;

use NIIF\ExtensionRegisterBundle\Entity\Extension;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    private $restApiBrowser;

    private $jsonInspector;

    use \Behat\Symfony2Extension\Context\KernelDictionary;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(Session $session, $simpleArg)
    {
        // $session is your Symfony2 @session

        // $this->restApiBrowser = $restApiBrowser;
        // $this->jsonInspector = $jsonInspector;
    }

    /**
     * @Given the database is clean
     */
    public function theDatabaseIsClean()
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->createQuery('DELETE NIIFExtensionRegisterBundle:Extension')->execute();
        $em->flush();
    }

    /**
     * @Given there are extensions:
     */
    public function thereAreExtensions(TableNode $table)
    {
        foreach ($table->getHash() as $hash) {
            $extension = new Extension();
            $extension->setNameId($hash['nameId']);
            $extension->setExtension($hash['extension']);
            $extension->setLastLogin(new \DateTime($hash['lastLogin']));

            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $em->persist($extension);
        }
        $em->flush();
    }
}
