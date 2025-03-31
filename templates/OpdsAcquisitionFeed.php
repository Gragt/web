<?
/**
 * Notes:
 *
 * - *All* OPDS feeds must contain a `rel="http://opds-spec.org/crawlable"` link pointing to the `/feeds/opds/all` feed.
 * - The `<fh:complete/>` element is required to note this as a "Complete Acquisition Feed"; see <https://specs.opds.io/opds-1.2#25-complete-acquisition-feeds>.
 */

/**
 * @var string $id
 * @var string $url
 * @var string $parentUrl
 * @var string $title
 * @var ?string $subtitle
 * @var DateTimeImmutable $updated
 * @var array<Ebook> $entries
 */

$isCrawlable ??= false;
$subtitle ??= null;

// Note that the XSL stylesheet gets stripped during `se clean` when we generate the feed.
// `se clean` will also start adding empty namespaces everywhere if we include the stylesheet declaration first.
// We have to add it programmatically when saving the feed file.
print("<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/terms/" xmlns:schema="http://schema.org/"<? if($isCrawlable){ ?> xmlns:fh="http://purl.org/syndication/history/1.0"<? } ?>>
	<id><?= SITE_URL . Formatter::EscapeXml($id) ?></id>
	<link href="<?= SITE_URL . Formatter::EscapeXml($url) ?>" rel="self" type="application/atom+xml;profile=opds-catalog;kind=acquisition; charset=utf-8"/>
	<link href="<?= SITE_URL ?>/feeds/opds" rel="start" type="application/atom+xml;profile=opds-catalog;kind=navigation; charset=utf-8"/>
	<link href="<?= SITE_URL ?><?= Formatter::EscapeXml($parentUrl) ?>" rel="up" type="application/atom+xml;profile=opds-catalog;kind=navigation; charset=utf-8"/>
	<link href="<?= SITE_URL ?>/feeds/opds/all" rel="http://opds-spec.org/crawlable" type="application/atom+xml;profile=opds-catalog;kind=acquisition; charset=utf-8"/>
	<link href="<?= SITE_URL ?>/opensearch" rel="search" type="application/opensearchdescription+xml" title="Standard Ebooks"/>
	<title><?= Formatter::EscapeXml($title) ?></title>
	<? if($subtitle !== null){ ?>
		<subtitle><?= Formatter::EscapeXml($subtitle) ?></subtitle>
	<? } ?>
	<icon><?= SITE_URL ?>/images/logo.png</icon>
	<updated><?= $updated->format(Enums\DateTimeFormat::Iso->value) ?></updated>
	<? if($isCrawlable){ ?>
		<fh:complete/>
	<? } ?>
	<author>
		<name>Standard Ebooks</name>
		<uri><?= SITE_URL ?></uri>
	</author>
	<? foreach($entries as $entry){ ?>
		<?= Template::OpdsAcquisitionEntry(entry: $entry) ?>
	<? } ?>
</feed>
