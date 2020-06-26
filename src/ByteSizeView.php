<?php

namespace VisualChanges;

use MessageLocalizer;

class ByteSizeView {
	private MessageLocalizer $messageLocalizer;
	public function __construct( MessageLocalizer $messageLocalizer ) {
		$this->messageLocalizer = $messageLocalizer;
	}

	public function getView( int $size ) {
		return '<span class="mw-visualchanges-byte-size">' .
			$this->messageLocalizer->msg( 'visualchanges-byte-size', $size )->text() .
			'</span>';
	}
}
