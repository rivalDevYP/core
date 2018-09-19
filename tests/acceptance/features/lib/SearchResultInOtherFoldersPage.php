<?php
/**
 * ownCloud
 *
 * @author Artur Neumann <artur@jankaritech.com>
 * @copyright Copyright (c) 2018 Artur Neumann artur@jankaritech.com
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

namespace Page;

/**
 * Page that shows the search results.
 */
class SearchResultInOtherFoldersPage extends FilesPageBasic {
	protected $emptyContentXpath = ".//div[@id='searchresults']//div[@class='emptycontent']";
	protected $fileListXpath = ".//div[@id='searchresults']//tbody";
	
	protected function getEmptyContentXpath() {
		return $this->emptyContentXpath;
	}

	protected function getFileNameMatchXpath() {
	}

	protected function getFileNamesXpath() {
	}

	protected function getFileListXpath() {
		return $this->fileListXpath;
	}
}
