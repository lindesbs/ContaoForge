<?php

class AbstractJobs
{

	private $jobKey;
	private $title;
	private $description;

	private $kernel;

	/**
	 * @param $kernel
	 */
	public function __construct(\Symfony\Component\HttpKernel\KernelInterface  $kernel)
	{
		$this->kernel = $kernel;
	}


	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $title
	 */
	public function setTitle($title): void
	{
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription($description): void
	{
		$this->description = $description;
	}

	/**
	 * @return mixed
	 */
	public function getJobKey()
	{
		return $this->jobKey;
	}

	/**
	 * @param mixed $jobKey
	 */
	public function setJobKey($jobKey): void
	{
		$this->jobKey = $jobKey;
	}





	public function export(): string
	{

		return "nothing";

	}

	public function import(string $data): string
	{

		return "nothing";
	}



}