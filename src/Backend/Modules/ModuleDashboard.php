<?php

namespace lindesbs\ContaoForge\Backend\Modules;

use Contao\BackendModule;
use Contao\Input;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Contao\System;
use lindesbs\ContaoForge\Controller\ContaoForgeController;

class ModuleDashboard extends BackendModule
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_contaoforge_dashboard';


	/**
	 * Generate the module
	 *
	 * @throws \Exception
	 */
	protected function compile()
	{
		$contaoForgeController = \Contao\System::getContainer()->get(ContaoForgeController::class);


		System::loadLanguageFile('tl_contaoforge_dashboard');

		$this->Template->content_export = $contaoForgeController->getExportHTML();
		$this->Template->job = "Job";
		$this->Template->description = "Aufgabe";

		$arrJobs = [
			[
				'job' => 'pages',
				'title' => "Seitenbaum sichern",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'articles',
				'title' => "Artikel und Inhalte sichern",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'themes',
				'title' => "Alle Themes",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'members',
				'title' => "Alle Mitarbeiter & Gruppen",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'users',
				'title' => "Alle BackendNutzer & Gruppen",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'themes',
				'title' => "Alle Themes sichern",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			],
			[
				'job' => 'files',
				'title' => "Alle Dateien sichern",
				'description' => "Vollstaendiges sichern des Seitenbaumes als <strong>.cf</strong> Datei"
			]
		];

		$this->Template->jobs = $arrJobs;

		$this->Template->submit = 'Exportieren';

		$this->Template->title_export = $GLOBALS['TL_LANG']['ContaoForge']['Backend']['title_export'];
		$this->Template->title_import = $GLOBALS['TL_LANG']['ContaoForge']['Backend']['title_import'];
		$this->Template->title = "ContaoForge :: Einfach arbeiten";

		$this->Template->submitKey = "tl_contao_forge_export";

		if (Input::post('FORM_SUBMIT') == $this->Template->submitKey)
		{

			dump($_POST);
			foreach (Input::findPost('export') as $job => $value)
			{

			}


			$encoders = [new XmlEncoder()];
			$normalizers = [new ObjectNormalizer()];

			$serializer = new Serializer($normalizers, $encoders);


			$arrTheme = $this->Database->prepare("SELECT * FROM tl_theme")
				->execute();

			dump($arrTheme->fetchAllAssoc());

die;

			$this->reload();


		}

	}
}

class_alias(ModuleDashboard::class, 'ModuleDashboard');