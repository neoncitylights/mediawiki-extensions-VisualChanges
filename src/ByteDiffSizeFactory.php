<?php

namespace VisualChanges;

use MediaWiki\Config\ServiceOptions;
use MediaWiki\Revision\RevisionRecord;

class ByteDiffSizeFactory {
	public const CONSTRUCTOR_OPTIONS = [
		'RCChangedSizeThreshold'
	];

	private ServiceOptions $options;
	public function __construct( ServiceOptions $options ) {
		$this->options = $options;
	}

	public function newFromRevisions( RevisionRecord $currentRevision, ?RevisionRecord $previousRevision ) {
		$currentSize = $currentRevision->getSize();
		$previousSize = isset( $previousRevision ) ? $previousRevision->getSize() : 0;

		return new ByteDiffSize(
			$currentSize,
			$previousSize,
			$this->options->get( 'RCChangedSizeThreshold' )
		);
	}
}
