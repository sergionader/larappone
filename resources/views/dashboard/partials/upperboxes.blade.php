@if(Auth::user())
@push('scripts')
<script>
     //get the data to build the upper boxes, conversion rates (TODAY)
    dt_start=  moment().format('YYYY/MM/DD') 
    dt_end = moment().format('YYYY/MM/DD')  

    // dt_start= "{{ Carbon\Carbon::now()->today()->format('m/d/Y') }}" 
    // dt_end = "{{ Carbon\Carbon::today()->format('Y/m/d') }}" 

    // UPPER BOXES      
    url = "{{ route('charts.data.conversionratebydates') }}" 
    $.ajax({
        url: url,
        method: "POST",
        contentType: 'application/json',
        data: JSON.stringify({
            'dt_start': dt_start ,
            'dt_end': dt_end,
            }),
        success: function (response) {
            response        = JSON.parse(response)
            visitsToday     = response.details.visits
            salesToday      = response.details.sales
            rateToday       = response.details.rate
            rateToday       = rateToday+"%"
            
            rateThisMonth   = response.details.rate_this_month
            rateThisMonth   = rateThisMonth+"%"

            rateLastMonth   = response.details.rate_last_month
            rateLastMonth   = rateLastMonth +"%"

            rateThisMonthLastYear   = response.details.rate_this_month_last_year
            rateThisMonthLastYear   = rateThisMonthLastYear+"%"

            // today's rate          
            $("#visits").text(visitsToday)    
            $("#sales").text(salesToday)      
            $("#rate").text(rateToday)    
            // This Month                
            $("#thismonthrate").text(rateThisMonth)    
            // Last Month
            // $("#visits").text(visits)    
            // $("#sales").text(sales)      
            $("#lastmonthrate").text(rateLastMonth)    
            // Last Year
            // $("#visits").text(visits)    
            // $("#sales").text(sales)      
            $("#thismonthlastyearrate").text(rateThisMonthLastYear)    
                                    
        },
        error: function (response) {
            console.log(JSON.stringify(response[0]))
        }
    })
</script>
@endpush
@endif