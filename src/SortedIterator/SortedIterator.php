<?php
namespace SortedIterator;

use Iterator;
use SplHeap;

class SortedIterator extends SplHeap
{
	/**
	 * @param Iterator $iterator
	 */
	public function __construct(Iterator $iterator)
	{
		foreach ($iterator as $item) {
			$this->insert($item);
		}
	}

	/**
	 * @param $b
	 * @param $a
	 *
	 * @return int
	 */
	public function compare($b,$a)
	{
		return strcmp($a->getRealpath(), $b->getRealpath());
	}
}