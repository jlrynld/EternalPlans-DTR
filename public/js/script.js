function getCurrentTime(){
    $.ajax({
        url: "/get-current-time",
        method: 'GET',
        success: function(response) {
            //SET TIME SAMPLE
            $("#dayname").text(response.dayname)
            $("#month").text(response.month)
            $("#daynum").text(response.daynum)
            $("#year").text(response.year)

            $("#hour").text(response.hour)
            $("#minutes").text(response.minutes)
            $("#seconds").text(response.seconds)
            $("#period").text(response.period)
        },
    });
}


