<div class="az-content az-content-dashboard-four">
    <div class="media media-dashboard">
        <div class="media-body">
            <div class="az-content-header">
                <div>
                    <h6 class="az-content-title tx-18 mg-b-5">Planner Dashboard</h6>
                    <p class="az-content-text tx-13 mg-b-0">Hi, welcome back! Here's your summary of job schedules.</p>
                </div>

                <div class="az-content-header-right">
                    <div class="media">
                        <div class="media-body">
                            <label>Start Date</label>
                            <h6>Jul 29, 2024</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>End Date</label>
                            <h6>Aug 03, 2024</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>Job Category</label>
                            <h6>All Job Types</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <a href="" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</a>
                </div>
            </div><!-- az-content-header -->

            <div class="card card-dashboard-twelve mg-b-20">
                <div class="card-header">
                    <h6 class="card-title">Aug 2024 Overview <span>(All Job Schedules)</span></h6>

                    <div class="sales-overview">
                        <div class="media">
                            <div class="media-icon bg-purple"><i class="typcn typcn-ticket"></i></div>
                            <div class="media-body">
                                <label>Planned Jobs</label>
                                <h4>56</h4>
                                <span><strong>10.5% <i class="fa fa-caret-down text-danger"></i></strong> from last Month</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-icon bg-teal"><i class="typcn typcn-ticket"></i></div>
                            <div class="media-body">
                                <label>Scheduled Jobs</label>
                                <h4>35</h4>
                                <span><strong>89.5%</strong> of 56 Total</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-icon bg-primary"><i class="typcn typcn-chart-area-outline"></i></div>
                            <div class="media-body">
                                <label>Not Scheduled</label>
                                <h4>11</h4>
                                <span><strong>10.4%</strong> of 56 Total</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>About Scheduled Jobs</label>
                                <p>This is a comparison of all jobs synced from the manufacturing ERP vs Jobs that were scheduled in the planner over the last 15 days</p>
<!--                                <label>About Not Closed Jobs</label>-->
<!--                                <p>Jobs not closed include pending, cancelled, on-hold and all other jobs scheduled and were left in a status that is not closed</p>-->
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- sales-overview -->
                </div><!-- card-header -->
                <div class="card-body">
                    <div class="chart-legend">
                        <div><span class="bg-indigo"></span> Scheduled Jobs</div>
                        <div><span class="bg-teal"></span> Jobs not Scheduled</div>
                    </div><!-- chart-legend -->
                    <div class="chart-wrapper">
                        <div id="flotChart" class="flot-chart"></div>
                    </div><!-- chart-wrapper -->
                </div><!-- card-body -->
            </div><!-- card -->

            <div class="row row-sm mg-b-20">
                <div class="col-md-6">
                    <div class="card card-dashboard-fourteen">
                        <label class="az-content-label">Scheduled Jobs <span>(Aug 2024)</span></label>
                        <div class="card-body">
                            <div class="sparkline-wrapper"><span id="sparkline"></span></div>
                        </div>
                        <div class="card-footer row no-gutters">
                            <div class="col-4">
                                <h6>470</h6>
                                <label>Scheduled</label>
                            </div><!-- col -->
                            <div class="col-4">
                                <h6>72</h6>
                                <label>Closed Jobs</label>
                            </div><!-- col -->
                            <div class="col-4">
                                <h6>54</h6>
                                <label>Open & Cancelled Jobs</label>
                            </div><!-- col -->
                        </div><!-- card-footer -->
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-md-6 mg-t-20 mg-md-t-0">
                    <div class="card card-dashboard-fourteen">
                        <label class="az-content-label">Job Types Comparison <span>(Aug 2024)</span></label>
                        <div class="card-body">
                            <h1>899</h1>
                            <label>Total Scheduled Jobs</label>
                            <div class="row mg-t-15">
                                <div class="col-6">
                                    <h4>320</h4>
                                    <span>Pack Jobs</span>
                                    <div class="progress mg-t-5 ht-5">
                                        <div class="progress-bar wd-80p" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>80% of scheduled jobs</small>
                                </div><!-- col -->
                                <div class="col-6">
                                    <h4>431</h4>
                                    <span>Bulk Jobs</span>
                                    <div class="progress mg-t-5 ht-5">
                                        <div class="progress-bar wd-50p bg-teal" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small>50% of scheduled jobs</small>
                                </div><!-- col -->
                            </div><!-- row -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->

            <div class="card card-dashboard-thirteen">
                <label class="az-content-label">Scheduled Job Status Comparison</label>
                <p class="az-content-text">A comparison of all scheduled jobs outcomes by the close of the month.</p>
                <div class="row mg-t-20 mg-b-20">
                    <div class="col-lg-4">
                        <div id="flotPie" class="wd-100p ht-250"></div>
                    </div><!-- col -->
                    <div class="col-lg-8 mg-t-40 mg-lg-t-0">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="media">
                                    <div class="media-icon tx-purple">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>38 <span>(26%)</span></h6>
                                        <label>Completed</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
