<?php

namespace VisualChanges;

use MediaWiki\MediaWikiServices;

class Services {
	private MediaWikiServices $services;
	public function __construct( MediaWikiServices $services ) {
		$this->services = $services;
	}

	public function getByteDiffSizeFactory() : ByteDiffSizeFactory {
		return $this->services->getService( 'VisualChanges.ByteDiffSizeFactory' );
	}
}
