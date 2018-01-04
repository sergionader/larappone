@push('scripts')
<script>
    $(document).ready(function() {
        var charts = $('.chart');    
        for(var i=0;i<charts.length;i++){
            $("#" + charts[i].id).hide()
        }
    }); // /document ready
    function chartArea(dt_start, dt_end){
        url = "{{ route('charts.data.chartarea') }}" 
        $.ajax({
            url: url,
            method: "POST",
            contentType: 'application/json',
            data: JSON.stringify({
                'dt_start': dt_start,
                'dt_end': dt_end,
                }),
            success: function (response) { 
                response = JSON.parse(response);
                options = {
                    chart: {
                        renderTo: 'chartArea',
                        type: 'areaspline',
                        backgroundColor:'rgba(255, 255, 255, 0.0)'
                        },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text: 'From ' + dt_start + ' to ' + dt_end,
                    },
                    xAxis: {
                        categories: response[0].dates,                       
                    },

                    areaspline: {
                        fillOpacity: 0.5
                    },
                    tooltip: {
                        shared: true,
                        valueSuffix: ' #'
                    },
                    plotOptions: {
                        areaspline: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    series: [{
                            name: 'Visits',
                            data: response[0].visits
                        }, {
                            name: 'Sales',
                            data: response[0].sales
                        }],
                    yAxis: {
                        title: {
                            text: ''
                        },                            
                    },
                }
                    chart = new Highcharts.Chart(options);
            }
        })
    } // /chartArea
    function chartMap (dt_start, dt_end){
        google.charts.load('current', {
            'packages':['geochart','corechart','table'],                       
            'mapsApiKey': 'AIzaSyBXCmKIPPDG3bjMOhJrnQbK-bQb6iombWQ'
        });
        google.charts.setOnLoadCallback(drawChart); 
        
    } // /chartMap
    function drawChart(){
        url = "{{ route('charts.data.chartmap') }}" 
        $.ajax({
            url: url,
            method: "POST",
            contentType: 'application/json',
            data: JSON.stringify({
                'dt_start': dt_start,
                'dt_end': dt_end,
                }),
            success: function (response) {                    
                var data = google.visualization.arrayToDataTable(response);   
                var options = {
                    colorAxis: {colors: ['#c9d6e4', '#28649c']},
                    backgroundColor: 'transparent',
                    datalessRegionColor: '##F4EDED',
                    defaultColor: '#ccd0d9',
                };   
                var chart = new google.visualization.GeoChart(document.getElementById('chartMap'));
                chart.draw(data, options);
            }
        })
    } // /drawChart
    function chartStackedColumns(dt_start, dt_end){
        url = "{{ route('charts.data.chartstackedsolumns') }}" 
        $.ajax({
            url: url,
            method: "post",
            contentType: 'application/json',
            data: JSON.stringify({
                'dt_start': dt_start,
                'dt_end': dt_end,
                }),
            success: function (response) {
                console.log(JSON.parse(response))
                // return;
                Highcharts.setOptions({
                    colors: ['#058DC7', '#6495ED', '#1a5991', '#33cbe3', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
                });
                response    = JSON.parse(response);  
                data = response[0].data
                categories = response[0].months
                var colors = Highcharts.getOptions().colors,
                run = true
                options = {
                    chart: {
                        renderTo: 'chartStackedColumns',
                        type: 'column',
                        backgroundColor:'rgba(255, 255, 255, 0.0)',
                        events: {
                            load: function(event) {
                            var total = 0;
                            $.each(response[0].data, function(key, value) {
                                $.each(value.data, function(k,v){
                                    total += v
                                })
                            });                                                        
                            totalText = this.renderer.text(
                                'Total: ' + Number(total).toLocaleString(),
                                this.plotLeft,
                                this.plotTop - 20, 
                                this.align= 'left',                           
                            ).attr({
                                zIndex: 5
                            }).add()
                            },
                            redraw: function(chart) {                               
                                total = 0;
                                lenSeries= this.series.length;
                                for (j=0;j<lenSeries;j++){
                                    for(var i=0, len=this.series[j].yData.length; i<len; i++){
                                        if (this.series[j].visible){
                                            total += this.series[j].yData[i];
                                        }
                                    }
                                }                                
                                totalText.element.innerHTML = 'Total: ' + Number(total).toLocaleString() 
                            }
                        } //events
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text:  'From ' + dt_start + ' to ' + dt_end,
                        // align: 'right',
                        y: 4
                    },
                    xAxis: {
                        categories: categories,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Gross Revenue'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            },               
                        }
                    },
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        floating: false,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false, 
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                        }
                    },
                    series: 
                        data
                },  
                chart = new Highcharts.Chart(options);   
            },
            error: function (response) {     
                BootstrapDialog.show({
                    title: "Your attention, please",
                    type: BootstrapDialog.TYPE_WARNING,
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'There was an error: ' + JSON.stringify(response)
                });
            }
        }); // /ajax
    }   //  /chartStackedColumns
    function chartDonut(dt_start, dt_end){       
        url = "{{ route('charts.data.chartDonut') }}" 
        $.ajax({
            url: url,
            method: "POST",
            contentType: 'application/json',
            data: JSON.stringify({
                dt_start,
                dt_end
                }),
            success: function (response) {    
                Highcharts.setOptions({
                    colors: ['#058DC7', '#6495ED', '#1a5991', '#33cbe3', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
                });                
                types = response.type
                subtypes = response.subtype
                var colors = Highcharts.getOptions().colors,
                run = true
                options = {
                    chart: {
                        renderTo: 'chartDonutdrilldown',
                        type: 'pie',
                        backgroundColor:'rgba(255, 255, 255, 0.0)'
                    },
                    title: {
                        text: ''
                    },
                    subtitle: {
                        text:  'From ' + dt_start + ' to ' + dt_end,
                       
                    },
                    plotOptions: {
                        pie: {
                            shadow: false,
                            center: ['50%', '50%']
                        }
                    },
                    tooltip: {
                        formatter: function () {
                                return '<b>'+ this.point.name + ' ' +  this.point.id + '</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            },
                    },
                    series: [{
                        name: 'Types',
                        cursor: 'pointer',
                        data: types,
                        id: types.id,
                        size: '60%',
                        dataLabels: {
                            formatter: function () {
                                return '<b>'+ this.point.name  +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            },
                            color: '#ffffff',
                            distance: -30
                        },
                        point: {
                            events: {
                                click: function() {
                                    // drill down chart
                                    if(!run){
                                        return
                                    }                                   
                                    typeID = JSON.stringify( options.series[0].data[this.x].id)
                                    typeColor = JSON.stringify(types[this.x].color)
                                    dt_temp="";
                                    if(dt_end<dt_start){
                                        dt_temp = dt_end;
                                        dt_end = dt_start;
                                        dt_start= dt_temp
                                    }                                     
                                    eventURL ="{{ route('charts.data.subtypeproductbytype') }}" 
                                    $.ajax({
                                        url: eventURL,
                                        method: "post",
                                        contentType: 'application/json',
                                        dataType: "json",
                                        data: JSON.stringify({
                                            "type_id": typeID,
                                            dt_start,
                                            dt_end
                                        }),
                                        success: function (response) {
                                            options.subtitle.text =  JSON.stringify(response.chart.title) + ' from ' + dt_start + ' to ' + dt_end,                                           
                                            options.series[0].cursor = '';
                                            subtypesDD = response.subtype
                                            subtype_prods = response.subtype_prod
                                            options.series[0].data = subtypesDD
                                            options.series[1].data = subtype_prods
                                            var thisChartColor = Highcharts.getOptions().colors
                                            // handle the colors of the outer circle
                                            for (i=0; i<subtypesDD.length; i++){
                                                brightness = 0.2 - (i/subtype_prods.length) / 5;  
                                                thisColor = thisChartColor[i]                                 
                                                thisColorLightened = Highcharts.Color(thisColor).brighten(brightness).get()
                                                for (j=0; j<subtype_prods.length; j++){
                                                    if(subtypesDD[i].id===subtype_prods[j].subtype_id){
                                                        options.series[1].data[j].color = thisColorLightened
                                                    }
                                                }
                                            }
                                            chart = new Highcharts.Chart(options);
                                            run = false
                                            chart.renderer.button(
                                                'Back', 2, 5, 
                                                function(){                                                       
                                                    chartDonut(dt_start, dt_end);
                                                },null,null,null).add();
                                        },   // /success: function (response) function
                                        error: function(response){
                                            BootstrapDialog.show({
                                                title: "Your attention, please",
                                                type: BootstrapDialog.TYPE_WARNING,
                                                buttons: [{
                                                    label: 'Close',
                                                    action: function (dialogRef) {
                                                        dialogRef.close();
                                                    }
                                                }],
                                                message: 'There was an error: ' + JSON.stringify(response)
                                            });
                                        }
                                    });// /ajax             
                                }
                            },
                        },
                    }, {
                        name: 'Subtypes',
                        data: subtypes,
                        size: '80%',
                        innerSize: '60%',
                        dataLabels: {
                            formatter: function () {
                                return '<b>'+ this.point.name + '</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                            }
                        },
                    }],
                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 400
                            },
                            chartOptions: {
                                series: [{
                                    id: 'versions',
                                    dataLabels: {
                                        enabled: false
                                    }
                                }]
                            }
                        }]
                    }   
                }
                //main chart (outer and inner)
                var thisChartColor = Highcharts.getOptions().colors
                // handle the colors of the outer circle
                for (i=0; i<response.type.length; i++){
                    brightness = 0.2 - (i/subtypes.length) / 5;  
                    thisColor = thisChartColor[i]                                 
                    thisColorLightened = Highcharts.Color(thisColor).brighten(brightness).get()
                    for (j=0; j<subtypes.length; j++){
                        if(types[i].id===subtypes[j].type_id){
                            options.series[1].data[j].color = thisColorLightened
                        }
                    }
                }
                chart = new Highcharts.Chart(options);
            },
            error: function (response) {     
                BootstrapDialog.show({
                    title: "Your attention, please",
                    type: BootstrapDialog.TYPE_WARNING,
                    buttons: [{
                        label: 'Close',
                        action: function (dialogRef) {
                            dialogRef.close();
                        }
                    }],
                    message: 'There was an error: ' + JSON.stringify(response)
                });
            }
        });  
    } // /chartDonut()
</script>
@endpush
</html>
