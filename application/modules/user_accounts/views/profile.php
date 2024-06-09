<div class="container">
    <div class="az-content-body">
<div class="az-content-body az-content-profile">
    <div class="container mn-ht-100p">
        <div class="az-content-left az-content-left-profile">

            <div class="az-profile-overview">
                <div class="az-img-user"><br>
                    <img src="<?php echo Template::theme_url('images/user.png');?>" alt="">
                </div><!-- az-img-user -->
                <div class="d-flex justify-content-between mg-b-20">
                    <div>
                        <h5 class="az-profile-name"><?php echo $user_details->display_name; ?></h5>
                        <p class="az-profile-name-text"><?php echo $user_details->role_name; ?></p>
                    </div>
                    <div class="btn-icon-list">
                        <a href="#modaldemo8"  data-toggle="modal" data-effect="effect-just-me" class="btn btn-primary btn-icon modal-effect text-light" title="Edit Profile"><i class="typcn typcn-edit"></i></a>
                        <a href="#change_password"  data-toggle="modal" data-effect="effect-just-me" class="btn btn-primary btn-icon modal-effect text-light" title="Change Password"><i class="typcn typcn-lock-open"></i></a>
                    </div>
                </div>

                <div class="az-profile-bio">
                    Welcome to your user account profile. View recent activity and edit your user credentials and information</a>
                </div><!-- az-profile-bio -->

                <hr class="mg-y-30">

                <label class="az-content-label tx-13 mg-b-20">Websites &amp; User Guide</label>
                <div class="az-profile-social-list">
                    <div class="media">
                        <div class="media-icon"><i class="icon ion-md-medkit"></i></div>
                        <div class="media-body">
                            <span>TRT Manufacturing</span>
                            <a href="https://www.trtmanufacturing.com" target="_blank">trtmanufacturing.com</a>
                        </div>
                    </div><!-- media -->

                    <div class="media">
                        <div class="media-icon"><i class="icon ion-md-help-circle"></i></div>
                        <div class="media-body">
                            <span>Help</span>
                            <a href="<?php echo Template::theme_url('images/Planner_Manual.pdf');?>" target="_blank">User Guide pdf</a>
                        </div>
                    </div><!-- media -->

                </div><!-- az-profile-social-list -->

            </div><!-- az-profile-overview -->

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-profile">
<!--            <nav class="nav az-nav-line">-->
<!--                <a href="" class="nav-link active" data-toggle="tab">Overview</a>-->
<!--                <a href="" class="nav-link" data-toggle="tab">Reviews</a>-->
<!--                <a href="" class="nav-link" data-toggle="tab">Followers</a>-->
<!--                <a href="" class="nav-link" data-toggle="tab">Following</a>-->
<!--                <a href="" class="nav-link" data-toggle="tab">Account Settings</a>-->
<!--            </nav>-->

            <div class="az-profile-body">

                <div class="row mg-b-20">
                    <div class="col-md-7 col-xl-8">
                        <div class="az-profile-view-chart">
                            <canvas id="chartArea"></canvas>
                            <div class="az-profile-view-info">
                                <div class="d-flex align-items-baseline">
                                    <h6><?php echo $activity_count->total; ?></h6>
                                    <span class="text-warning">past 10 months</span>
                                </div>
                                <p>Activities per month</p>
                            </div>
                        </div>
                    </div><!-- col -->
                    <div class="col-md-5 col-xl-4 mg-t-40 mg-md-t-0">
                        <div class="az-content-label tx-13 mg-b-20">Activity by Modules</div>
                        <?php $n=0; $label="bg-success"; foreach($activity_module_count as $m): $n++;
                            switch ($n){
                                case 1:
                                    $label="bg-primary";
                                    break;
                                case 2:
                                    $label="bg-warning";
                                    break;
                                case 3:
                                    $label="bg-info";
                                    break;
                                case 4:
                                    $label="bg-pink";
                                    break;
                                case 5:
                                    $label="bg-danger";
                                    break;
                                default:
                                    $label="bg-warning";
                            }
                        ?>
                        <div class="az-traffic-detail-item">
                            <div>
                                <span><?php echo ucwords($m->module); ?> module</span>
                                <span><?php echo $m->total; ?> <span>(<?php echo number_format(($m->total/$activity_count->total) * 100,1); ?>%)</span></span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar <?php echo $label; ?> wd-<?php echo round((($m->total/$activity_count->total) * 100)/5)*5; ?>p" role="progressbar" aria-valuenow="<?php echo ($m->total/$activity_count->total) * 100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div><!-- progress -->
                        </div>
                        <?php endforeach; ?>

                    </div><!-- col -->
                </div><!-- row -->

                <hr class="mg-y-40">

                <div class="row">
                    <div class="col-md-7 col-xl-8">
                        <div class="az-content-label tx-13 mg-b-25">Recent Activity</div>
                        <div class="az-profile-work-list">
                            <?php foreach($activity as $a): ?>
                            <div class="media">
                                <div class="media-logo bg-warning text-white-50"><i class="icon ion-ios-apps"></i></div>
                                <div class="media-body">
                                    <span class="h6"><?php echo ucwords($a->module); ?> Module <small class="text-lg-right">(<?php echo date('d-M-Y h:i a',strtotime($a->created_on));?>)</small></span>

                                    <p><?php echo $a->activity; ?></p>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <?php endforeach; ?>

                        </div><!-- az-profile-work-list -->
                    </div><!-- col -->
                    <div class="col-md-5 col-xl-4 mg-t-40 mg-md-t-0">
                        <div class="az-content-label tx-13 mg-b-25">Contact Information</div>
                        <div class="az-profile-contact-list">
                            <div class="media">
                                <div class="media-icon"><i class="icon ion-md-phone-portrait"></i></div>
                                <div class="media-body">
                                    <span>Mobile</span>
                                    <div><?php echo $user_details->phone; ?></div>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <div class="media">
                                <div class="media-icon"><i class="icon ion-ios-mail"></i></div>
                                <div class="media-body">
                                    <span>Email</span>
                                    <div><?php echo $user_details->email; ?></div>
                                </div><!-- media-body -->
                            </div><!-- media -->
                            <div class="media">
                                <div class="media-icon"><i class="icon ion-md-locate"></i></div>
                                <div class="media-body">
                                    <span>Location</span>
                                    <div>TRT Manufacturing</div>
                                </div><!-- media-body -->
                            </div><!-- media -->
                        </div><!-- az-profile-contact-list -->
                    </div><!-- col -->
                </div><!-- row -->

                <div class="mg-b-20"></div>

            </div><!-- az-profile-body -->
        </div><!-- az-content-body -->
    </div><!-- container -->
</div><!-- az-content -->
</div><!-- az-content -->
</div><!-- az-content -->

<script src='<?php echo Template::theme_url('lib/chart.js/Chart.bundle.min.js'); ?>'></script>
<script>
    $(function(){
        'use strict'

        /** AREA CHART **/
        var ctx = document.getElementById('chartArea').getContext('2d');

        var gradient = ctx.createLinearGradient(0, 240, 0, 0);
        gradient.addColorStop(0, 'rgba(70,191,63,0)');
        gradient.addColorStop(1, 'rgba(70,191,63,1)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach($activity_month_count as $row){ echo "'".date('M-Y',strtotime("1-".$row->timeline))."',";}?>],
                datasets: [{
                    data: [<?php $max=0; foreach($activity_month_count as $row){ echo $row->total.",";  $max=($row->total>=$max)?$row->total:$max;}?>],
                    borderColor: '#fff008',
                    borderWidth: 1,
                    backgroundColor: gradient
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        display: false,
                        ticks: {
                            beginAtZero:true,
                            fontSize: 10,
                            max: <?php $max =(ceil($max/20))*20; echo $max; ?>
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            fontSize: 11,
                            fontFamily: 'Arial'
                        }
                    }]
                }
            }
        });

    });
</script>