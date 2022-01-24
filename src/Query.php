<?php

namespace vinicinbgs\Autentique;

class Query
{
	/**
	 * @var string
	 */
	protected $folder;
	protected $file;

	/**
	 * Query constructor.
	 */
	public function __construct($folder)
	{
		$this->folder = __DIR__  . "/resources/" . strtolower($folder) . '/';
	}

	/**
	 * @return string|string[]|null
	 */
	public function query()
	{
		if (!file_exists("$this->folder$this->file")) {
			return 'File is not found';
		}

		$query = file_get_contents("$this->folder$this->file");
		return $this->format($query);
	}

	/**
	 * @param $query
	 *
	 * @return string|string[]|null
	 */
	private function format($query)
	{
		return preg_replace("/[\n\r]/", '', $query);
	}

	/**
	 * @param $file
	 *
	 * @return $this
	 */
	public function setFile($file)
	{
		$this->file = $file;

		return $this;
	}
}
