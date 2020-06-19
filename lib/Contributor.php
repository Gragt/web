<?
class Contributor{
	public $Name;
	public $UrlName;
	public $SortName;
	public $WikipediaUrl;
	public $MarcRole;
	public $FullName;
	public $NacoafUrl;

	public function __construct(string $name, string $sortName = null, string $fullName = null, string $wikipediaUrl = null, string $marcRole = null, string $nacoafUrl = null){
		$this->Name = str_replace('\'', '’', $name);
		$this->UrlName = Formatter::MakeUrlSafe($name);
		$this->SortName = $sortName;
		$this->FullName = $fullName;
		$this->WikipediaUrl = $wikipediaUrl;
		$this->MarcRole = $marcRole;
		$this->NacoafUrl = $nacoafUrl;
	}
}
