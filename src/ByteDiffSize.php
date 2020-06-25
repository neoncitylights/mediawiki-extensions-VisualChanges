<?php

namespace VisualChanges;

class ByteDiffSize {
	public const NEGATIVE = 'negative';
	public const NEUTRAL = 'neutral';
	public const POSITIVE = 'positive';

	private int $currentByteSize;
	private int $previousByteSize;
	private ?int $diffSize;
	private string $type;

	public function __construct(
		int $currentByteSize,
		int $previousByteSize
	) {
		$this->currentByteSize = $currentByteSize;
		$this->previousByteSize = $previousByteSize;
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

		if ( $this->diffSize > 0 ) {
			$this->type = self::POSITIVE;
		}
		else if ( $this->diffSize === 0 ) {
			$this->type = self::NEUTRAL;
		}
		else {
			$this->type = self::NEGATIVE;
		}

		return $this->type;
	}

	public function matchesType( string $type ) : bool {
		return $this->type === $type;
	}
}
