<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<div class="modal-dialog modal-lg" role="modal">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title">Scheduler</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="az-content-left az-content-left-contacts">
                        <div id="azContactList" class="az-contacts-list nav">
                            <div class="az-contact-item selected" data-toggle="tab" data-target="#tabCont1">
                                <div class="az-contact-body">
                                    <h6>DG677008</h6>
                                    <span class="phone">6000 Packs</span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                            <div class="az-contact-item" data-toggle="tab" data-target="#tabCont2">
                                <div class="az-contact-body">
                                    <h6>DG677010</h6>
                                    <span class="phone">6000 Packs</span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                            <div class="az-contact-item" data-toggle="tab" data-target="#tabCont3">
                                <div class="az-contact-body">
                                    <h6>DG677018</h6>
                                    <span>allanr@palban.com</span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                            <div class="az-contact-item bg-gray-100" data-toggle="tab" data-target="#newjob">
                                <div class="az-contact-body">
                                    <h6>Add New <i class="fa fa-plus-circle"></i></h6>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="tab tab-content">
                        <div id="tabCont1" class="tab-pane active show">
                            <div class="az-content-body az-content-body-contacts">
                                <div class="az-contact-info-header">
                                    <div class="media">

                                        <div class="media-body">
                                            <h4>DG677018</h4>
                                            <p>Bulk BK Cool Under Pressure</p>
                                        </div><!-- media-body -->
                                    </div><!-- media -->
                                    <div class="az-contact-action nav">
                                        <a href="#" class="nav-link">Production: Bulk</a>
                                        <a href="#" class="nav-link">Bulk Size: 6,000Kg</a>
                                    </div><!-- az-contact-action -->

                                </div><!-- az-contact-info-header -->
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
                                            <div class="media-icon align-self-start">
                                                <i class="fa fa-receipt"></i>
                                                <span class="h4 text-success">Complete</span>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Job Area</label>
                                                    <span class="tx-medium">Home Care Bulk (Area 1)</span>
                                                </div>
                                                <div>
                                                    <label>Tank</label>
                                                    <span class="tx-medium"> TK4 (1000Kg)</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon"></div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Date</label>
                                                    <span class="tx-medium">Wed 05 Jun, 2024</span>
                                                </div>
                                                <div>
                                                    <label>Time</label>
                                                    <span class="tx-medium">Day Shift</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon"></div>
                                            <div class="media-body">
                                                <div>
                                                    <button class="btn btn-primary btn-icon btn-xs pull-right"><i class="typcn typcn-plus-outline"></i></button>
                                                    <br><br><br>
<!--                                                    <div class="pull-left">-->
                                                    <form class="form-horizontal">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label >Job Area</label>
                                                                    <select class="form-control" required>
                                                                        <option label="Select Job Area"></option>
                                                                        <option value="January">Home Care (Area 1)</option>
                                                                        <option value="February">Personal Care (Area 1)</option>
                                                                        <option value="March">Aerosol 1 (Area 3)</option>
                                                                        <option value="April">Personal care (Area 2)</option>
                                                                        <option value="May">Home Care Bulk (Area 2)</option>
                                                                    </select>
                                                                </div><!-- col -->
                                                                <div class="col-md-6">
                                                                    <label>Tank</label>
                                                                    <select class="form-control">
                                                                        <option label="Choose Tank"></option>
                                                                        <option value="January">TK4 (1000Kg)</option>
                                                                        <option value="February">TK5 (1000Kg)</option>
                                                                        <option value="March">TK6 (1000Kg)</option>
                                                                        <option value="April">TK7 (1000Kg)</option>
                                                                        <option value="May">TK8 (1000Kg)</option>
                                                                    </select>
                                                                </div><!-- col -->
                                                            </div><!-- row -->
                                                            <br>
                                                            <div class="row ">
                                                                <div class="col-sm-12">
                                                                    <label>Schedule Date</label>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <input type="date" class="form-control" placeholder="" required="">
                                                                        </div><!-- col -->
                                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                                            <select class="form-control select2-no-search">
                                                                                <option label="Choose Shift"></option>
                                                                                <option value="2018">Day Shift</option>
                                                                                <option value="2019">Night Shift</option>
                                                                            </select>
                                                                        </div><!-- col -->
                                                                    </div><!-- row -->
                                                                </div><!-- col -->
                                                            </div><!-- row -->
                                                        </div>
                                                    </form>
<!--                                                    </div>-->
                                                </div>

                                            </div><!-- media-body -->
                                        </div><!-- media -->

                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->
                            </div><!-- az-content-body -->
                            <div class="row">
                                <div class="col-md-7">
                                    <label>Job Logs</label>
                                    <table width="60%" align="left" cellspacing="3" cellpadding="3">
                                        <thead>
                                        <tr>
                                            <th><span align="left">User</span></th>
                                            <th><span align="left">Date</span></th>
                                            <th><span align="left">Status</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td align="left">Edwin Ombego</td>
                                            <td>05 Jun,2024 22:00</td>
                                            <td>Complete</td>
                                        </tr>
                                        <tr>

                                            <td>Edwin Ombego</td>
                                            <td>05 Jun,2024 12:00</td>
                                            <td>Complete</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3"><label>Job Status</label>
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <label class="ckbox">
                                                <input type="checkbox" checked=""><span>Dispensed</span>
                                            </label>
                                        </div><br>
                                        <div class="col-lg-12 ">
                                            <label class="ckbox">
                                                <input type="checkbox"=""><span>In Progress</span>
                                            </label>
                                        </div><br>
                                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                            <label class="ckbox">
                                                <input type="checkbox"=""><span>Complete
                                        </div><br>
                                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                            <label class="ckbox">
                                                <input type="checkbox"><span>On Hold</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- tab-pane -->
                        <div id="tabCont2" class="tab-pane">
                            This is a tab content 2...
                        </div>
                        <div id="tabCont3" class="tab-pane">This is tab content 3...</div>
                        <div id="newjob" class="tab-pane">
                            <div class="az-content-body az-content-body-contacts">
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
                                            <div class="media-icon"><i class="fa fa-calendar-alt"></i></div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Date</label>
                                                    <span class="tx-medium">Wed 05 Jun, 2024</span>
                                                </div>
                                                <div>
                                                    <label>Time</label>
                                                    <span class="tx-medium">Day Shift</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon align-self-start"></div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Job type</label>
                                                    <span class="tx-medium">Production (Bulk)</span>
                                                </div>
                                                <div>
                                                    <label>Job Area</label>
                                                    <span class="tx-medium">Home Care Bulk (Area 1)</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon"></div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Tank</label>
                                                    <span class="tx-medium">TK4 (1,000Kg)</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon"><i class="fa fa-pen"></i></div>
                                            <div class="media-body">
                                                <div><br>
                                                    <form class="form-horizontal">
                                                        <div class="form-group">
                                                            <div class="row row-sm">
                                                                <div class="col-sm-7">
                                                                    <label >Job Number</label>
                                                                    <input type="text" class="form-control" placeholder="" required="">
                                                                </div><!-- col -->
                                                                <div class="col-sm-5">
                                                                    <label >Bulk Size</label>
                                                                    <input type="number" class="form-control" placeholder="" required="">
                                                                </div><!-- col -->
                                                            </div><!-- row -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" placeholder=""></textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->
                            </div><!-- az-content-body -->
                        </div>
                    </div><!-- card-body -->
                </div>
            </div>
        </div><!-- modal-body -->
        <div class="modal-footer">
            <button  id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
        </div>
    </div>
</div><!-- modal-dialog