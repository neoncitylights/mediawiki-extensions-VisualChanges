<?php

namespace VisualChanges;

use HistoryPager;
use MediaWiki\MediaWikiServices;
use MediaWiki\Revision\RevisionStore;
use stdClass;

class Hooks {
	public static function onPageHistoryLineEnding(
		HistoryPager $history,
		stdClass &$row,
		string &$line,
		array &$classes,
		array &$attribs
	) {
		// Setup services and resource context
		$services = MediaWikiServices::getInstance();
		$vcServices = new Services( $services );
		$revisionStore = $services->getRevisionStore();
		$output = $history->getOutput();
		$title = $history->getTitle();

		// Get current revision and previous revision
		$currentRevision = $revisionStore->newRevisionFromRow(
			$row, RevisionStore::READ_NORMAL, $title );
		$previousRevision = $revisionStore->getRevisionById(
			$currentRevision->getParentId(), RevisionStore::READ_NORMAL );

		// Ger current revision data
		$currentUser = $currentRevision->getUser()->getName();
		$currentSummary = $currentRevision->getComment()->text;
		$noSummary = '';
		if ( $currentSummary === '' ) {
			$currentSummary = $history->msg( 'visualchanges-no-summary')->text();
			$noSummary = ' summary--none';
		}

		// Get byte size and byte difference size
		$currentSize = $currentRevision->getSize();
		$currentSizeView = new ByteSizeView( $history );
		$diffSizeFactory = $vcServices->getByteDiffSizeFactory();
		$diffSizeView = new ByteDiffSizeView();
		$diffSize = $diffSizeFactory->newFromRevisions( $currentRevision, $previousRevision );

		// load styles
		$output->addModuleStyles( 'ext.visualChanges.styles' );

		// now actually re-setup the HTML of each revision line
		$classes[] = "mw-visualchanges-rev";

		$line = '';

		$line .= '<span class="mw-visualchanges-main-data">';
		$line .= "<span class=\"mw-visualchanges-summary$noSummary\">" . $currentSummary . '</span>';
		$line .= '<span class="mw-visualchanges-user">' . $currentUser . '</span>';
		$line .= '</span>';

		$line .= '<span class="mw-visualchanges-byte-data">';
		$line .= $currentSizeView->getView( $currentSize );
		$line .= $diffSizeView->getView( $diffSize );
		$line .= '</span>';
	}
}
