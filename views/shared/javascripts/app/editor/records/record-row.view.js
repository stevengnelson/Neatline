
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2 cc=76; */

/**
 * Record row view.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

Neatline.module('Editor.Records', function(
  Records, Neatline, Backbone, Marionette, $, _) {


  Records.RowView = Backbone.Neatline.View.extend({


    className:  'record',
    tagName:    'a',


    /**
     * Store model, set `href`, render template.
     */
    initialize: function() {

      // Store model, set `href`.
      this.model = this.options.model;
      this.$el.attr('href', '#records/'+this.model.get('id'));

      // Render template, bind model.
      this.$el.html(this.options.template);
      rivets.bind(this.$el, { record: this.model });

    }


  });


});
