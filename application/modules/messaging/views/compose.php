
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
                    <a  href="<?php echo base_url()."messaging/compose"; ?>" class="btn btn-outline-warning btn-compose ">Compose Mail</a>
                    <div class="az-mail-menu">
                        <nav class="nav az-nav-column mg-b-20">
                            <a href="<?php echo base_url()."messaging/index/1"; ?>" class="nav-link"><i class="typcn typcn-mail"></i> Sent Mail <span><?php echo $sent_mails->total; ?></span></a>
                            <a href="<?php echo base_url()."messaging/notifications"; ?>" class="nav-link"><i class="typcn typcn-bookmark"></i> Notifications <span>2</span></a>
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
                                <h4 class="az-content-title mg-b-5">Compose</h4>
                                <p>Create New Email Message</p>
                            </div>
                            <div>
                            </div>
                        </div><!-- az-mail-list-header -->
                    <div class="az-mail-compose-box">
                        <form method="post" action="<?php echo base_url(); ?>messaging/send_mail" id="send_mail_form" name="send_mail_form" class="form-horizontal">
                        <div class="az-mail-compose-body">
                            <div class="form-group">
                                <div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control select2-no-search" multiple="multiple" id="user_recipients" name="user_recipients" data-placeholder="Select User Level Recipients" onchange="htmlData('<?php echo base_url(); ?>messaging/filter_mail_recipients', 'user_levels='+$(this).val()+'&regions='+$(region_recipients).val()+'&counties='+$(county_recipients).val())">
                                                <?php foreach($user_levels as $u): ?>
                                                    <option value="<?php echo $u->role_id; ?>"><?php echo $u->role_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control select2-no-search" multiple="multiple" id="region_recipients" name="region_recipients" data-placeholder="Select Regional Recipients" onchange="htmlData('<?php echo base_url(); ?>messaging/filter_mail_recipients', 'regions='+$(this).val()+'&user_levels='+$(user_recipients).val()+'&counties='+$(county_recipients).val())">
                                                <?php foreach($regions as $r): ?>
                                                    <option value="<?php echo $r->id; ?>"><?php echo $r->region; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control select2" multiple="multiple" id="county_recipients" name="county_recipients" data-placeholder="Select County Recipients" onchange="htmlData('<?php echo base_url(); ?>messaging/filter_mail_recipients', 'counties='+$(this).val()+'&regions='+$(region_recipients).val()+'&user_levels='+$(user_recipients).val())">
                                                <?php foreach($counties as $c): ?>
                                                    <option value="<?php echo $c->id; ?>"><?php echo ucwords($c->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
<!--                                        <div class="col-md-1"></div>-->
                                        <div class="col-md-12" id="txtResult">

                                        </div>
<!--                                        <div class="col-md-1"></div>-->
                                    </div>
                                </div>
                            </div><!-- form-group -->
                            <div class="form-group">
                                <label class="form-label">Subject:</label>
                                <div>
                                    <input type="text" class="form-control" name="subject" required value="<?php echo (ISSET($mail_details->subject))?$mail_details->subject:""; ?>">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group">
<!--                                <textarea class="form-control" rows="8" placeholder="Write your message here" name="Message">--><?php //echo (ISSET($mail_details->message))?$mail_details->message:""; ?><!--</textarea>-->
                                <label class="form-label" align="top">&nbsp;</label>
                            <div class="ql-wrapper ql-wrapper-demo">
                                <textarea  id="quillEditor" rows="8" placeholder="Write your message here..." name="message" required><?php echo (ISSET($mail_details->message))?$mail_details->message:""; ?></textarea>
                            </div>

                            </div>


                            <div class="form-group mg-b-0">
                                <nav class="nav">
                                    <a href="#" class="btn btn-link nav-link text-warning" data-toggle="modal" data-target="#modaldemo2" title="Add attachment"><i class="fas fa-paperclip"></i></a>
<!--                                    <a href="" class="nav-link" data-toggle="tooltip" title="Add photo"><i class="far fa-image"></i></a>-->
<!--                                    <a href="" class="nav-link" data-toggle="tooltip" title="Add link"><i class="fas fa-link"></i></a>-->
                                    <button class="btn btn-link nav-link"  type="submit" name="submit" value="save" title="Save Draft"><i class="far fa-save"></i></button>
                                    <button class="btn btn-link nav-link"  type="submit" name="submit" value="discard" title="Discard"><i class="far fa-trash-alt"></i></button>
                                </nav>

                                <button class="btn btn-primary" type="submit" name="submit" value="Send Emails"><i class='fa fa-mail-bulk'></i> Send Emails</button>
                            </div><!-- form-group -->
                        </div><!-- az-mail-compose-body -->
                            <!-- File attachement Modal -->
                        <div id="modaldemo2" class="modal" >
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">File Attachment</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><input type="file" name="attachment" class="form-control"> </p>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" data-dismiss="modal" class="btn btn-warning">Attach File</button>
                                    </div>
                                </div>
                            </div><!-- modal-dialog -->
                        </div>
                        </form>
                    </div>
                    <div class="mg-lg-b-30"></div>

                </div><!-- az-content-body -->
            </div><!-- container -->

        <div class="mg-lg-b-30"></div>

    </div><!-- az-content-body -->
</div>

<script src="<?php echo Template::theme_url('lib/quill/quill.min.js'); ?>"></script>
<script src="<?php echo Template::theme_url('lib/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>

<script>
    $(function(){
        'use strict'

        var icons = Quill.import('ui/icons');
        icons['bold'] = '<i class="la la-bold" aria-hidden="true"></i>';
        icons['italic'] = '<i class="la la-italic" aria-hidden="true"></i>';
        icons['underline'] = '<i class="la la-underline" aria-hidden="true"></i>';
        icons['strike'] = '<i class="la la-strikethrough" aria-hidden="true"></i>';
        icons['list']['ordered'] = '<i class="la la-list-ol" aria-hidden="true"></i>';
        icons['list']['bullet'] = '<i class="la la-list-ul" aria-hidden="true"></i>';

        icons['link'] = '<i class="la la-link" aria-hidden="true"></i>';
        icons['image'] = '<i class="la la-image" aria-hidden="true"></i>';
        icons['video'] = '<i class="la la-film" aria-hidden="true"></i>';
        icons['code-block'] = '<i class="la la-code" aria-hidden="true"></i>';

        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image', 'video']
        ];

        var editor = new Quill('#quillEditor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });


    });
</script>