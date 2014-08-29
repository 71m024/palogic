<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Megogo\Bundle\MultipleInheritanceBundle\HttpKernel\BundleInheritanceKernel as BaseKernel;

class AppKernel extends BaseKernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new PaLogic\Bundle\AppBundle\PaLogicAppBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new PaLogic\Bundle\BlogBundle\PaLogicBlogBundle(),
            new PaLogic\Bundle\AdminBundle\PaLogicAdminBundle(),
            new PaLogic\Bundle\SecurityBundle\PaLogicSecurityBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\jQueryBundle\SonatajQueryBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\MarkItUpBundle\SonataMarkItUpBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Boxenmieten\Bundle\AppBundle\BoxenmietenAppBundle(),
            new Megogo\Bundle\MultipleInheritanceBundle\MultipleInheritanceBundle($this),
            new DjCrowd\Bundle\AppBundle\DjCrowdAppBundle(),
            new Boxenmieten\Bundle\BlogBundle\BoxenmietenBlogBundle(),
            new DjCrowd\Bundle\BlogBundle\DjCrowdBlogBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new PaLogic\Bundle\UserBundle\PaLogicUserBundle(),
            new DjCrowd\Bundle\UserBundle\DjCrowdUserBundle(),
            new PaLogic\Bundle\DjBundle\PaLogicDjBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new DjCrowd\Bundle\DjBundle\DjCrowdDjBundle(),
            new PaLogic\Bundle\ImageBundle\PaLogicImageBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