<!--                                <span>People who have a ticket reservation of the event is automatically mark as interested.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-sm-t-0">
                                <div class="media">
                                    <div class="media-icon tx-primary">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>80 <span>(39%)</span></h6>
                                        <label>In Progress</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <!--                                <span>People who have bought a ticket of the event is automatically mark as going.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-sm-t-0">
                                <div class="media">
                                    <div class="media-icon tx-primary">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>50 <span>(19%)</span></h6>
                                        <label>Dispensed</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <!--                                <span>People who have bought a ticket of the event is automatically mark as going.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-sm-t-0">
                                <div class="media">
                                    <div class="media-icon tx-primary">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>5 <span>(3%)</span></h6>
                                        <label>On-Hold</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
<!--                                <span>People who have bought a ticket of the event is automatically mark as going.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-lg-t-40">
                                <div class="media">
                                    <div class="media-icon tx-teal">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>21 <span>(20%)</span></h6>
                                        <label>Picked</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
<!--                                <span>People who have viewed the event details and set themeselves as maybe.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-lg-t-40">
                                <div class="media">
                                    <div class="media-icon tx-teal">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>12 <span>(10%)</span></h6>
                                        <label>Online</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <!--                                <span>People who have viewed the event details and set themeselves as maybe.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-lg-t-40">
                                <div class="media">
                                    <div class="media-icon tx-gray-500">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>16 <span>(15%)</span></h6>
                                        <label>Complete</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
<!--                                <span>People who have viewed the event details and set themeselves as not going.</span>-->
                            </div><!-- col -->
                            <div class="col-sm-3 mg-t-20 mg-lg-t-40">
                                <div class="media">
                                    <div class="media-icon tx-gray-500">
                                        <i class="icon ion-ios-bookmark"></i>
                                    </div>
                                    <div class="media-body">
                                        <h6>61 <span>(65%)</span></h6>
                                        <label>On Hold</label>
                                    </div><!-- media-body -->
                                </div><!-- media -->
                                <!--                                <span>People who have viewed the event details and set themeselves as not going.</span>-->
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card -->
        </div><!-- media-body -->

        <div class="media-aside">
            <div class="row row-sm">
                <div class="col-md-6 col-lg-4 col-xl-12">
                    <div class="card card-dashboard-calendar">
                        <h6 class="card-title">Today</h6>
                        <div class="media az-media-date">
                            <h1><?php echo date('d'); ?></h1>
                            <div class="media-body">
                                <p><?php echo date('M Y'); ?></p>
                                <span><?php echo date('l'); ?></span>
                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col -->
<!--                <div class="row row-sm">-->
                    <div class="col-md-6 col-lg-4 col-xl-12">
                        <div class="input-group">
                            <input type="text" class="form-control"  placeholder="Search Job Numbers...">
                            <span class="input-group-btn">
                            <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        </div><!-- input-group -->
<!--                        <div id="txtResult3"></div>-->
                        <hr>
                    </div>
<!--                </div>-->
                <div class="col-md-6 col-lg-8 col-xl-12 mg-t-20 mg-md-t-0 mg-xl-t-20">
                    <div class="card card-dashboard-events">
                        <div class="card-header">
                            <h6 class="card-title"><?php echo date('F Y'); ?></h6>
                            <h5 class="card-subtitle">Upcoming Job Schedules</h5>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="event-indicator bg-purple"></div>
                                    <label>Jul 30 <span>Tuesday</span></label>
                                    <h6>UL2407056</h6>
                                    <p>Handy Andy TRG Bathroom 2x6x500ml</p>
                                    <small><span class="tx-danger">On Hold</span> (5877 Packs)</small>
                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Jul 30 <span>Tuesday</span></label>
                                    <h6>UL2407056</h6>
                                    <p>Handy Andy TRG Bathroom 2x6x500ml</p>
                                    <small><span class="tx-warning">Picked</span> (5877 Packs)</small>
                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-pink"></div>
                                    <label>Jul 30 <span>Tuesday</span></label>
                                    <h6>UL2407056</h6>
                                    <p>Handy Andy TRG Bathroom 2x6x500ml</p>
                                    <small><span class="tx-success">Completed</span> (5877 Packs)</small>
                                </div><!-- list-group-item -->
                            </div><!-- list-group -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- media-aside -->
    </div><!-- media -->

</div><!-- az-content -->

<script src="<?php echo Template::theme_url('lib/jquery.flot/jquery.flot.js');?>"></script>
<script src="<?php echo Template::theme_url('lib/jquery.flot/jquery.flot.pie.js');?>"></script>
<script src="<?php echo Template::theme_url('lib/jquery.flot/jquery.flot.resize.js');?>"></script>
<script src="<?php echo Template::theme_url('lib/jquery-sparkline/jquery.sparkline.min.js');?>"></script>
<script src="<?php echo Template::theme_url('lib/jquery-sparkline/jquery.sparkline.min.js');?>"></script>

