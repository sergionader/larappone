<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <!-- Custom Tabs -->
    <!-- <div class="nav-tabs-custom"> -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-database"></i></a></li>
            <li><a href="#tab-settings" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
            <!-- <li><a href="#tab-settings" data-toggle="tab"></a><i class="fa fa-gears"></i></li> -->
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Data Generation 
                        <br><small>
                        @if(!Auth::user())
                            <b>Only administrators can use these features.</b>
                        @else
                            @if(Auth::user()->id !=1 )
                                <b>Only administrators can use these features.</b>
                            @endif
                        @endif
                        </small>
                </h3>
                <div class="control-menu-panel-outer">
                    <div class="menu-info">
                    <div class="row">
                        <div class="box box-default collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Random Records</h3>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="control-menu-panel-inner ">
                                    
                      
                                This action will create visits with sales (given by the number of records below) and visits without sale (over the number
                                of the records). Thus the total number of visits will be greater the number you enter.
                                <br>For each visit with sale there will one to five products bound to it with some bias to
                                make the numbers more natural.                                    
                                <br>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form id="formGetDates" action="">
                                            <div class="form-group">
                                            <input type="text" class="form-control" id="records" placeholder="# of records to create">
                                            <div class="checkbox">
                                                <label>
                                                    <input id="zero_sales_only" type="checkbox" value="">Zero Sales Only
                                                </label>
                                            </div>
                                            <p id="records-alert" class="alert alert-warning" hidden>
                                                Please enter the number of records to be created.
                                            </p>
                                            </div>
                                            <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                </span>
                                                <input type="text" id="datarange-control-side-bar" class="form-control date-range-input">
                                            </div>
                                            </div>
                                            <div class="control-menu-button">
                                            <br>
                                            <button type="button" 
                                                class="btn btn-success" 
                                                id="createRecords" 

                                                @if(!Auth::user())
                                                    disabled
                                                @else
                                                    @if(Auth::user()->id !=1 )
                                                     disabled
                                                    @endif
                                                @endif
                                                data-loading-text="<i class='fa fa-spinner fa-spin '></i>&nbsp;Creating Records">
                                                Create Records
                                            </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /menu-info -->
                    <div class="menu-info">
                    <div class="row">
                        <div class="box box-default collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Populate Aux Tables</h3>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="control-menu-panel-inner">
                                <p>
                                        <p>This action will delete all data and then add data to the auxiliary tables. The following users will be recreated as well:  
                                                <br>"User 1 (John) - user1@example.org", "User 2 (Mary) - user2@example.org" and
                                                "User 3 (Peter) - user3@example.org", all of them with the passwords test1234.
                                            </p>
                                </p>
                                <div class="control-menu-button">
                                    <button type="button" 
                                        class="btn btn-warning" 
                                        id="populateDB" 
                                        
                                        @if(!Auth::user())
                                            disabled
                                        @else
                                            @if(Auth::user()->id !=1 )
                                                disabled
                                            @endif
                                        @endif
                                        data-loading-text="<i class='fa fa-spinner fa-spin '></i>&nbsp;Deleting & Populating">
                                    Populate
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.menu info -->
                    <div class="menu-info">
                    <div class="row">
                        <div class="box box-default collapsed-box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Delete All Records</h3>
                                <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="control-menu-panel-inner">
                                <p>
                                    This action will delete all data and then add only to the users table: 
                                    <br>"User 1 (John) - user1@example.org", "User 2 (Mary) - user2@example.org" and
                                    "User 3 (Peter) - user3@example.org", all of them with the passwords test1234.
                                    <br>If you want to add random records, you must first populate the auxilariary tables as desbribed above. 
                                </p>
                                <div class="control-menu-button">
                                    <button type="button" 
                                        class="btn btn-danger" 
                                        id="migrateDB" 
                                        
                                        @if(!Auth::user())
                                            disabled
                                        @else
                                            @if(Auth::user()->id !=1 )
                                                disabled
                                            @endif
                                        @endif
                                        data-loading-text="<i class='fa fa-spinner fa-spin '></i>&nbsp;Deleting">
                                    Delete
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div> <!-- /.menu info -->
                </div> <!-- /.control-menu-panel-outer -->
            </div> <!-- /.tab-pane -->
            <div class="tab-pane" id="tab-settings">
                <h4 class="control-sidebar-heading">
                Layout Options
                </h4>
                <!-- // Fixed layout -->
                <!-- <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-layout="fixed"class="pull-right"/>
                    Fixed layout
                    </label>
                    <p>Activate the fixed layout. You can\'t use fixed and boxed layouts together</p>
                </div> -->
                <!-- // Boxed layout -->
                <!-- <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-layout="layout-boxed" class="pull-right"/> 
                    Boxed Layout
                    </label>
                    <p>Activate the boxed layout</p>
                </div> -->
                <!-- // Sidebar Toggle -->
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-layout="sidebar-collapse"class="pull-right"/>
                    Toggle Sidebar
                    </label>
                    <p>Toggle the left sidebar's state (open or collapse)</p>
                </div>
                <!-- // Sidebar mini expand on hover toggle -->
                <!-- <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-enable="expandOnHover"class="pull-right"/> 
                    Sidebar Expand on Hover
                    </label>
                    <p>Let the sidebar mini expand on hover</p>
                </div> -->
                <!-- // Control Sidebar Toggle -->
                <!-- <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-controlsidebar="control-sidebar-open"class="pull-right"/>
                    Toggle Right Sidebar Slide
                    </label>
                    <p>Toggle between slide over content and push content effects</p>
                </div> -->
                <!-- // Control Sidebar Skin Toggle -->
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox"data-sidebarskin="toggle"class="pull-right"/>
                    Toggle Right Sidebar Skin
                    </label>
                    <p>Toggle between dark and light skins for the right sidebar</p>
                </div>
                <!-- <h4 class="control-sidebar-heading">Skins</h4> -->
                <div id="demoSettings">
                        
                </div>
            </div> <!-- /.tab-pane -->
        </div> <!-- Home tab content -->
    <!-- </div>   nav-tabs-custom -->
