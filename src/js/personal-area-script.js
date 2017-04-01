var fixtures = [];
var userData = [];
var umpires = [];

var backgroundGreen = "#00FF00";
var backgroundYellow = "#FFFF33";
var backgroundBlue = "#3399FF";
var backgroundRed = "#FF1A1A";
var backgroundGrey = "#B3B3B3";

var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

$(function() {
      $("#update-submit").click(function() {
        updateInfo();
    });
});

function setUserData(jsonUserData){
  userData = jsonUserData;
  updateFixtures();
}
var map;
function startMap(position){
  map = new google.maps.Map(document.getElementById("gmap"), {
    zoom: 16,
    center: position
  });
  var marker = new google.maps.Marker({
    position: position,
    map: map
  });
}
function initMap(fixture){
  geocoder = new google.maps.Geocoder();
  var position = {};
  geocoder.geocode({'address': fixture.Address}, function(results, status){
    if(status == google.maps.GeocoderStatus.OK){
      position = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
      startMap(position);
      $('#map-address').text(results[0].formatted_address);
      $(".personal-area-map").css("display", "block");
    }
  });
}

function drawFixtures(){
  var selectedFixtures = [];
  var availableFixtures = [];
  var pastFixtures = [];
  var unavailableFixtures = [];
  var html = "";
  $.each(fixtures, function(key, val){
    var umpiresHTML = "";
    var unassigned = false;
    var involved = false;
    var unavailable = false;
    $.each(val.Umpires, function(key1, val1){
      switch(val1.ID){
        case userData.ID:
        involved = true;
        umpiresHTML += '<b>' + val1.Firstname + ' ' + val1.Surname + '</b>, ';
        break;
        case -1:
        unassigned = involved ? false : true;
        umpiresHTML += '<i>Unassigned</i>, ';
        break
        default:
        umpiresHTML += val1.Firstname + ' ' + val1.Surname + ', ';
        break;
      }
    });
    if(!unassigned && !involved){
      unavailable = true;
    }
    var date = new Date(val.Timestamp);
    date.setHours(date.getHours() + 1);
    var timeString = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' ' + date.toLocaleTimeString();
    umpiresHTML = umpiresHTML.replace(/,\s*$/, "");
    var border = "border: 3px solid ";
    var isBorderSet = false;
    var backgroundcolor = "";
    if(date.toDateString() === new Date().toDateString()){
      border += backgroundBlue;
      isBorderSet = true;
    }
    if(unavailable){
      if(!isBorderSet){
        border += backgroundRed;
      }
      backgroundcolor = backgroundRed;
      unavailableFixtures.push('<div class="card col-6 fixture-card" style="background-color: ' + backgroundcolor + '; ' + border + '" id="fixture' + key + '"><p>'+ timeString + '<br/><b>' + val.Alias + '</b><br/>' + val.HomeTeam + ' vs ' + val.AwayTeam + '<br/>' + umpiresHTML + '<br/>' + val.Venue + '</p></div>');
    }
    else if(!unassigned && date.getTime() < new Date().getTime()){
      if(!isBorderSet){
        border += backgroundGrey;
      }
      backgroundcolor = backgroundGrey;
      pastFixtures.push('<div class="card col-6 fixture-card" style="background-color: ' + backgroundcolor + '; ' + border + '" id="fixture' + key + '"><p>'+ timeString + '<br/><b>' + val.Alias + '</b><br/>' + val.HomeTeam + ' vs ' + val.AwayTeam + '<br/>' + umpiresHTML + '<br/>' + val.Venue + '</p></div>');
    }else if(unassigned){
    if(date > new Date()){
      if(!isBorderSet){
        border += backgroundYellow;
      }
      backgroundcolor = backgroundYellow;
      availableFixtures.push('<div class="card col-6 fixture-card" style="background-color: ' + backgroundcolor + '; ' + border + '" id="fixture' + key + '"><p>'+ timeString + '<br/><b>' + val.Alias + '</b><br/>' + val.HomeTeam + ' vs ' + val.AwayTeam + '<br/>' + umpiresHTML + '<br/>' + val.Venue + '</p><span class="is-available" id="available' + val.ID + '">$#10004</span><span class="is-not-available" id="notavailable' + val.ID + '">&#10008</span></div>');
    }
    }else{
      if(!isBorderSet){
        border += backgroundGreen;
      }
      backgroundcolor = backgroundGreen;
      selectedFixtures.push('<div class="card col-6 fixture-card" style="background-color: ' + backgroundcolor + '; ' + border + '" id="fixture' + key + '"><p>'+ timeString + '<br/><b>' + val.Alias + '</b><br/>' + val.HomeTeam + ' vs ' + val.AwayTeam + '<br/>' + umpiresHTML + '<br/>' + val.Venue + '</p></div>');
    }
  });
  html +='<h3>Selected Fixtures</h3><div class="row">';
  selectedFixtures.forEach(function(fixtureHTML){
    html += fixtureHTML;
  });
  html += '</div><h3>Available Fixtures</h3><div class="row">';
  availableFixtures.forEach(function(fixtureHTML){
    html += fixtureHTML;
  });
  html += '</div><h3>Past Fixtures</h3><div class="row">';
  pastFixtures.forEach(function(fixtureHTML){
    html += fixtureHTML;
  });
  html += '</div><h3>Other Fixtures</h3><div class="row">';
  unavailableFixtures.forEach(function(fixtureHTML){
    html += fixtureHTML;
  });
  html += '</div>';
  $(".fixtures-content").html(html);
  $.each(fixtures, function(key, val){
    $("#fixture" + key).click(function(){
      initMap(val);
    });
  });
}

