<!-- Modal -->
<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" id="form_mus">
            <div class="modal-content">  
                <div class="modal-header bg-color-blueLight txt-color-white">
                    <a type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </a>
                    <h4 class="modal-title"><i class='fa fa-user'></i>&nbsp; User Information</h4>
                </div>
                <div class="modal-body modal-fixHeight">   
                    <div class="row">
                        <div class="col-md-6">   
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Username</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_user_name" id="mus_user_name" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-credit-card" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Title</label>
                                <div class="col-md-8 selectContainer">   
                                    <select class="form-control" name="mus_title_id" id="mus_title_id"></select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> First Name</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_name" id="mus_profile_name" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-user" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Last Name</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_lastname" id="mus_profile_lastname" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-user" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">Designation</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_designation" id="mus_profile_designation" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-briefcase" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">Phone No.</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_phoneNo" id="mus_profile_phoneNo" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-phone" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Fax No.</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_faxNo" id="mus_profile_faxNo" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-fax" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Email</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="text" name="mus_profile_email" id="mus_profile_email" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-envelope-o" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Organization</label>
                                <div class="col-md-8">   
                                    <input type="text" name="mus_profile_organization" id="mus_profile_organization" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Department</label>
                                <div class="col-md-8">   
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="1">
                                            <span>AOTD IT Department</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="2">
                                            <span>AOTD Analytical Lab</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="3">
                                            <span>AOTD Biodegradation Lab</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="4">
                                            <span>AOTD Ecotocixity Lab</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="5">
                                            <span>AOTD Physical Lab</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_wfGroup_ids[]" value="6">
                                            <span>AOTD Efficacy Lab</span> 
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">Remark</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="mus_profile_remark" id="mus_profile_remark" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Status</label>
                                <div class="col-md-8">   
                                    <label class="radio radio-inline">
                                        <input type="radio" class="radiobox" name="mus_user_status" value="1" checked>
                                        <span>Active</span> 
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" class="radiobox" name="mus_user_status" value="0">
                                        <span>Inactive</span>  
                                    </label>
                                </div>
                            </div> 
                        </div>                        
                        <div class="col-md-6">  
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Password</label>
                                <div class="col-md-8">   
                                    <div class="input-group">
                                        <input type="password" name="mus_user_password" id="mus_user_password" class="form-control"/>
                                        <span class="input-group-addon"><i class="fa fa-key" style="width: 16px"></i></span>       
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">IKIM No.</label>
                                <div class="col-md-8">   
                                   <input type="text" name="mus_profile_ikimNo" id="mus_profile_ikimNo" class="form-control"/>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-md-4 control-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="mus_address_line1" id="mus_address_line1" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Postcode</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="mus_address_postcode" id="mus_address_postcode"/>
                                </div>
                            </div>                
                            <div class="form-group">
                                <label class="col-md-4 control-label">City</label>
                                <div class="col-md-8 selectContainer">
                                    <select class="form-control" name="mus_city_id" id="mus_city_id"></select>
                                </div>
                            </div>                                  
                            <div class="form-group">
                                <label class="col-md-4 control-label">State</label>
                                <div class="col-md-8 selectContainer">
                                    <select class="form-control" name="mus_state_id" id="mus_state_id"></select>
                                </div>
                            </div>                
                            <div class="form-group">
                                <label class="col-md-4 control-label">Country</label>
                                <div class="col-md-8 selectContainer">
                                    <select class="form-control" name="mus_country_id" id="mus_country_id"></select>
                                </div>
                            </div>                     
                            <div class="form-group">
                                <label class="col-md-4 control-label">Specialization</label>
                                <div class="col-md-8">   
                                    <input type="text" name="mus_profile_specialization" id="mus_profile_specialization" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font> Roles</label>
                                <div class="col-md-8">   
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="2">
                                            <span>Super User</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="29">
                                            <span>AOTD Director</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="28">
                                            <span>Customer PIC</span> 
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="22">
                                            <span>Inventory  PIC</span> 
                                        </label>
                                    </div>
                                    <span id="mus_span_ats">
                                        <label class="control-label text-bold text-underline">AOTD Analytical Lab :</label> 
                                        <div class="checkbox">                                 
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="19">
                                                <span>ATS Manager</span> 
                                            </label>    
                                        </div>
                                        <div class="checkbox">                                 
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="13">
                                                <span>ATS Supervisor</span> 
                                            </label>                           
                                        </div>
                                        <div class="checkbox">                                 
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="27">
                                                <span>ATS analyst</span> 
                                            </label>  
                                        </div>
                                        <div class="checkbox">                                     
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="36">
                                                <span>ATS TM3</span> 
                                            </label> 
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="37">
                                                <span>ATS TM4</span> 
                                            </label>
                                        </div>
                                    </span>
                                    <span id="mus_span_bio">
                                        <label class="control-label text-bold text-underline">AOTD Biodegradation Lab :</label>     
                                        <div class="checkbox">                                 
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="15">
                                                <span>BioD Lab Manager</span> 
                                            </label>     
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="21">
                                                <span>BioD Analyst</span> 
                                            </label>
                                        </div>  
                                    </span>
                                    <span id="mus_span_eco">
                                        <label class="control-label text-bold text-underline">AOTD Ecotocixity Lab :</label>  
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="17">
                                                <span>Eco-T Lab Manager</span> 
                                            </label>           
                                        </div>
                                        <div class="checkbox">                                     
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="18">
                                                <span>Eco-T Analyst</span> 
                                            </label>
                                        </div>    
                                    </span>
                                    <span id="mus_span_phy">
                                        <label class="control-label text-bold text-underline">AOTD Physical Lab :</label>     
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="9">
                                                <span>Phy Lab Manager</span> 
                                            </label>    
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="11">
                                                <span>Phy Lab Supervisor</span> 
                                            </label>   
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="10">
                                                <span>Phy Lab Analyst</span> 
                                            </label> 
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="38">
                                                <span>PHY TM3</span> 
                                            </label> 
                                        </div>                
                                    </span>
                                    <span id="mus_span_eff">
                                        <label class="control-label text-bold text-underline">AOTD Efficacy Lab :</label>      
                                        <div class="checkbox">                                     
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="14">
                                                <span>EFF Lab Manager</span> 
                                            </label>    
                                        </div>
                                        <div class="checkbox">                                     
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="23">
                                                <span>EFF Lab Supervisor</span> 
                                            </label>
                                        </div>
                                        <div class="checkbox">                                     
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="42">
                                                <span>EFF Lab Analyst</span> 
                                            </label>
                                        </div>
                                        <div class="checkbox">                                
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="34">
                                                <span>EFF TM3</span> 
                                            </label>   
                                        </div>
                                        <div class="checkbox">                                    
                                            <label>
                                                <input type="checkbox" class="checkbox" name="mus_uType_ids[]" value="35">
                                                <span>EFF TM4</span> 
                                            </label>
                                        </div>       
                                    </span>
                                </div>
                            </div> 
                        </div>
                    </div>                
                </div>
                <div class="modal-footer padding-10">
                    <div class="row">
                        <div class="col-md-12">
                            <a hreh="#" class="btn btn-labeled btn-danger pull-left" data-dismiss="modal">
                                <span class="btn-label"><i class="fa fa-mail-reply "></i></span>Exit
                            </a>
                            <button type="button" class="btn btn-labeled btn-success" id="mus_btn_save">
                                <span class="btn-label"><i class="fa fa-save"></i></span>Save
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mus_user_id" id="mus_user_id" />
                <input type="hidden" name="mus_profile_id" id="mus_profile_id" />
                <input type="hidden" name="mus_address_id" id="mus_address_id" />
                <input type="hidden" name="funct" id="funct" value="add_user" />
            </form>
        </div>
    </div>
</div>