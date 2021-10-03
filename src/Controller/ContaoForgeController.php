<?php

namespace lindesbs\ContaoForge\Controller;

use Contao\CoreBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;

class ContaoForgeController extends AbstractController
{

	private $kernel;

	public function __construct(KernelInterface  $kernel)
	{
		$this->kernel = $kernel;
	}



	public function getExportHTML(): string
	{
		$arrOutput = [];

		$arrOutput[] = "Seiten:";
		$arrOutput[] = "<hr>";



		return implode("", $arrOutput);
	}




}