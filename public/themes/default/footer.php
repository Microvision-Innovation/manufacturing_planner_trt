<div id="modaldemo8" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fa fa-user-md tx-15"></i> Edit Profile</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>user_accounts/edit_profile" name="edit_user_profile" id="edit_user_profile" class="form-horizontal">
            <div class="modal-body">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <label class="control-label mg-b-0 pull-right" for="fullnames">Full Names</label>
                    </div>
                    <div class="col-md-7 mg-t-5 mg-md-t-0">
                        <input id="fullnames" name="fullnames" required="required" type="text" value="<?php echo $current_user->display_name; ?>" class="form-control" />
                        <input type="hidden" name="userId" value="<?php echo $current_user->id; ?>">
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <label class="control-label mg-b-0 pull-right" for="email">Email </label>
                    </div>
                    <div class="col-md-7 mg-t-5 mg-md-t-0">
                        <input id="email" name="email" required="required" type="email" value="<?php echo $current_user->email; ?>" class="form-control" />
                    </div>
                </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <label class="control-label mg-b-0 pull-right" for="phone">Phone </label>
                    </div>
                    <div class="col-md-7 mg-t-5 mg-md-t-0">
                        <input id="phone" name="phone" required="required" type="number" value="<?php echo $current_user->phone; ?>" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" value="Update Profile" class="btn btn-indigo">Save changes</button>
            </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!--modal for changing password -->
<div id="change_password" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"><span class="fa fa-key tx-15"></span> Change Your Password</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>user_accounts/edit_password" name="edit_user_password" id="edit_user_password" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label class="control-label mg-b-0 pull-right" for="password">New Password </label>
                        </div>
                        <div class="col-md-7 mg-t-5 mg-md-t-0">
                            <input id="password" name="password" required="required" type="password"  class="form-control" />
                            <input type="hidden" name="userId" value="<?php echo $current_user->id; ?>">
                        </div>
                    </div>
                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <label class="control-label mg-b-0 pull-right" for="repeat_password">Confirm Password </label>
                    </div>
                    <div class="col-md-7 mg-t-5 mg-md-t-0">
                            <input id="repeat_password" name="repeat_password" required="required" type="password"  class="form-control" />

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="Update Profile" class="btn btn-indigo">Change Password</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="az-footer">
    <div class="container-fluid">
        <span>&copy; 2024 TRT Manufacturing</span>
        <span>Powered by: Microvision Innovations Ltd</span>
    </div><!-- container -->
</div><!-- az-footer -->
</div><!-- az-content -->
<?php echo Assets::js(); ?>
<script>
    $(function(){
        'use strict'

        // Toggle Switches
        $('.az-toggle').on('click', function(){
            $(this).toggleClass('on');
        })

        $('.az-iconbar .nav-link').on('click', function(e){
            e.preventDefault();

            $(this).addClass('active');
            $(this).siblings().removeClass('active');

            $('.az-iconbar-aside').addClass('show');

            var targ = $(this).attr('href');
            $(targ).addClass('show');
            $(targ).siblings().removeClass('show');
        });

        $('.az-iconbar-toggle-menu').on('click', function(e){
            e.preventDefault();

            if(window.matchMedia('(min-width: 992px)').matches) {
                $('.az-iconbar .nav-link.active').removeClass('active');
                $('.az-iconbar-aside').removeClass('show');
            } else {
                $('body').removeClass('az-iconbar-show');
            }
        })

        $('#azIconbarShow').on('click', function(e){
            e.preventDefault();
            $('body').toggleClass('az-iconbar-show');

            var targ = $('.az-iconbar .nav-link.active').attr('href');
            $(targ).addClass('show');
        });

        $(document).bind('click touchstart', function(e){
            e.stopPropagation();

            var azContent = $(e.target).closest('.az-content').length;
            var azIconBarMenu = $(e.target).closest('.az-header-menu-icon').length;

            if(azContent) {
                $('.az-iconbar-aside').removeClass('show');

                // for mobile
                if(!azIconBarMenu) {
                    $('body').removeClass('az-iconbar-show');
                }
            }
        });

        // Tool tips
        $('[data-toggle="tooltip"]').tooltip();

        // colored tooltip
        $('[data-toggle="tooltip-primary"]').tooltip({
            template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        });

        $('[data-toggle="tooltip-secondary"]').tooltip({
            template: '<div class="tooltip tooltip-secondary" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
        });



        $('#datatable1').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

        $('#datatable2').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

        $('#datatable3').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
        });

        // Select2
        //todo: check conflict of select search for datatables select2 on line 191 and 199
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        // Input Masks
        $('#dateMask').mask('99/99/9999');
        $('#phoneMask').mask('9999-999999');
        $('#ssnMask').mask('99/9999/9/9999');

        $(document).ready(function(){
            $('.select2').select2({

            });

            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose one'
            });
        });

        $('#selectForm').parsley();
        $('#selectForm2').parsley();

        // showing modal with effect
        $('.modal-effect').on('click', function(e){
            e.preventDefault();
            var effect = $(this).attr('data-effect');
            $('#modaldemo8').addClass(effect);
        });

        // hide modal with effect
        $('#modaldemo8').on('hidden.bs.modal', function (e) {
            $(this).removeClass (function (index, className) {
                return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
            });
        });

        $('#dateToday').text(moment().format('ddd, MMMM DD YYYY'));
    });
</script>



</body>
</html>
