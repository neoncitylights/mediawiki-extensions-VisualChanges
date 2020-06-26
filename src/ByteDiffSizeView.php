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
		$class = "mw-visualchanges-byte-diff-size";
		$class .= " {$byteDiffSize->getType()}";
		$class .= $byteDiffSize->isLarge() ? " large--edit" : '';

		return $class;
	}

	public function getText( ByteDiffSize $byteDiffSize ) : string {
		$text = '';
		if ( $byteDiffSize->isType( ByteDiffSize::POSITIVE ) ) {
			$text .= '+';
		}

		$text .= $byteDiffSize->getDiffSize();

		return $text;
	}
}
