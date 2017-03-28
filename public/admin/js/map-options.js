(function(window, google, mapster){

  mapster.MAP_OPTIONS = {
    center: {
      lat: 41.11246879,
      lng: -93.29589844
    },
    zoom: 3,
    disableDefaultUI: false,
    scrollwheel: true,
    draggable: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    maxZoom: 21,
    minZoom: 1,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM,
      style: google.maps.ZoomControlStyle.DEFAULT
    },
    panControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }



  };

}(window, google, window.Mapster || (window.Mapster = {})));