<script src="<?php echo Template::theme_url('js/chart.flot.sampledata.js');?>"></script>
<script>
    $(function(){
        'use strict'

        // Datepicker found in left sidebar of the page
        var highlightedDays = ['2024-6-10','2024-6-11','2024-6-12','2024-6-13','2024-6-14','2024-6-15','2024-6-16'];
        var date = new Date();

        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                for (var i = 0; i < highlightedDays.length; i++) {
                    if($.inArray(y + '-' + (m+1) + '-' + d,highlightedDays) != -1) {
                        return [true, 'ui-date-highlighted', ''];
                    }
                }
                return [true];
            }
        });

        var plot1 = $.plot('#flotChart', [{
            data: flotSampleData5,
            color: '#6610f2'
        },{
            data: flotSampleData3,
            color: '#00cccc'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: { colors: [ { opacity: 0 }, { opacity: 0.2 } ] }
                }
            },
            grid: {
                borderWidth: 0,
                borderColor: '#969dab',
                labelMargin: 5,
                markings: [{
                    xaxis: { from: 10, to: 20 },
                    color: '#f7f7f7'
                }]
            },
            yaxis: {
                show: false,
                color: '#ced4da',
                tickLength: 10,
                min: 0,
                max: 110,
                font: {
                    size: 11,
                    color: '#969dab'
                },
                tickFormatter: function formatter(val, axis) {
                    return val + 'k';
                }
            },
            xaxis: {
                show: false,
                position: 'top',
                color: 'rgba(0,0,0,0.1)'
            }
        });

        var mqSM = window.matchMedia('(min-width: 576px)');
        var mqSMMD = window.matchMedia('(min-width: 576px) and (max-width: 991px)');
        var mqLG = window.matchMedia('(min-width: 992px)');

        function screenCheck() {
            if (mqSM.matches) {
                plot1.getAxes().yaxis.options.show = true;
                plot1.getAxes().xaxis.options.show = true;
            } else {
                plot1.getAxes().yaxis.options.show = false;
                plot1.getAxes().xaxis.options.show = false;
            }

            if (mqSMMD.matches) {
                var tick = [
                    [0, '<span>Oct</span><span>10</span>'],
                    [20, '<span>Oct</span><span>12</span>'],
                    [40, '<span>Oct</span><span>14</span>'],
                    [60, '<span>Oct</span><span>16</span>'],
                    [80, '<span>Oct</span><span>18</span>'],
                    [100, '<span>Oct</span><span>19</span>'],
                    [120, '<span>Oct</span><span>20</span>'],
                    [140, '<span>Oct</span><span>23</span>']
                ];

                plot1.getAxes().xaxis.options.ticks = tick;
            }

            if (mqLG.matches) {
                var tick = [
                    [10, '<span>Oct</span><span>10</span>'],
                    [20, '<span>Oct</span><span>11</span>'],
                    [30, '<span>Oct</span><span>12</span>'],
                    [40, '<span>Oct</span><span>13</span>'],
                    [50, '<span>Oct</span><span>14</span>'],
                    [60, '<span>Oct</span><span>15</span>'],
                    [70, '<span>Oct</span><span>16</span>'],
                    [80, '<span>Oct</span><span>17</span>'],
                    [90, '<span>Oct</span><span>18</span>'],
                    [100, '<span>Oct</span><span>19</span>'],
                    [110, '<span>Oct</span><span>20</span>'],
                    [120, '<span>Oct</span><span>21</span>'],
                    [130, '<span>Oct</span><span>22</span>'],
                    [140, '<span>Oct</span><span>23</span>']
                ];

                plot1.getAxes().xaxis.options.ticks = tick;
            }
        }

        screenCheck();
        mqSM.addListener(screenCheck);
        mqSMMD.addListener(screenCheck);
        mqLG.addListener(screenCheck);

        plot1.setupGrid();
        plot1.draw();

        $.plot('#flotPie', [
            { label: 'Interested', data: [[1,25]], color: '#6f42c1'},
            { label: 'Going', data: [[1,38]], color: '#007bff'},
            { label: 'Maybe', data: [[1,20]], color: '#00cccc'},
            { label: 'Not Going', data: [[1,15]], color: '#969dab'}
        ], {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                    label: {
                        show: true,
                        radius: 3/4,
                        formatter: labelFormatter
                    }
                }
            },
            legend: { show: false }
        });

        function labelFormatter(label, series) {
            return '<div style="font-size:11px; font-weight:500; text-align:center; padding:2px; color:white;">' + Math.round(series.percent) + '%</div>';
        }


        $('#sparkline').sparkline([15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15], {
            type: 'bar',
            height: 100,
            barWidth: 7,
            barColor: '#e9ecef',
            barSpacing: 5,
            chartRangeMin: 0,
            chartRangeMax: 15,
            disableTooltips: true,
            disableHighlight: true
        });

        $('#sparkline').sparkline([1,2,4,4,7,5,9,10,6,4,4,7,5,9,10,5,9,10,6,4,4,7,5,9,10,9,10,6,4,4,7,5,6,4,3,4], {
            composite: true,
            type: 'bar',
            barWidth: 7,
            barSpacing: 5,
            height: 100,
            barColor: '#6f42c1',
            chartRangeMin: 0,
            chartRangeMax: 15,
            disableTooltips: true,
            disableHighlight: true
        });


    });
</script>