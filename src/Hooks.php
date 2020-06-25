<?php

namespace VisualChanges;

use HistoryPager;
use MediaWiki\MediaWikiServices;
use stdClass;

class Hooks {
	public static function onPageHistoryLineEnding(
		HistoryPager $history,
		stdClass &$row,
		string &$line,
		array &$classes,
		array &$attribs
	) {
		$services = MediaWikiServices::getInstance();
		$revisionStore = $services->getRevisionStore();

		$context = $history->getContext();
		$output = $context->getOutput();
		$language = $context->getLanguage();
	}
}
