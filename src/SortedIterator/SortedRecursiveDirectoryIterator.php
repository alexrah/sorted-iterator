<?php
namespace SortedIterator;

class SortedRecursiveDirectoryIterator {

	/**
	 * @param array $aDirs array of absolute path dirs
	 */
	public function __construct(array $aDirs) {

		try {
			$aFiles = [];

			foreach ($aDirs as $sDir){
				$oDirectory = new \RecursiveDirectoryIterator( $sDir );
				$oIterator   = new \RecursiveIteratorIterator($oDirectory);
				$oIteratorSorted = new SortedIterator($oIterator);

				/** @var \SplFileInfo $oInfo */
				foreach ($oIteratorSorted as $oInfo) {
					if ( $oInfo->getFilename() == "." || $oInfo->getFilename() == "..") continue;

					$aFiles[] = $oInfo->getPathName();
				}
			}

			foreach ($aFiles as $sFile)
			{
				include_once $sFile;
			}
		} catch (\Exception $exception){

			error_log( 'PHP Warning:  '. $exception->getMessage() . ' in ' . $exception->getFile() . ' on line '. $exception->getLine());

		}

	}

}