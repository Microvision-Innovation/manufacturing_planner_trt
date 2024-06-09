
<div class="az-content-body">
    <div class="az-content-body-left">
        <div class="az-content-breadcrumb">
            <span>Home</span>
            <span>Email Messaging</span>
        </div>
        <h2 class="az-content-title tx-24 mg-b-5">Messaging</h2>
        <p class="mg-b-20">Send email notifications to other users.</p>
            <div class="container">
                <div class="az-content-left az-content-left-mail ">
                    <a  href="<?php echo base_url()."messaging/compose"; ?>" class="btn btn-warning btn-compose text-light">Compose Mail</a>
                    <div class="az-mail-menu">
                        <nav class="nav az-nav-column mg-b-20">
                            <a href="<?php echo base_url()."messaging/index/1"; ?>" class="nav-link"><i class="typcn typcn-mail"></i> Sent Mail <span><?php echo $sent_mails->total; ?></span></a>
                            <a href="<?php echo base_url()."messaging/notifications"; ?>" class="nav-link active"><i class="typcn typcn-bookmark"></i> Notifications <span>2</span></a>
                            <a href="<?php echo base_url()."messaging/index/0"; ?>" class="nav-link"><i class="typcn typcn-pen"></i> Drafts <span><?php echo $draft_mails->total; ?></span></a>
                            <a href="<?php echo base_url()."messaging/index/2"; ?>" class="nav-link"><i class="typcn typcn-trash"></i> Trash <span><?php echo $deleted_mails->total; ?></span></a>
                        </nav>

                        <label class="az-content-label az-content-label-sm">User Groups</label>
                        <nav class="nav az-nav-column mg-b-20">
                            <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> National users <span><?php echo $national->total; ?></span></a>
                            <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> County Pharmacists <span><?php echo $county->total; ?></span></a>
                            <a href="#" class="nav-link"><i class="typcn typcn-folder"></i> Subcounty Pharmacists <span><?php echo $subcounty->total; ?></span></a>
                        </nav>

                        <label class="az-content-label az-content-label-sm"><i class="typcn typcn-social-facebook-circular tx-15"></i> Facebook</label>
                        <nav class="nav az-nav-column mg-b-20">

                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/TB-Commodity-Allocation-100753901426361" data-tabs="timeline" data-width="" data-height="400" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/TB-Commodity-Allocation-100753901426361" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/TB-Commodity-Allocation-100753901426361">TB Commodity Allocation</a></blockquote></div>
                        </nav>
                    </div><!-- az-mail-menu -->
                </div><!-- az-content-left -->
                <div class="az-content-body-mail">
                        <div class="az-mail-header">
                            <div>
                                <h4 class="az-content-title mg-b-5">Notifications</h4>
                                <p>Manage Dashboard notifications</p>
                            </div>
                            <div>
                            </div>
                        </div><!-- az-mail-list-header -->
                    <div class="az-mail-compose-box">
                        <form method="post" action="<?php echo base_url(); ?>messaging/notifications" id="notifications_form" name="notifications_form" class="form-horizontal">
                        <div class="az-mail-compose-body">
                            <h6 class="text-warning">1st Dashboard Notification </h6>
                            <div class="form-group">
                                <label class="form-label">Title:</label>
                                <div>
                                    <input type="text" class="form-control" name="subject1" required value="<?php echo (ISSET($notification_details1->title))?$notification_details1->title:""; ?>">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                    <input type="hidden" name="id1" value="<?php echo (ISSET($notification_details1->id))?$notification_details1->id:""; ?>" >
                                </div>
                            </div><!-- form-group -->
                            <div class="form-group">
                                <textarea class="form-control" rows="6" placeholder="Write your notification message here..." name="message1" required><?php echo (ISSET($notification_details1->notification))?$notification_details1->notification:""; ?></textarea>
                            </div><!-- form-group -->
                            <hr>
                            <h6 class="text-warning">2nd Dashboard Notification </h6>
                            <div class="form-group">
                                <label class="form-label">Title:</label>
                                <div>
                                    <input type="text" class="form-control" name="subject2" required value="<?php echo (ISSET($notification_details2->title))?$notification_details2->title:""; ?>">
                                    <input type="hidden" name="id2" value="<?php echo (ISSET($notification_details2->id))?$notification_details2->id:""; ?>" >
                                </div>
                            </div><!-- form-group -->
                            <div class="form-group">
                                <textarea class="form-control" rows="6" placeholder="Write your notification message here..." name="message2" required><?php echo (ISSET($notification_details2->notification))?$notification_details2->notification:""; ?></textarea>
                            </div><!-- form-group -->
                            <div class="form-group mg-b-0">
                                <nav class="nav">

                                </nav>
                                <button class="btn btn-primary" type="submit" name="submit" value="Send Emails"><i class='typcn typcn-messages tx-15'></i> Submit Notifications</button>
                            </div><!-- form-group -->
                        </div><!-- az-mail-compose-body -->
                            <!-- File attachement Modal -->

                        </form>
                    </div>
                    <div class="mg-lg-b-30"></div>

                </div><!-- az-content-body -->
            </div><!-- container -->

        <div class="mg-lg-b-30"></div>

    </div><!-- az-content-body -->
</div>

