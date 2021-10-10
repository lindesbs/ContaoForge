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
		$projectDir = System::getContainer()->getParameter('kernel.project_dir');


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

			foreach (Input::findPost('export') as $job => $value)
			{

			}


			$encoders = [new XmlEncoder(), new JsonEncoder()];
			$normalizers = [new ObjectNormalizer()];

			$serializer = new Serializer($normalizers, $encoders);

			$this->loadDataContainer('tl_theme');
			$objTheme = $this->Database->prepare("SELECT * FROM tl_theme")->execute();

			$arrData = [];

			while($objTheme->next())
			{

				$arrTheme = [
					'theme' => $objTheme->row(),
				];


				foreach ($GLOBALS['TL_DCA']['tl_theme']['config']['ctable'] as $table)
				{
					$this->loadDataContainer($table);
					$objModules = $this->Database->prepare(sprintf("SELECT * FROM %s WHERE pid=%s",$table,$objTheme->id))->execute();


					if ($objModules)
					{
						while ($objModules->next())
						{
							if (!array_key_exists('_'.$table,$arrTheme))
								$arrTheme['_'.$table]=[];

							$arrTheme['_'.$table][$objModules->id] = $objModules->row();
						}
					}
				}

				$arrData[] = $arrTheme;

			}




			$context = [
				'xml_format_output' => true,
				'xml_encoding'	=> 'utf-8',
				'as_collection' => true
			];

			$xmlData = $serializer->serialize($arrData, "xml", $context);
			file_put_contents($projectDir."/testing.xml", $xmlData);


			$this->reload();


		}

	}
}

class_alias(ModuleDashboard::class, 'ModuleDashboard');