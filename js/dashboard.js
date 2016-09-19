
$(document).ready(function() {

    var documentHeight = document.querySelector('body').offsetHeight;
    $('.lftSdDboard').css('height', documentHeight);

   $( "#datepicker" ).datepicker();
   $( "#fromDate, #toDate" ).datepicker(
    { minDate: new Date(2001, 1 - 1, 1),  maxDate: "+0d" }
    );
   $('.collapse').collapse(); 

    billing();
    var makeHistogram = document.getElementById('showHistogramm');
        makeHistogram.addEventListener('click', billing);

});

function billing(){
    /* GET TIME AND DATE FROM FIELDS INPUT */
    var getDate = document.getElementById('getDate'),
    fromAmPm = document.getElementById('fromAmPm'),
    toAmPm = document.getElementById('toAmPm'),
    toMinutes = document.getElementById('toMinutes'),
    fromMinutes = document.getElementById('fromMinutes');
        fromMinutes.addEventListener('click', function () {
            let val = fromMinutes.value;
             val == "00" ? fromMinutes.value = "30" : fromMinutes.value = "00"; 
              });
        toMinutes.addEventListener('click', function () {
            let val = toMinutes.value;
             val == "00" ? toMinutes.value = "30" : toMinutes.value = "00"; 
              });
        fromAmPm.addEventListener('click', function () {
            let val = fromAmPm.value;
             val == "AM" ? fromAmPm.value = "PM" : fromAmPm.value = "AM"; 
              });
        toAmPm.addEventListener('click', function () {
            let val = toAmPm.value;
             val == "AM" ? toAmPm.value = "PM" : toAmPm.value = "AM"; 
              });
    getDate.addEventListener('click', function () {
        /* GET TIME "FROM" INPUT */
         var fromDate = document.getElementById('fromDate').value,
         fromHours = document.getElementById('fromHours').value,
        fromFullDate = new Date(fromDate);
        fromHours = fromAmPm.value == "PM" ? +(fromHours) + 12 : fromHours;
        fromFullDate.setHours(fromFullDate.getHours() + fromHours);
        fromFullDate.setMinutes(fromFullDate.getMinutes() + fromMinutes.value);
        /* END GET TIME "FROM" INPUT */
        /* GET TIME "TO" INPUT*/
        var toDate = document.getElementById('toDate').value,
         toHours = document.getElementById('toHours').value,
        toFullDate = new Date(toDate);
        toHours = toAmPm.value == "PM" ? +(toHours) + 12 : toHours;
        toFullDate.setHours(toFullDate.getHours() + toHours);
        toFullDate.setMinutes(toFullDate.getMinutes() + toMinutes.value);
        /* END GET TIME "TO" INPUT*/
        var toDataParse = Date.parse(toFullDate);
        var fromDataParse = Date.parse(fromFullDate);
        // ["Duration", "Value (kW)", "Cost ($)" ]
        var arrHistogram =[];
        for(prop in histoJsonData){
            if(fromDataParse <= prop && prop <= toDataParse){
                arrHistogram.push(histoJsonData[prop]);
            }
        }
         columnChart(arrHistogram);
    });

    /* END GET TIME AND DATE FROM FIELDS INPUT */

    /* FIND PERIOD FROM OUR DATA (FILE JSON.PHP) */
        // for(var i=histoJsonData.length; i)
    /* FIND PERIOD FROM OUR DATA (FILE JSON.PHP) */    

    

}

