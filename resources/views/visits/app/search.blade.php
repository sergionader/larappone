<script src="{{ URL::to('vendor/jquery/dist/jquery.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.2.4/dist/instantsearch.min.css">
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.2.4/dist/instantsearch.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.2.4/dist/instantsearch-theme-algolia.min.css">


@extends('layouts.master') 
@section('content') 

<div id="search-box">
    <!-- SearchBox widget will appear here -->
  </div>
<div id="current-refined-values">
    <!-- CurrentRefinedValues widget will appear here -->
  </div>
  
  <div id="clear-all">
    <!-- ClearAll widget will appear here -->
  </div>
  
  <div id="hits">
      <!-- Hits widget will appear here -->
    </div>

    
  
  <div id="pagination">
    <!-- Pagination widget will appear here -->
  </div>
  


<div id="pagination">
  <!-- Pagination widget will appear here -->
</div>
@stop
<script>
$(document).ready(function() {
  // const search = instantsearch(options);
  const search = instantsearch({
    appId: 'latency',
    apiKey: '3d9875e51fbd20c7754e65422f7ce5e1',
    indexName: 'bestbuy',
    urlSync: true
  });


 // initialize currentRefinedValues
 search.addWidget(
  instantsearch.widgets.currentRefinedValues({
    container: '#current-refined-values',
    // This widget can also contain a clear all link to remove all filters,
    // we disable it in this example since we use `clearAll` widget on its own.
    clearAll: false
  })
);

// initialize clearAll
search.addWidget(
  instantsearch.widgets.clearAll({
    container: '#clear-all',
    templates: {
      link: 'Reset everything'
    },
    autoHideContainer: false
  })
);



    // initialize currentRefinedValues
    // search.addWidget(
    //   instantsearch.widgets.currentRefinedValues({
    //     container: '#current-refined-values',
    //     // This widget can also contain a clear all link to remove all filters,
    //     // we disable it in this example since we use `clearAll` widget on its own.
    //     clearAll: false
    //   })
    // );
    // initialize clearAll
    search.addWidget(
        instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'Search for products'
        })
      );
    search.addWidget(
      instantsearch.widgets.hits({
        container: '#hits',
        templates: {
          empty: 'No results',
          item: '<em>Hit @{{objectID}}</em>: @{{{_highlightResult.name.value}}}'
        }
      })
    );

  
    // // initialize pagination
    search.addWidget(
      instantsearch.widgets.pagination({
        container: '#pagination',
        maxPages: 20,
        // default is to scroll to 'body', here we disable this behavior
        scrollTo: false
      })
    );


    search.start();
})
    
</script>
