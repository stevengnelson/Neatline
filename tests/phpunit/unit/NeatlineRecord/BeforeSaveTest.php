<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Tests for `beforeSave` on `NeatlineRecord`.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineRecordTest_BeforeSave extends Neatline_TestCase
{


    /**
     * `beforeSave` should compile `_title` and `_body`.
     */
    public function testCompileFields()
    {

        $item = insert_item(array(), array(
            'Dublin Core' => array (
                'Title' => array(
                    array('text' => 'title', 'html' => false)
                )
            )
        ));

        $record = $this->__record(null, $item);
        $record->title = "[item:\"Title\"]";
        $record->body = "[item:\"Title\"]";
        $record->save();

        // `title` and `body` should be compiled.
        $this->assertEquals($record->_title, 'title');
        $this->assertEquals($record->_body, 'title');

    }


}
