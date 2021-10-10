<?php

class ThemeJob extends AbstractJobs
{

	private $arrData;


	public function __construct(\Symfony\Component\HttpKernel\KernelInterface $kernel)
	{
		parent::__construct($kernel);

		$this->setJobKey("themes");
		$this->setTitle("ThemeInterface");
		$this->setDescription("noe");
	}


}