function drawUsefulContactDetails(){
  var html = '<table><tr><th>Name</th><th span="3">Contact Info</th></tr>';
  $.ajax({
    url: "php/getumpiredata.php",
    data: {umpires: JSON.stringify(umpires), selectall: false},
    dataType: "json",
    method: "get",
    success: function(callback){
        $.each(callback, function(key, val){
          if(val.ID != userData.ID){
          html += '<tr>';
          html += '<td>' + val.Firstname + ' ' + val.Surname + '</td>';
          html += '<td><a href="mailto:'+ val.Email + '">' + val.Email + '</td>';
          html += '<td><a href="tel:'+ val.MobileNo + '">' + val.MobileNo + '</td>';
          html += '<td><a href="tel:'+ val.HouseNo + '">' + val.HouseNo + '</td>';
          html += '</tr>';
        }
        });
        $(".contact-content").html(html);
    }
  })
}

function drawCalender(fMonth = null, fYear = null){
  var today = new Date();
  var acdate;
  if(fMonth == null && fYear == null){
    acdate = today;
  }
  else{
    acdate = new Date(fYear, fMonth, 1);
  }
    var month = acdate.getMonth();
    var year = acdate.getFullYear();
    var daysInMonth = getDaysInMonth(month + 1, year);
    var html = '';
    var fixtureDays = [];
    var personalFixtures = [];
    var unavailableFixtures = [];
    var allFixtures = [];
    fixtures.forEach(function(fixture){
      var date = new Date(fixture.Timestamp);
      var umpiring = false;
      var unavailable = false;
      fixture.Umpires.forEach(function(umpire){
        if(umpire.ID == userData.ID){
          umpiring = true;
        }else if(umpire.ID == -1){
          unavailable = true;
        }
      });
      if(umpiring){
        personalFixtures.push(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: date.getDate()}));
      }else if (unavailable) {
        fixtureDays.push(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: date.getDate()}));
      }
      else{
        unavailableFixtures.push(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: date.getDate()}));
      }
      allFixtures.push(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: date.getDate()}));
    });
    for (var i = 1; i < daysInMonth + 1; i++) {
        var date = new Date(year, month, i);
        var day = date.getDay();
        var mDay = date.getDate();
        var classHTML = "";
        var id = "";
        if(i == 1){
          for(var j = 0; j < day - 1; j++){
            html += '<li></li>';
          }
        }
        if(date.toDateString() == today.toDateString()) {
            classHTML += "active ";
        }
        if(personalFixtures.indexOf(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: mDay})) != -1){
          var pickedDate = new Date(Date.parse(date.toDateString()));
          var todayString = new Date(Date.parse(today.toDateString()));
          if(pickedDate < todayString){
            classHTML += "past-fixture";
          }else{
            classHTML += "selected-fixture";
          }
        }else if(unavailableFixtures.indexOf(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: mDay})) != -1){
          classHTML += "unavailable-fixture";
        }else if(fixtureDays.indexOf(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: mDay})) != -1 && date > today){
          classHTML += "fixture";
        }else{
          classHTML += "blank";
        }
        tmp_id = allFixtures.indexOf(JSON.stringify({year: date.getFullYear(), month: date.getMonth(), day: mDay}))
        id = ' id="fixtureday-' + tmp_id + '"';
        html += '<li class="fixtureday ' + classHTML + '" ' + id + '>' + mDay + '</li>';
    }
    html += '';
    $(".calender .days").html(html);
    $(".calender .month-name").html("<p>" + monthNames[month] + " " + year + '</p><input type="hidden" id="thismonth" value="' + month + '" /><input type="hidden" id="thisyear" value="' + year + '" />')
    $(".fixtureday").click(function(){
      $(this).toggleClass("toggled");
      var id = $(this).attr("id").split("-")[1];
      selectFixture(allFixtures[id]);
    });
}
function nextMonth(){
  var month = parseInt($("#thismonth").val());
  var year = parseInt($("#thisyear").val());
  if(month == 11){
    month = 0;
    year += 1;
  }else{
    month += 1;
  }
  drawCalender(month, year);
}
function previousMonth(){
  var month = parseInt($("#thismonth").val());
  var year = parseInt($("#thisyear").val());
  if(month == 0){
    month = 11;
    year -= 1;
  }else{
    month -= 1;
  }
  drawCalender(month, year);
}

