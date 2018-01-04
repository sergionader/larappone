
// fakeVisitor_id= 14,
// fakePlace_id= 16,
// fakeProduct_id= 36

$(document).ready(function() {
    // $('.date').datepicker({  $('.date').datepicker({  
    //     format: 'mm/dd/yyyy'
    // });         

    // ********* SIDE BAR **********
    // to keep the side menu open after click and with the proper item selected
    var url = window.location;

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
    // ********* SIDE BAR **********

    // Date Picker
    dateOnControl = $("#dt").val()

    $("#dt").daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
          },
        singleDatePicker: true,
        showDropdowns: true,
        startDate: dateOnControl,
    })
    if ($("#dt").val()==='Invalid date'){
        $('#dt').data('daterangepicker').setStartDate(moment());
    }
    
    // Time Picker
    // $('#tm').timepicker({
    //     showSeconds: true
    // });




// CONTROL SIDE BAR
$(function () {
    'use strict'
  
    /**
     * Get access to plugins
     */
  
    // $('[data-toggle="control-sidebar"]').controlSidebar()
    // $('[data-toggle="push-menu"]').pushMenu()
  
    var $pushMenu       = $('[data-toggle="push-menu"]').data('lte.pushmenu')
    // var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
    var $controlSidebar = $('controleSideBar')
    var $layout         = $('body').data('lte.layout')
    
    /**
     * List of all the available skins
     *
     * @type Array
     */
    var mySkins = [
      'skin-blue',
      'skin-black',
      'skin-red',
      'skin-yellow',
      'skin-purple',
      'skin-green',
      'skin-blue-light',
      'skin-black-light',
      'skin-red-light',
      'skin-yellow-light',
      'skin-purple-light',
      'skin-green-light'
    ]
  
    /**
     * Get a prestored setting
     *
     * @param String name Name of of the setting
     * @returns String The value of the setting | null
     */
    function get(name) {
      if (typeof (Storage) !== 'undefined') {
        return localStorage.getItem(name)
      } else {
        window.alert('Please use a modern browser to properly view this template!')
      }
    }
  
    /**
     * Store a new settings in the browser
     *
     * @param String name Name of the setting
     * @param String val Value of the setting
     * @returns void
     */
    function store(name, val) {
      if (typeof (Storage) !== 'undefined') {
        localStorage.setItem(name, val)
      } else {
        window.alert('Please use a modern browser to properly view this template!')
      }
    }
  
    /**
     * Toggles layout classes
     *
     * @param String cls the layout class to toggle
     * @returns void
     */
    function changeLayout(cls) {
      $('body').toggleClass(cls)
      $layout.fixSidebar()
      if ($('body').hasClass('fixed') && cls == 'fixed') {
        $pushMenu.expandOnHover()
        $layout.activate()
      }
      // $controlSidebar.fix()
    }
  
    /**
     * Replaces the old skin with the new skin
     * @param String cls the new skin class
     * @returns Boolean false to prevent link's default action
     */
    function changeSkin(cls) {
      $.each(mySkins, function (i) {
        $('body').removeClass(mySkins[i])
      })
  
      $('body').addClass(cls)
      store('skin', cls)
      return false
    }
  
    /**
     * Retrieve default settings and apply them to the template
     *
     * @returns void
     */
    function setup() {
      var tmp = get('skin')
      if (tmp && $.inArray(tmp, mySkins))
        changeSkin(tmp)
  
      // Add the change skin listener
      $('[data-skin]').on('click', function (e) {
        if ($(this).hasClass('knob'))
          return
        e.preventDefault()
        changeSkin($(this).data('skin'))
      })
  
      // Add the layout manager
      $('[data-layout]').on('click', function () {
        changeLayout($(this).data('layout'))
      })
  
      $('[data-controlsidebar]').on('click', function () {
        changeLayout($(this).data('controlsidebar'))
        var slide = !$controlSidebar.options.slide
  
        $controlSidebar.options.slide = slide
        if (!slide)
          $('.control-sidebar').removeClass('control-sidebar-open')
      })
  
      $('[data-sidebarskin="toggle"]').on('click', function () {
        var $sidebar = $('.control-sidebar')
        if ($sidebar.hasClass('control-sidebar-dark')) {
          $sidebar.removeClass('control-sidebar-dark')
          $sidebar.addClass('control-sidebar-light')
        } else {
          $sidebar.removeClass('control-sidebar-light')
          $sidebar.addClass('control-sidebar-dark')
        }
      })
  
      $('[data-enable="expandOnHover"]').on('click', function () {
        $(this).attr('disabled', true)
        $pushMenu.expandOnHover()
        if (!$('body').hasClass('sidebar-collapse'))
          $('[data-layout="sidebar-collapse"]').click()
      })
  
      //  Reset options
      if ($('body').hasClass('fixed')) {
        $('[data-layout="fixed"]').attr('checked', 'checked')
      }
      if ($('body').hasClass('layout-boxed')) {
        $('[data-layout="layout-boxed"]').attr('checked', 'checked')
      }
      if ($('body').hasClass('sidebar-collapse')) {
        $('[data-layout="sidebar-collapse"]').attr('checked', 'checked')
      }
  
    }
  
    // Create the new tab
    var $tabPane = $('#tabPane');

  
    // Create the tab button
    var $tabButton = $('#wrench');

    var $demoSettings = $('#demoSettings')
    var $skinsList = $('<ul />', { 'class': 'list-unstyled clearfix' })
  
    // Dark sidebar skins
    var $skinBlue =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Blue</p>')
    $skinsList.append($skinBlue)
    var $skinBlack =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Black</p>')
    $skinsList.append($skinBlack)
    var $skinPurple =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Purple</p>')
    $skinsList.append($skinPurple)
    var $skinGreen =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Green</p>')
    $skinsList.append($skinGreen)
    var $skinRed =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Red</p>')
    $skinsList.append($skinRed)
    var $skinYellow =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin">Yellow</p>')
    $skinsList.append($skinYellow)
  
    // Light sidebar skins
    var $skinBlueLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Blue Light</p>')
    $skinsList.append($skinBlueLight)
    var $skinBlackLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Black Light</p>')
    $skinsList.append($skinBlackLight)
    var $skinPurpleLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Purple Light</p>')
    $skinsList.append($skinPurpleLight)
    var $skinGreenLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Green Light</p>')
    $skinsList.append($skinGreenLight)
    var $skinRedLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Red Light</p>')
    $skinsList.append($skinRedLight)
    var $skinYellowLight =
          $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
            .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
              + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
              + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
              + '</a>'
              + '<p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>')
    $skinsList.append($skinYellowLight)
  
    $demoSettings.append('<h4 class="control-sidebar-heading">Skins</h4>')
    $demoSettings.append($skinsList)
  
    $tabPane.append($demoSettings)
    $('#control-sidebar-home-tab').after($tabPane)
  
    setup()
  
    $('[data-toggle="tooltip"]').tooltip()
  })
  // END CONTROL SIDE BAR


}) 
// document ready
function shade(color, percent){
    if (color.length > 7 ) return shadeRGBColor(color,percent);
    else return shadeColor2(color,percent);
}
function shadeColor2(color, percent) {   
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}
// $(document).ready( function (){
//     var $this = $(".pnl-collapse");
//     if(!$this.hasClass('panel-collapsed')) {
//         $this.parents('.panel').find('.panel-body').slideUp();
//         $this.addClass('panel-collapsed');
//         $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
//     }
// })

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
})
function listAllScripts(){
    var scripts = document.getElementsByTagName('script');
    for(var i=0;i<scripts.length;i++){
        console.log( scripts[i].src);
    }
}