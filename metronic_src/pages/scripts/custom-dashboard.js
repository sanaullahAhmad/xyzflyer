
//https://mapicons.mapsmarker.com/
// above is icon resource


(function(window, mapster) {
var url = window.location.href;

	var options = mapster.MAP_OPTIONS,
	element = document.getElementById("dash-regional-stats"),
	map = mapster.create(element, options);

  // map.zoom(45);

  // map._on('click', function(e){

  //   console.log('click');
  //   console.log(e);
  //   console.log(this);

  // });





  // var opts = {
  //   lat: 33.7294,
  //   lng: 73.0931,
  //   visible: true,
  //   draggable: true,
  //   id: 1,
  //   icon: "https://dl.dropboxusercontent.com/u/81717997/development/icons/bigcity.png",
  //   content: "I like rice"


  // };

  // map.addMarker(opts);

  // var marker2 = map.addMarker({
  //   id: 2,
  //   lat: 33.76,
  //   lng: 73.125,
  //   icon: "https://dl.dropboxusercontent.com/u/81717997/development/icons/country.png",
  //   content: "a peaceful country"

  // });

  // var found = map.findBy(function(marker2){
  //   return marker2.id ===1;
  // });

  // map.removeBy(function(marker2) {
  //   return marker2.id === 1;
  // })

  // console.log(found);

  // map._removeMarker(marker2);


  // var found = map.findMarkerByLat(33.7294);
  //   console.log("Marker Found" + found);


  $(function(){

////////////////////////if admin page ///////////////////

if(url.substring(url.lastIndexOf('/')) === "/_backoffice"){

$.ajax({
      url: site_url+"api/v1/mobile/stats",
      type: 'POST'
    }).done(function(data){

      data = JSON.parse(data);


      $('.easy-pie-chart .number.delivered').easyPieChart({
        animate: 1000,
        size: 75,
        lineWidth: 3,
        barColor: "Yellow"
      });

      $('.easy-pie-chart .number.clicks').easyPieChart({
        animate: 1000,
        size: 75,
        lineWidth: 3,
        barColor: "green"
      });

      $('.easy-pie-chart .number.bounce').easyPieChart({
        animate: 1000,
        size: 75,
        lineWidth: 3,
        barColor: "red"
      });



      //console.log(data.data.bounces);


      var bounce_percent = Number(data.data.bounces*100)/(Number(data.data.requests));
      var delivered_percent = Number(data.data.delivered*100)/(Number(data.data.requests));
      var clicks_percent = Number(data.data.clicks*100)/(Number(data.data.delivered));

if(url.substring(url.lastIndexOf('/')) === "/_backoffice"){




      $("#number-bounce").data('easyPieChart').update(bounce_percent.toFixed(2));
      $('#number-bounce span').text(bounce_percent.toFixed(1));

      $("#number-delivered").data('easyPieChart').update(delivered_percent);
      $('#number-delivered span').text(delivered_percent.toFixed(1));

      $("#number-clicks").data('easyPieChart').update(clicks_percent);
      $('#number-clicks span').text(clicks_percent.toFixed(1));

}

    }).fail(function(err){
     // console.log('stat err');
    });//endof ajax general stats



function sales_by_region (sales_data) {
      sales_data = JSON.parse(sales_data);
      if (typeof(AmCharts) === 'undefined' || $('#dash-sales-by-region').size() === 0) {
        return;
      }

      var chart = AmCharts.makeChart("dash-sales-by-region", {
        "type": "pie",
        "theme": "light",
        "path": "../../metronic_src/global/plugins/amcharts/ammap/global",
        "dataProvider": sales_data,
        "valueField": "total_orders",
        "titleField": "state",
        "balloon": {
          "fixedPosition": true
        },

        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",

        "export": {
          "enabled": false
        },
        "listeners": [{
          "event": "clickSlice",
          "method": function(e) {
            var state = e.dataItem.dataContext.state
            // e.chart.validateData();
            sales_by_region_county(state, e);
          }
        }
        ]

      });

      jQuery('.chart-input').off().on('input change', function() {
        var property = jQuery(this).data('property');
        var target = chart;
        var value = Number(this.value);
        chart.startDuration = 0;

        if (property == 'innerRadius') {
          value += "%";
        }

        target[property] = value;
        chart.validateNow();
      });
        } //end of sales_by_region


        $.ajax({
          url: "admin/admin/ajax_get_sales_by_region",
        }).done(function(data){
          sales_by_region(data);
        }).fail(function(xhr,status,err){
          console.log(err);
        });



// $.ajax({
//       url: 'email_database/ajax_get_all_data'
//     }).done(function(data){
//       data = JSON.parse(data);

//       var i=0;
//       console.log(data.length);
//       for(;i<data.length; i++){

//         map.addMarker({
//           id: i,
//           lat: parseInt(data[i].Latitude),
//           lng: parseInt(data[i].Longitude),
//           content: data[i].Full_Name
//           // icon: "https://dl.dropboxusercontent.com/u/81717997/development/icons/bigcity.png"

//         });
//       }

//     }).fail(function(err){
//       console.log('err while ajax request');
//     });//end of ajax




        function sales_by_region_county(state, event){
          // console.log(state, event);

          $.ajax({
            url: "admin/admin/ajax_get_sales_by_region_county",
            method: "post",
            data: {"state" : state}
          }).done(function(data){
            if(data){

              data = JSON.parse(data);
              $('#dash-sales-by-region-county').css({"display":"block"});

                // chart2 for county onclick dyanmic chart
                var chart2 = AmCharts.makeChart("dash-sales-by-region-county", {
                  "type": "pie",
                  "theme": "light",
                  "path": "../../metronic_src/global/plugins/amcharts/ammap/global",
                  "dataProvider": data,
                  "valueField": "total_orders",
                  "titleField": "county",
                  "balloon": {
                    "fixedPosition": true
                  },

                  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",

                  "export": {
                    "enabled": false
                  },
                  "listeners": [{
                    "event": "clickSlice",
                    "method": function(e) {
                      $('#dash-sales-by-region-county').css({"display":"none"});
                    }
                  }]



                });


              }
            }).fail(function(xhr,status,err){
              console.log(err);
            });
          }//end of sales_by_region_county



    $.ajax({
      url: "admin/admin/ajax_get_recent_users"

    }).done(function(data){
      data = JSON.parse(data);
      var i =0;
      for(; i<data.length; i++){

        data[i].userProfilePicture = data[i].userProfilePicture === "" ? "avatar_2x.png" : data[i].userProfilePicture;
        $("#mt-widget-user-" + (i+1) + " .mt-img img").attr('src', "/assets/imgs/" + data[i].userProfilePicture);
        $("#mt-widget-user-" + (i+1) + " .mt-body .mt-username").text(  data[i].userFirstName + " " + data[i].userLastName);
        $("#mt-widget-user-" + (i+1) + " .mt-body .mt-user-title").text( "State: " + data[i].state + " - County: " + data[i].county);
        $("#mt-widget-user-" + (i+1) + " .mt-body .mt-stats .font-red").text( data[i].sales);
        $("#mt-widget-user-" + (i+1) + " .mt-body .mt-stats .font-green").text( data[i].sent);
        $("#mt-widget-user-" + (i+1) + " .mt-body .mt-stats .font-yellow").text( data[i].last_active);


      }







    }).fail(function(err){
      console.log('recent users err');
    });//end ajax of recnet users


    $.ajax({
      url: "users_activity/ajax_get_users_activty"
    }).done(function(data){
      data = JSON.parse(data);

      var source = $("#feed-template").html();
      if(source){
      var template = Handlebars.compile(source);
      var ctx = { "feeds": data};

      Handlebars.registerHelper('activity_txt', function(activity_text) {
        var txt = data[activity_text.data.index].activity_text;
        return txt;
        // return txt.substring(0, txt.indexOf('at'));
      });

      Handlebars.registerHelper('activity_dt', function(activity_date) {
        var dt = data[activity_date.data.index].activity_date;
        var d = new Date(dt);
        return d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear();
      });

      $("#tab_1_2 .feeds").append(template(ctx));
}//end of is source available
    }).fail(function(err){
      console.log('feed call err');
    });//end of feed ajax


$.ajax({
      url: "admin_activity/ajax_get_admin_activity"
    }).done(function(data){
      data = JSON.parse(data);

      // console.log(data);
      var source = $("#feed-template").html();
      if(source){


      var template = Handlebars.compile(source);
      var ctx = { "feeds": data};

      Handlebars.registerHelper('activity_txt', function(activity_text) {
        var txt = data[activity_text.data.index].activity_text;
        // return txt.substring(0, txt.indexOf('at'));
        return txt;
      });

      Handlebars.registerHelper('activity_dt', function(activity_date) {
        var dt = data[activity_date.data.index].activity_date;
        var d = new Date(dt);
        return d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear();
      });

      $("#tab_1_1 .feeds").append(template(ctx));
}
    }).fail(function(err){
      console.log('feed call err');
    });//end of feed ajax



}//enifadmin pge

/////////////////////////end if admin page//////////////////////////







    //// map state with lat long///////


    $.ajax({
      url: base_url+"email_database/get_state_lat_long"
    }).done(function(data){
            data = JSON.parse(data);
var i=0;
            for (var key in data) {

  if (data.hasOwnProperty(key)) {

i++;
    map.addMarker({
          id: i,
          lat: parseInt(data[key].lat),
          lng: parseInt(data[key].long),
          content: '<div>Sate:   ' + key.toString()  + ' </div><div> Users:  ' + data[key].users  + ' </div>'
          // icon: "https://dl.dropboxusercontent.com/u/81717997/development/icons/bigcity.png"

        });
  }
}
console.log("i: " + i);

    }).fail(function(data){
      console.log('state lat long ajax calll fail');
    });
    ////// @end map state with lat long /////












  });//end of jquery ready anon









}(window, window.Mapster || (window.Mapster = {})));