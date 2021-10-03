<?php



namespace lindesbs\ContaoForge\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use lindesbs\ContaoForge\ContaoForge;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoForge::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['ContaoForge']),
        ];
    }

	public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
	{
		$file = __DIR__.'/../Resources/config/routes.yaml';
		return $resolver->resolve($file)->load($file);
	}
}