</aside>
<div class='control-sidebar-bg'></div>

@push('scripts')
<script>
$(document).ready(function () {
        /** =================================================== */
    /** DATARANGE IS ALSO USED THE BY THE CHARTLOADER BLADE */
    /** =================================================== */
    $('.date-range-input').daterangepicker({
        "showDropdowns": true,
        "opens": "left",
        "buttonClasses": "btn",
        "cancelClass": "btn-danger",
        "ranges": {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')],
            'This Year': [moment().startOf('year'), moment()],
            'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
        },
        "startDate": moment().startOf('month'),
        "endDate": moment()
    })

    $("#createRecords").on("click", function () {
        records = parseInt($("#records").val());
        zero_sales_only = 0;
        if($("#zero_sales_only").is(':checked')){
            zero_sales_only = 1;
        }
        if (!records || records <=0) {
            BootstrapDialog.show({
                title: "Your attention, please",
                type: BootstrapDialog.TYPE_WARNING,
                buttons: [{
                    label: 'Close',
                    action: function (dialogRef) {
                        dialogRef.close();
                    }
                }],
                message: "Please inform the number of records. It has to be a positive integer/"
            });
            return;
        }
       
        var $this = $(this);
        $this.button('loading');
        date = $('#datarange-control-side-bar').val();
        dt_start = date.substring(0, 10)
        dt_end = date.substring(13, 23)
        
        // DATE CHECK
        dt_start_validate = moment(dt_start, "MM/DD/YYYY", true).isValid()
        dt_end_validate = moment(dt_end, "MM/DD/YYYY", true).isValid()

        if (!(dt_start_validate && dt_end_validate)) {
            BootstrapDialog.show({
                title: "Your attention, please",
                type: BootstrapDialog.TYPE_WARNING,
                buttons: [{
                    label: 'Close',
                    action: function (dialogRef) {
                        dialogRef.close();
                    }
                }],
                message: "Invalid dates. The date range should have a start and end date in this format: 'MM/DD/YYYY - MM/DD/YYYY'. Please correct them and try again."
            });
            return
        }
        //***  DATE CHECK
        dt_temp = "";
        if (dt_end < dt_start) {
            dt_temp = dt_end;
            dt_end = dt_start;
            dt_start = dt_temp
        }
        currentURL = window.location.href.split('?')[0];
        currentURL = currentURL.replace("#", "");
        url = "{{route('helpers.createrecords')}}" + "?" + "url=" + currentURL + "&dt_start=" +
            dt_start + "&dt_end=" + dt_end + "&records=" + records + "&zero_sales_only=" + zero_sales_only
        window.location.href = url;       
        
    })
    $("#populateDB").on("click", function () {
        var $this = $(this);
        BootstrapDialog.confirm({
            message: 'This will delete all data and then add data to the auxiliary tables. Proceed?',
            type: BootstrapDialog.TYPE_DANGER,
            title: 'DELETE ALL?',
            autospin: true,
            closable: true,
            btnCancelLabel: 'Cancel',
            btnOKLabel: 'Delete and Populate',
            callback: function (result) {
                if (result) {
                    $this.button('loading');
                    url = "{{route('helpers.populatedb')}}" + "?" + "url=" + window.location.href
                    window.location.href = url;
                } else {
                    // if user cancels the deletion. 
                    return
                }
            }
        }) // <</CONFIRM PRODUCT DELETE>> 
    })
    
    $("#migrateDB").on("click", function () {
        var $this = $(this);
        BootstrapDialog.confirm({
            message: 'This will delete all data and cannot be undone! Proceed? ',
            type: BootstrapDialog.TYPE_DANGER,
            title: 'DELETE ALL?',
            autospin: true,
            closable: true,
            btnCancelLabel: 'Cancel',
            btnOKLabel: 'Delete',
            callback: function (result) {
                if (result) {
                    $this.button('loading');
                    url = "{{route('helpers.migratedb')}}" + "?" + "url=" + window.location.href
                    window.location.href = url
                } else {
                    // if user cancels the deletion. 
                    return
                }
            }
        }) // <</CONFIRM PRODUCT DELETE>> 
    })

})
</script>
@endpush