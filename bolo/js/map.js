(function ($, root, undefined) {
  
  $(function () {
  
    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
    // to the base of the flagpole.

    (function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 3,
        center: {lat: 27.3523645, lng: 8.1333324}
      });
      map.setOptions({minZoom : 2, maxZoom : 6});
      var geo = 
      {
        'paris'   : { lat : 48.3523645, lng : -0.39356},
        'espagne' : { lat : 41.48079, lng : -5.62306}
      }
      // get picutures
      var pics = {},
          elem,
          carImgs;
          carouselCont = document.getElementsByClassName('carousel-inner');

      for (var i = carouselCont.length - 1; i >= 0; i--) {
        elem = carouselCont[i].id;
        carImgs = carouselCont[i].querySelectorAll('img');
        if (elem == '' != carImgs.length < 2)// carousel should containe more than 1 image
          continue;
        pics[elem] = {};
        pics[elem]['imgs'] = carImgs;
        if (geo.hasOwnProperty(elem))
          pics[elem]['altAlg'] = geo[elem];
      }
      console.log(pics)
      var markers = [],
          place,
          img,
          alt;
      for (var place in pics)
      {
        for (var i = 0; i < 2; i++) {
          if (pics[place]['imgs'][i] == undefined)
            continue;
          img = 
          {
            url : pics[place]['imgs'][i].src,
            size: new google.maps.Size(30, 30),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(0, 32)
          }

          var marker = new google.maps.Marker({
            position  : {lat: (geo[place]['lat'] - (i / 5)), lng: (geo[place]['lng'] + (i / 5))},
            map       : map,
            icon      : img,
            zIndex    : 3,
            animation : google.maps.Animation.BOUNCE,
            name      : place 
          });

          marker.addListener('click', function()
          {
            document.getElementById('mapCarousel').style.display = 'block';
            document.getElementById(this.name).style.display = 'block';
          });
        }
      }
      // setMarkers(map);
      var flightPlanCoordinates = {
        'perou' : 
        [
          [
            {lat: -9.1899043, lng: -75.0151762}, // perou
            {lat: 7.9189252,  lng: -67.4237556} // venezuela
          ],
          [
            {lat: -9.1899043, lng: -75.0151762}, // perou
            {lat: -1.8312001, lng: -78.1832972}, // equateur
          ],
          [
            {lat: -9.1899043, lng: -75.0151762}, // perou
            {lat: -33.4477792, lng: -70.6704486}, // chili
          ],
          [
            {lat: -9.1899043, lng: -75.0151762}, // perou
            {lat: -38.4160912, lng: -63.6168077}, // argentine
          ],
        ],
       'barcelone' : 
        [

          [
            {lat: 40.4637174, lng: -3.7493317}, // barcelone
            {lat: -38.4160912, lng: -63.6168077}, // argentine
          ],
          [
            {lat: 40.4637174, lng: -3.7493317}, // barcelone
            {lat: 48.8566541, lng: 2.3521669}, // paris
          ],
          [
            {lat: 40.4637174, lng: -3.7493317}, // barcelone
            {lat: 48.1355592, lng: 11.5806471}, // munich
          ],
          [
            {lat: 40.4637174, lng: -3.7493317}, // barcelone
            {lat: 45.4679912, lng: 9.1855212}, // milan
          ],
          [
            {lat: 40.4637174, lng: -3.7493317}, // barcelone
            {lat: 45.0999857, lng: 15.1999556}, // croatie
          ],
        ],
       'paris' : 
        [
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 50.8494018, lng: 4.3511542}, // bruxelle
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 35.0598352, lng: 33.207247}, // chypre
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 39.4681897, lng: 21.8887728}, // grece
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 33.8547822, lng: 35.8622527}, // liban
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 45.9432505, lng: 24.9665908}, // roumanie
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 42.7875079, lng: -86.1080429}, // holland
          ],
          [
            {lat: 48.8566541, lng: 2.3521669}, // paris
            {lat: 14.3499275, lng: 108.0003738}, // vietenam
          ]
       ]
      },
      color = {'perou' : '#fe5f03', 'barcelone' : '#cbb826', 'paris' : 'orange'};
      for (var line in flightPlanCoordinates) {
        for (var i = 0; i < flightPlanCoordinates[line].length; i++) {
          j = flightPlanCoordinates[line][i];
          var flightPath = new google.maps.Polyline({
            path: j,
            geodesic: true,
            strokeColor: color[line],
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map: map
          });
        }
      }

    })()

    // Data for the markers consisting of a name, a LatLng and a zIndex for the
    // order in which these markers should display on top of each other.
    var beaches = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];

    function setMarkers(map) {
      // Adds markers to the map.

      // Marker sizes are expressed as a Size of X,Y where the origin of the image
      // (0,0) is located in the top left of the image.

      // Origins, anchor positions and coordinates of the marker increase in the X
      // direction to the right and in the Y direction down.
      var image = {
        url: 'images/beachflag.png',
        // This marker is 20 pixels wide by 32 pixels high.
        scaledSize: new google.maps.Size(20, 32),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(0, 0)
      };
      // Shapes define the clickable region of the icon. The type defines an HTML
      // <area> element 'poly' which traces out a polygon as a series of X,Y points.
      // The final coordinate closes the poly by connecting to the first coordinate.
      var shape = {
        coords: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
      };
      for (var i = 0; i < beaches.length; i++) {
        var beach = beaches[i];
        var marker = new google.maps.Marker({
          position: {lat: beach[1], lng: beach[2]},
          map: map,
          icon: image,
          shape: shape,
          title: beach[0],
          zIndex: beach[3]
        });
      }
    }

  })
})(jQuery, this);
