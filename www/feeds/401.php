<?
use function Safe\preg_match;

$feedType = '';
/** @var string $requestUri */
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
preg_match('/^\/feeds\/(opds|rss|atom)/ius', $requestUri, $matches);

if(sizeof($matches) > 0){
	$feedType = Enums\FeedType::tryFrom(strtolower($matches[1]));
}

$title = 'Standard Ebooks Ebook Feeds';
if($feedType == Enums\FeedType::Opds){
	$title = 'The Standard Ebooks OPDS Feed';
}

if($feedType == Enums\FeedType::Rss){
	$title = 'Standard Ebooks RSS Feeds';
}

if($feedType == Enums\FeedType::Atom){
	$title = 'Standard Ebooks Atom Feeds';
}

?><?= Template::Header(title: 'The Standard Ebooks OPDS feed', description: 'Get access to the Standard Ebooks OPDS feed for use in ereading programs in scripting.') ?>
<main>
	<section class="narrow has-hero">
		<? if($feedType == Enums\FeedType::Opds){ ?>
			<h1>The Standard Ebooks OPDS Feed</h1>
		<? }elseif($feedType == Enums\FeedType::Rss){ ?>
			<h1>Standard Ebooks RSS Feeds</h1>
		<? }elseif($feedType == Enums\FeedType::Atom){ ?>
			<h1>Standard Ebooks Atom Feeds</h1>
		<? }else{ ?>
			<h1>Standard Ebooks Ebook Feeds</h1>
		<? } ?>
		<picture data-caption="Rack Pictures for Dr. Nones. William A. Mitchell, 1879">
			<source srcset="/images/rack-picture-for-dr-nones@2x.avif 2x, /images/rack-picture-for-dr-nones.avif 1x" type="image/avif"/>
			<source srcset="/images/rack-picture-for-dr-nones@2x.jpg 2x, /images/rack-picture-for-dr-nones.jpg 1x" type="image/jpg"/>
			<img src="/images/rack-picture-for-dr-nones@2x.jpg" alt="Postal mail attached to a billboard."/>
		</picture>
		<ul class="message error">
			<li>
				<p>Make a donation to <a href="/donate#patrons-circle">join the Patrons Circle</a> and get access our ebook feeds.</p>
			</li>
		</ul>
		<?= Template::FeedHowTo() ?>
	</section>
</main>
<?= Template::Footer() ?>
