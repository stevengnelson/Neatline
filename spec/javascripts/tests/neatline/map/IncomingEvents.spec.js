
/* vim: set expandtab tabstop=2 shiftwidth=2 softtabstop=2; */

/**
 * Tests for map reactions to events initiated elsewhere.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

describe('Map Incoming Events', function() {

  var server, layers;

  // Load AJAX fixtures.
  var json = readFixtures('records.json');

  // Get fixtures.
  beforeEach(function() {

    // Load partial, mock server.
    loadFixtures('neatline-partial.html');
    server = sinon.fakeServer.create();

    // Run Neatline.
    _t.loadNeatline();

    // Intercept requests.
    _.each(server.requests, function(r) {
      _t.respond200(r, json);
    });

    // Get layers.
    layers = _t.getVectorLayers();

  });

  it('should focus on model features on map:focus', function() {

    // Trigger map:focus on model with set focus/zoom.
    Neatline.vent.trigger('map:focus', layers[0].nModel);

    // Get focus and zoom.
    var center = _t.map.map.getCenter();
    var zoom = _t.map.map.getZoom();

    // Check focus and zoom.
    expect(Math.round(center.lat)).toEqual(4978802);
    expect(Math.round(center.lon)).toEqual(-8233185);
    expect(zoom).toEqual(10);

    // Trigger map:focus on model with no defaults.
    Neatline.vent.trigger('map:focus', layers[1].nModel);

    // Get focus and zoom.
    center = _t.map.map.getCenter();
    zoom = _t.map.map.getZoom();

    // Check focus and zoom.
    expect(Math.round(center.lat)).toEqual(2);
    expect(Math.round(center.lon)).toEqual(2);
    expect(zoom).toEqual(18);

  });

});