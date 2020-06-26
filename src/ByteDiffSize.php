<?php

namespace VisualChanges;

class ByteDiffSize {
	public const NEGATIVE = 'negative';
	public const NEUTRAL = 'neutral';
	public const POSITIVE = 'positive';

	private int $currentByteSize;
	private int $previousByteSize;
	private int $sizeThreshold;
	private ?int $diffSize;
	private ?string $type;

	public function __construct(
		int $currentByteSize,
		int $previousByteSize,
		int $sizeThreshold
	) {
		$this->currentByteSize = $currentByteSize;
		$this->previousByteSize = $previousByteSize;
		$this->sizeThreshold = $sizeThreshold;
		$this->diffSize = null;
		$this->type = null;
	}

	public function getDiffSize() : int {
		if ( $this->diffSize !== null ) {
			return $this->diffSize;
		}

		$this->diffSize = $this->currentByteSize - $this->previousByteSize;
		return $this->diffSize;
	}

	public function getType() : string {
		if ( $this->type !== null ) {
			return $this->type;
		}

		if ( $this->getDiffSize() > 0 ) {
			$this->type = self::POSITIVE;
		}
		else if ( $this->getDiffSize() === 0 ) {
			$this->type = self::NEUTRAL;
		}
		else {
			$this->type = self::NEGATIVE;
		}

		return $this->type;
	}

	public function isType( string $type ) : bool {
		return $this->getType() === $type;
	}

	public function isLarge() : bool {
		return abs( $this->getDiffSize() ) > abs( $this->sizeThreshold );
	}
}
