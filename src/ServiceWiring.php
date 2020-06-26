<?php
namespace VisualChanges;

use MediaWiki\Config\ServiceOptions;
use MediaWiki\MediaWikiServices;

return [
	'VisualChanges.ByteDiffSizeFactory' => function ( MediaWikiServices $services ) : ByteDiffSizeFactory {
		return new ByteDiffSizeFactory(
			new ServiceOptions(
				ByteDiffSizeFactory::CONSTRUCTOR_OPTIONS,
				$services->getMainConfig()
			)
		);
	}
];