function selectFixture(fixtureDate){
  fixtureDate = JSON.parse(fixtureDate);
  var date = new Date(fixtureDate.year, fixtureDate.month, fixtureDate.day);
  $.each(fixtures, function(key, val){
    var fdate = new Date(val.Timestamp);
    if(date.toDateString() === fdate.toDateString()){
      $("#fixture" + key).toggleClass("toggled");
    }
  });
}

function getDaysInMonth(month, year) {
    return (new Date(year, month, 0).getDate());
}

function updateInfo() {
    var allComplete = true;
    $("#update-user-info input").each(function() {
        if (!$(this).val()) {
            allComplete = false;
        }
    })
    if (allComplete) {
        var firstname = $("#update-user-info input[name=firstname]").val();
        var surname = $("#update-user-info input[name=surname]").val();
        var email = $("#update-user-info input[name=email]").val();
        var mobile = $("#update-user-info input[name=mobile]").val();
        var house = $("#update-user-info input[name=house]").val();
        var data = {
            firstname: firstname,
            surname: surname,
            email: email,
            mobile: mobile,
            house: house,
            userKey: userData.UserKey
        };
        $.ajax({
            url: "php/updateuserinfo.php",
            data: data,
            method: "post",
            beforeSend: function() {
                $("#update-user-info input").prop("disabled", true);
            },
            success: function(result) {
                $("#update-user-info input").prop("disabled", false);
                if (!result) {
                    $("#update-user-info strong").text("Data not updated correctly - please try again");
                }
            }
        });
    } else {
        $("#update-user-info strong").text("Entries marked with a '*' cannot be empty - please try again");
    }
}

function updateFixtures(){
  $.ajax({
    url: "php/getfixtures.php",
    dataType: "json",
    method: "get",
    data: {id: userData.ID},
    success: function(json){
      fixtures = json;
      drawCalender();
      drawFixtures();
      drawUsefulContactDetails();
    }
  })
}
