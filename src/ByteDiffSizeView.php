<?php

namespace VisualChanges;

use Html;

class ByteDiffSizeView {
	public function getView( ByteDiffSize $byteDiffSize ) {
		$output = '';
		$output .= Html::openElement(
			'span',
			[ 'class' => $this->getClass( $byteDiffSize ) ]
		);
		$output .= $this->getText( $byteDiffSize );
		$output .= Html::closeElement( 'span' );

		return $output;
	}

	public function getClass( ByteDiffSize $byteDiffSize ) : string {
		return "mw-visualchanges-byte-diff-size " . $byteDiffSize->getType();
	}

	public function getText( ByteDiffSize $byteDiffSize ) : string {
		$output = '';
		if ( $byteDiffSize->matchesType( ByteDiffSize::POSITIVE ) ) {
			$output .= '+';
		}

		$output .= $byteDiffSize->getDiffSize();

		return $output;
	}
}
