<?php
include_once 'Parsedown.php';
#
#
# Parsedown Extra
# https://github.com/erusev/parsedown-extra
#
# (c) Emanuil Rusev
# http://erusev.com
#
# For the full license information, view the LICENSE file that was distributed
# with this source code.
#
#

class ParsedownExtra extends Parsedown
{
    # ~

	const version = '0.8.0';

	function __construct() {
		if (version_compare(parent::version, '1.7.1') < 0) {
			throw new Exception('ParsedownExtra requires a later version of Parsedown');
		}
		array_unshift($this->BlockTypes['['], 'ParagraphNote');
		array_unshift($this->InlineTypes['['], 'ParagraphNoteMarker');
	}

	protected function blockParagraphNote($Line) {
		if (preg_match('/^\[-(.+?)\]:[ ]?(.*)$/', $Line['text'], $matches)) {
			$Block['element'] = array(
				'name' => 'div',
				'attributes' => array('class' => 'p-notes'),
				'elements' => array(
					array(
						'name' => 'ol',
						'elements' => [
							[
								'name' => 'li',
								'elements' => [
									['text' => $matches[2]]
								],
							]
						],
					),
				),
			);
			return $Block;
		}
	}

	protected function blockParagraphNoteContinue($Line, $Block) {
		if (preg_match('/^\[-(.+?)\]:[ ]?(.*)$/', $Line['text'], $matches)) {

			$Block3['li'] = array(
				'name' => 'li',
				'elements' => [
					['text' => $matches[2]]
				],
			);

			$Block['element']['elements'][0]['elements'] [] = $Block3['li'];
			return $Block;
		}
	}

	protected function inlineParagraphNoteMarker($Excerpt) {
		if (preg_match('/^\[-(.+?)\]/', $Excerpt['text'], $matches)) {
			$name = $matches[1];
			$Element = array(
				'name' => 'sup',
				'attributes' => array('class' => 'p-note-ref'),
				'text' => $name,
			);
			return array(
				'extent' => strlen($matches[0]),
				'element' => $Element,
			);
		}
	}
}
