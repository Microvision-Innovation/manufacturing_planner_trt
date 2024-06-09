
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
                            <a href="<?php echo base_url()."messaging/index/1"; ?>" class="nav-link <?php echo ($email_status==1)?"active":""; ?>"><i class="typcn typcn-mail"></i> Sent Mail <span><?php echo $sent_mails->total; ?></span></a>
                            <a href="<?php echo base_url()."messaging/notifications"; ?>" class="nav-link"><i class="typcn typcn-bookmark"></i> Notifications <span>2</span></a>
                            <a href="<?php echo base_url()."messaging/index/0"; ?>" class="nav-link <?php echo ($email_status==0)?"active":""; ?>"><i class="typcn typcn-pen"></i> Drafts <span><?php echo $draft_mails->total; ?></span></a>
                            <a href="<?php echo base_url()."messaging/index/2"; ?>" class="nav-link <?php echo ($email_status==2)?"active":""; ?>"><i class="typcn typcn-trash"></i> Trash <span><?php echo $deleted_mails->total; ?></span></a>
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
                            <h4 class="az-content-title mg-b-5">Outbox</h4>
                            <p>You have <?php echo $sent_mails->total; ?> sent messages</p>
                        </div>
                        <div>
                            <span>1-5 of 10</span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary disabled"><i class="icon ion-ios-arrow-back"></i></button>
                                <button type="button" class="btn btn-outline-secondary"><i class="icon ion-ios-arrow-forward"></i></button>
                            </div>
                        </div>
                    </div><!-- az-mail-list-header -->
                    <?php if($emails): ?>
                    <div class="az-mail-list">
                        <?php foreach($emails as $e): ?>
                            <div class="az-mail-item unread">
                                <div class="az-mail-checkbox">
                                    <?php if($e->status==1): ?>
                                        <i class="typcn typcn-arrow-forward-outline tx-15" title="Sent"></i>
                                    <?php elseif($e->status==0): ?>
                                        <i class="typcn typcn-pen tx-13" title="Draft"></i>
                                    <?php else: ?>
                                        <i class="typcn typcn-trash tx-15" title="Deleted"></i>
                                    <?php endif; ?>
                                </div><!-- az-mail-checkbox -->
                                <div class="az-img-user"><img src="<?php echo Template::theme_url('images/notice_icon.png');?>" alt=""></div>
                                <div class="az-mail-body" onclick="location.href = '<?php echo base_url()."messaging/compose/".$e->id; ?>'">
                                    <div class="az-mail-from"><?php echo ucwords($e->display_name); ?></div>
                                    <div class="az-mail-subject">
                                        <strong><?php echo $e->subject; ?></strong><br>
                                        <span>
                                            <?php
                                                echo strtok($e->message, "\n");
                                                //echo implode(' ', array_slice(explode(' ', $e->message), 0, 20));
                                            ?>..
                                        </span>
                                    </div>
                                </div><!-- az-mail-body -->
<!--                                <div class="az-mail-attachment"><i class="typcn typcn-attachment"></i></div>-->
                                <div class="az-mail-date"><small class="text-default"><?php echo date('d/M/Y h:ia',strtotime($e->created_on)); ?></small></div>
                            </div><!-- az-mail-item -->
                        <?php endforeach; ?>
<!--                        <div class="az-mail-item unread">-->
<!--                            <div class="az-mail-checkbox">-->
<!--                                <i class="typcn typcn-trash tx-15"></i>-->
<!--                            </div><!-- az-mail-checkbox -->
<!---->
<!--                            <div class="az-img-user"><img src="--><?php //echo Template::theme_url('images/notice_icon.png');?><!--" alt=""></div>-->
<!--                            <div class="az-mail-body">-->
<!--                                <div class="az-mail-from">TB Allocation Tool</div>-->
<!--                                <div class="az-mail-subject">-->
<!--                                    <strong>Test Mail 2</strong>-->
<!--                                    <span>Enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget dolor cum socia eget dolor...</span>-->
<!--                                </div>-->
<!--                            </div><!-- az-mail-body -->
<!--                            <div class="az-mail-date">06:50am</div>-->
<!--                        </div><!-- az-mail-item -->

                    </div><!-- az-mail-list -->
                    <?php endif; ?>
                    <div class="mg-lg-b-30"></div>
                </div><!-- az-content-body -->
            </div><!-- container -->


        <div class="mg-lg-b-30"></div>

    </div><!-- az-content-body -->
</div>

