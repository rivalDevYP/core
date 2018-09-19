<?php
/**
 * ownCloud
 *
 * @author Artur Neumann <artur@jankaritech.com>
 * @copyright Copyright (c) 2017 Artur Neumann artur@jankaritech.com
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License,
 * as published by the Free Software Foundation;
 * either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;
use Page\SearchResultInOtherFoldersPage;
use Page\OwncloudPage;

require_once 'bootstrap.php';

/**
 * WebUI Search context.
 */
class WebUISearchContext extends RawMinkContext implements Context {
	/**
	 *
	 * @var SearchResultInOtherFoldersPage
	 */
	private $searchResultInOtherFoldersPage;
	/**
	 *
	 * @var OwncloudPage
	 */
	private $ownCloudPage;
	/**
	 *
	 * @var FeatureContext
	 */
	private $featureContext;

	/**
	 *
	 * @var WebUIGeneralContext
	 */
	private $webUIGeneralContext;

	/**
	 * WebUILoginContext constructor.
	 *
	 * @param SearchResultInOtherFoldersPage $searchResultInOtherFoldersPage
	 */
	public function __construct(
		OwncloudPage $ownCloudPage,
		SearchResultInOtherFoldersPage $searchResultInOtherFoldersPage
	) {
		$this->ownCloudPage = $ownCloudPage;
		$this->searchResultInOtherFoldersPage = $searchResultInOtherFoldersPage;
	}

	/**
	 * @When the user searches for :searchTerm using the webUI
	 *
	 * @param string $searchTerm
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function theUserSearchesUsingTheWebUI($searchTerm) {
		$this->ownCloudPage->waitTillPageIsLoaded($this->getSession());
		$this->ownCloudPage->search($this->getSession(), $searchTerm);
	}

	/**
	 * @Then the file :fileName with the path :path should be listed in the search results in other folders section on the webUI

	 * @param string $fileName
	 */
	public function theFileShouldBeListedSearchResultOtherFolders($fileName, $path) {
		$fileRow = $this->searchResultInOtherFoldersPage->findFileRowByNameAndPath(
			$fileName, $path, $this->getSession()
		);
		PHPUnit_Framework_Assert::assertNotNull(
			$fileRow, __METHOD__ .
			" could not find file with name:'$fileName' and path:'$path'"
		);
	}
	/**
	 * This will run before EVERY scenario.
	 * It will set the properties for this object.
	 *
	 * @BeforeScenario @webUI
	 *
	 * @param BeforeScenarioScope $scope
	 *
	 * @return void
	 */
	public function before(BeforeScenarioScope $scope) {
		// Get the environment
		$environment = $scope->getEnvironment();
		// Get all the contexts you need in this context
		$this->featureContext = $environment->getContext('FeatureContext');
		$this->webUIGeneralContext = $environment->getContext('WebUIGeneralContext');
	}
}
