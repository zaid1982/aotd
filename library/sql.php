<?php

class Class_sql {

    private $prm_user_role = "select user_role.user_id AS user_id,group_concat(ref_role.role_desc order by ref_role.role_id ASC separator ', ') AS role_list from user_role left join ref_role on ref_role.role_id = user_role.role_id group by user_role.user_id";
    private $prm_user_type = "select user_type.user_id AS user_id,group_concat(ref_uType.uType_desc order by ref_uType.uType_id ASC separator ', ') AS userType_list from user_type left join ref_uType on ref_uType.uType_id = user_type.uType_id group by user_type.user_id";

    function __construct() {
        // 1010 - 1019
    }

    private function get_exception($codes, $function, $line, $msg) {
        if ($msg != '') {
            $pos = strpos($msg, '-');
            if ($pos !== false)
                $msg = substr($msg, $pos + 2);
            return "(ErrCode:" . $codes . ") [" . __CLASS__ . ":" . $function . ":" . $line . "] - " . $msg;
        } else
            return "(ErrCode:" . $codes . ") [" . __CLASS__ . ":" . $function . ":" . $line . "]";
    }

    public function get_sql($title) {
        try {
            if ($title == 'vw_user_basic') {
                $sql = "select 
                    user.user_id AS user_id,
                    user_role.role_id AS role_id,
                    user.user_name AS user_name,
                    user.user_password AS user_password,
                    user.user_status AS user_status,
                    user.profile_id AS profile_id,
                    `profile`.profile_firstName AS profile_name 
                from user 
                left join `profile` on `profile`.profile_id = user.profile_id 
                left join user_role on user_role.user_id=user.user_id
                order by user_role.role_id";
            } else if ($title == 'vw_menu_list') {
                $sql = "SELECT 
                    user_menu.*,
                    ref_menu.menu_name AS menu_name,
                    ref_menu2nd.menu2nd_name AS menu2nd_name,
                    ref_menu3rd.menu3rd_name AS menu3rd_name
                FROM user_menu 
                INNER JOIN (
                    SELECT 
                        DISTINCT(role_menu.userMenu_id) AS userMenu_id
                    FROM role_menu 
                    LEFT JOIN user_role ON user_role.role_id = role_menu.role_id
                    LEFT JOIN user_type ON user_type.uType_id = role_menu.uType_id
                    WHERE (user_role.user_id = [user_id] OR user_type.user_id = [user_id])) role_menus ON role_menus.userMenu_id = user_menu.userMenu_id 
                INNER JOIN ref_menu ON ref_menu.menu_id = user_menu.menu_id 
                LEFT JOIN ref_menu2nd ON ref_menu2nd.menu2nd_id = user_menu.menu2nd_id
                LEFT JOIN ref_menu3rd ON ref_menu3rd.menu3rd_id = user_menu.menu3rd_id";
            } else if ($title == 'dt_task_history') {
                $sql = "SELECT 
                    wf_task_type.wfTaskType_name AS wfTaskType_name,
                    ref_status.status_desc AS status_desc,
                    `profile`.profile_name AS claimed_by,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,                      
                    wf_task.wfTask_dateExpired AS wfTask_dateExpired,
                    wf_task.wfTask_timeSubmitted AS wfTask_timeSubmitted, 
                    IF(DATEDIFF(DATE(wf_task.wfTask_timeSubmitted),DATE(wf_task.wfTask_dateExpired))>0,DATEDIFF(DATE(wf_task.wfTask_timeSubmitted),DATE(wf_task.wfTask_dateExpired)),0) AS day_late,
                    wf_task.wfTask_remark AS wfTask_remark,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTrans_id AS wfTrans_id,
                    wf_task_type.wfTaskType_turn AS wfTaskType_turn,
                    wf_group.wfGroup_name AS wfGroup_name
                FROM wf_task 
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id 
                LEFT JOIN `user` ON `user`.user_id = wf_task.wfTask_claimedBy
                LEFT JOIN `profile` ON `profile`.profile_id = `user`.profile_id
                LEFT JOIN wf_group ON wf_group.wfGroup_id = wf_task.wfGroup_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task_type.wfTaskType_isEnd = 'N'";
            } else if ($title == 'dt_task_history_info') {
                $sql = "SELECT 
                    wf_flow.wfFlow_module AS modul,
                    wf_flow.wfFlow_desc AS sub_modul,
                    wf_task_type.wfTaskType_name AS tugas_semasa,
                    `user`.user_fullname AS pengguna_semasa,
                    DATE(wf_task.wfTask_timeCreated) AS tarikh_terima,                      
                    wf_task.wfTask_dateExpired AS tarikh_akhir,
                    wf_task.wfTrans_id AS wfTrans_id,
                    wf_task.wfTask_id AS wfTask_id
                FROM wf_task 
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id
                LEFT JOIN `user` ON `user`.user_id = wf_task.wfTask_claimedBy 
                LEFT JOIN wf_flow ON wf_flow.wfFlow_id = wf_task_type.wfFlow_id";
            } else if ($title == 'vw_email_send') {
                $sql = "SELECT 
                    email_send.emailSend_id AS emailSend_id,
                    email_send.emailType_id AS emailType_id,
                    IF(ISNULL(email_send.emailSend_email),`profile`.profile_email,email_send.emailSend_email) AS emailSend_email,
                    email_send.emailSend_to AS emailSend_to,
                    ref_email_type.emailType_desc AS emailType_desc,
                    ref_email_type.emailType_title AS emailType_title,
                    ref_email_type.emailType_text AS emailType_text,
                    ref_email_type.emailType_status AS emailType_status,
                    `profile`.profile_name AS profile_name,
                    `profile`.profile_icno AS profile_icno
                FROM email_send
                INNER JOIN ref_email_type ON ref_email_type.emailType_id = email_send.emailType_id
                LEFT JOIN `profile` ON `profile`.profile_id = email_send.emailSend_to 
                WHERE email_send.emailSend_status = 100 AND email_send.emailSend_timeSet < NOW()";
            } else if ($title == 'dt_task_type') {
                $sql = "SELECT 
                    wf_task.*, wf_task_type.wfTaskType_isEnd AS wfTaskType_isEnd
                FROM wf_task 
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id";
            } else if ($title == 'vw_ref_general') {
                $sql = "SELECT [id_name] AS ref_id, [desc_name] AS ref_desc, [status_name] AS [status_name] [extra_name] FROM [tablename]";
            } else if ($title == 'vw_ref_general_group') {
                $sql = "SELECT [desc_name] AS ref_id, [desc_name] AS ref_desc [extra_name] FROM [tablename] GROUP BY [desc_name] [extra_name]";
            } else if ($title == 'vw_opt_delegate_to') {
                $sql = "SELECT 
                    `profile`.profile_name AS ref_desc,
                    wf_task_user.user_id AS ref_id,
                    wf_task_user.wfTaskType_id AS wfTaskType_id,
                    wf_task_user.wfGroup_id AS wfGroup_id
                FROM wf_task_user 
                LEFT JOIN `profile` ON `profile`.user_id = wf_task_user.user_id AND `profile`.profile_status = 1";
            } else if ($title == 'vw_opt_user_name') {
                $sql = "SELECT 
                    user_id AS ref_id,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS ref_desc
                FROM `profile` 
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id
                WHERE profile_status = 1 
                ORDER BY `profile`.profile_name";
            } else if ($title == 'vw_address') {
                $sql = "SELECT 
                    CONCAT('&nbsp;&nbsp;&nbsp;&nbsp;',address_line1,'<br>&nbsp;&nbsp;&nbsp;&nbsp;',IFNULL(address_line2,''),IF(address_line2 IS NOT NULL,'<br>&nbsp;&nbsp;&nbsp;&nbsp;',''),IFNULL(address_line3,''),IF(address_line3 IS NOT NULL,'<br>&nbsp;&nbsp;&nbsp;&nbsp;',''),
                        address.address_postcode,'<br>&nbsp;&nbsp;&nbsp;&nbsp;',city_desc,'<br>&nbsp;&nbsp;&nbsp;&nbsp;',state_desc) AS full_address,
                    address.*,
                    ref_city.city_desc,
                    ref_state.state_id,
                    ref_state.state_desc
                FROM address 
                LEFT JOIN ref_city ON ref_city.city_id = address.city_id 
                LEFT JOIN ref_state ON ref_state.state_id = ref_city.state_id";
            } else if ($title == 'vw_get_date_diff') {
                $sql = "SELECT '[date_in]' + INTERVAL [expression] AS date_out";
            } else if ($title == 'dt_audit') {
                $sql = "SELECT 
                    audit.*,
                    `profile`.profile_name AS profile_name,
                    `profile`.profile_icNo AS profile_icNo,
                    audit_module.auditModule_desc AS auditModule_desc,
                    audit_action.auditAction_desc AS auditAction_desc
                FROM audit
                LEFT JOIN `profile` ON `profile`.user_id = audit.user_id AND profile.profile_status = 1
                LEFT JOIN audit_action ON audit_action.auditAction_id = audit.auditAction_id
                LEFT JOIN audit_module ON audit_module.auditModule_id = audit_action.auditModule_id";
            } else if ($title == 'vw_menu_akses_list') {
                $sql = "SELECT 
                    user_menu.userMenu_turn,
                    ref_menu.menu_name AS menu_name,
                    ref_menu2nd.menu2nd_name AS menu2nd_name,
                    ref_menu3rd.menu3rd_name AS menu3rd_name, 
                    role_menu.uType_id AS uType_id,
                    user_menu.menu_id AS menu_id,
                    user_menu.menu2nd_id AS menu2nd_id,
                    user_menu.menu3rd_id AS menu3rd_id
                FROM role_menu
                INNER JOIN user_menu ON user_menu.userMenu_id = role_menu.userMenu_id
                LEFT JOIN ref_menu ON ref_menu.menu_id = user_menu.menu_id 
                LEFT JOIN ref_menu2nd ON ref_menu2nd.menu2nd_id = user_menu.menu2nd_id
                LEFT JOIN ref_menu3rd ON ref_menu3rd.menu3rd_id = user_menu.menu3rd_id";
            } else if ($title == 'vw_get_current_utype') {
                $sql = "SELECT
                    user_type.user_id AS user_id,
                    ref_uType.uType_cate AS uType_cate
                FROM user_type 
                LEFT JOIN ref_uType ON ref_uType.uType_id = user_type.uType_id
                GROUP BY uType_cate, user_id";
            } else if ($title == 'dt_notify_task') {
                $sql = "SELECT 
                    wf_task.*,
                    wf_flow.wfFlow_short AS wfFlow_short,
                    wf_task_type.wfTaskType_icon AS wfTaskType_icon,
                    wf_flow.wfFlow_color AS wfFlow_color,
                    wf_task_type.wfTaskType_name AS wfTaskType_name,
                    aotd_client_info.client_organisation AS client_organisation
                FROM wf_task 
                INNER JOIN wf_group_user ON wf_group_user.user_id = [user_id] AND wf_group_user.wfGroup_id = wf_task.wfGroup_id 
                INNER JOIN wf_task_user ON wf_task_user.user_id = [user_id] AND wf_task_user.wfGroup_id = wf_task.wfGroup_id AND wf_task_user.wfTaskType_id = wf_task.wfTaskType_id 
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id 
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN wf_flow ON wf_flow.wfFlow_id = wf_transaction.wfFlow_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = wf_transaction.client_id 
                WHERE wf_task_type.wfTaskType_isEnd = 'N' AND wf_task.wfTask_partition = 1
                    AND (wf_task.wfTask_claimedBy = [user_id] OR wf_task.wfTask_claimedBy IS NULL)";
            } else if ($title == 'dt_user_mgmt') {
                $sql = "SELECT     
                    `profile`.*,                                               
                    CONCAT(ref_title.title_desc,' ',profile.profile_name,' ',profile.profile_lastname) AS combine_name,
                    `user`.user_name AS user_name,
                    wf_groups.wfGroup_names AS wfGroup_names,
                    vws_user_type.role_list AS role_list,                    
                    `user`.user_id AS user_ids,
                    ref_status.*
                FROM `user`
                LEFT JOIN `profile` ON `profile`.profile_id = `user`.profile_id
                LEFT JOIN (select user_type.user_id AS user_id,group_concat(ref_utype.uType_desc order by ref_utype.uType_id ASC separator ', ') AS role_list from user_type left join ref_utype on ref_utype.uType_id = user_type.uType_id group by user_type.user_id) vws_user_type ON vws_user_type.user_id = `user`.user_id
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id
                LEFT JOIN ref_status ON ref_status.status_id = `user`.user_status 
                LEFT JOIN 
                    (SELECT user_id, GROUP_CONCAT(wf_group.wfGroup_name separator ', ') AS wfGroup_names
                    FROM wf_group_user
                    LEFT JOIN wf_group ON wf_group.wfGroup_id = wf_group_user.wfGroup_id
                    GROUP BY user_id) wf_groups ON wf_groups.user_id = `user`.user_id
                ";
            } else if ($title == 'dt_ref_state') {
                $sql = "SELECT ref_state.*, ref_status.status_desc, ref_status.status_color 
                FROM ref_state 
                LEFT JOIN ref_status ON ref_status.status_id = ref_state.state_status";
            } else if ($title == 'dt_ref_city') {
                $sql = "SELECT ref_city.*, ref_state.state_desc, ref_status.status_desc, ref_status.status_color 
                FROM ref_city 
                LEFT JOIN ref_state ON ref_state.state_id = ref_city.state_id
                LEFT JOIN ref_status ON ref_status.status_id = ref_city.city_status";
            } else if ($title == 'dt_ref_department') {
                $sql = "SELECT ref_department.*, ref_status.status_desc, ref_status.status_color  
                FROM ref_department 
                LEFT JOIN ref_status ON ref_status.status_id = ref_department.department_status";
            } else if ($title == 'dt_ref_qnfCate') {
                $sql = "SELECT t_qnf_category.*, ref_status.status_desc, ref_status.status_color  
                FROM t_qnf_category 
                LEFT JOIN ref_status ON ref_status.status_id = t_qnf_category.qnfCate_status";
            } else if ($title == 'dt_ref_certIssuer') {
                $sql = "SELECT t_certificate_issuer.*, ref_status.status_desc, ref_status.status_color  
                FROM t_certificate_issuer 
                LEFT JOIN ref_status ON ref_status.status_id = t_certificate_issuer.certIssuer_status";
            } else if ($title == 'dt_ref_softwareMethod') {
                $sql = "SELECT t_software_method.*, ref_status.status_desc, ref_status.status_color  
                FROM t_software_method 
                LEFT JOIN ref_status ON ref_status.status_id = t_software_method.softwareMethod_status";
            } else if ($title == 'dt_ref_cemsDesc') {
                $sql = "SELECT document_name.*, ref_status.status_desc, ref_status.status_color  
                FROM document_name 
                LEFT JOIN ref_status ON ref_status.status_id = document_name.documentName_status
                WHERE documentName_type = 'cems'";
            } else if ($title == 'dt_ref_pemsDesc') {
                $sql = "SELECT document_name.*, ref_status.status_desc, ref_status.status_color  
                FROM document_name 
                LEFT JOIN ref_status ON ref_status.status_id = document_name.documentName_status
                WHERE documentName_type = 'pems'";
            } else if ($title == 'dt_document_name') {
                $sql = "SELECT document_name.*, ref_status.status_desc 
                FROM document_name 
                LEFT JOIN ref_status ON ref_status.status_id = document_name.documentName_status";
            } else if ($title == 'vw_profile') {
                $sql = "SELECT 
                    `user`.user_name AS user_name,
                    `user`.user_password AS user_password,
                    `user`.user_status AS user_status,
                    address.address_line1 AS address_line1,
                    address.address_postcode AS address_postcode,
                    ref_city.city_id AS city_id,
                    ref_state.state_id AS state_id,
                    ref_state.country_id AS country_id,
                    `profile`.*
                FROM `user` 
                INNER JOIN `profile` ON `user`.profile_id = `profile`.profile_id
                LEFT JOIN address ON address.address_id = `profile`.address_id 
                LEFT JOIN ref_city ON ref_city.city_id = address.city_id
                LEFT JOIN ref_state ON ref_state.state_id = ref_city.state_id";
            } else if ($title == 'vw_profile2') {
                $sql = "SELECT 
                    `user`.user_id AS user_id, 
                    `profile`.profile_name AS profile_name,
                    `profile`.profile_icNo AS profile_icNo,
                    `profile`.profile_email AS profile_email,
                    user_types.list_role AS list_role,
                    `user`.user_password AS user_password,
                    `user`.user_status AS user_status,
                    `user`.user_type AS user_type,
                    `user`.secQues_id AS secQues_id,
                    `user`.user_security_answer AS user_security_answer
                FROM `user` 
                INNER JOIN `profile` ON `user`.profile_id = `profile`.profile_id
                LEFT JOIN ( 
                    SELECT user_type.user_id AS user_id, GROUP_CONCAT(ref_utype.uType_desc ORDER BY user_type.uType_id SEPARATOR '</br>') AS list_role 
                    FROM user_type 
                    LEFT JOIN ref_utype ON ref_utype.uType_id = user_type.uType_id 
                    GROUP BY user_id  				
                ) user_types ON user_types.user_id = `user`.user_id";
            } else if ($title == 'vw_join_status') {
                $sql = "SELECT [table_name].*, ref_status.status_desc 
                FROM [table_name] 
                LEFT JOIN ref_status ON ref_status.status_id = [table_name].[status_name]";
            } else if ($title == 'vw_user_role') {
                $sql = "SELECT user_role.*, ref_role.role_desc, ref_status.status_desc 
                FROM user_role 
                LEFT JOIN ref_role ON ref_role.role_id = user_role.role_id
                LEFT JOIN ref_status ON ref_status.status_id = user_role.userRole_status
                ORDER BY user_role.role_id";
            } else if ($title == 'vw_roles') {
                $sql = "SELECT 
                    user_role.*, ref_role.role_desc, ref_status.status_desc
                FROM user_role
                LEFT JOIN ref_role ON ref_role.role_id = user_role.role_id
                LEFT JOIN ref_status ON ref_status.status_id = user_role.userRole_status";
            } else if ($title == 'dt_task_comment') {
                $sql = "SELECT
                    wf_task.*,
                    wf_group.wfGroup_name AS wfGroup_name,
                    `profile`.profile_name AS profile_name
                FROM wf_task
                LEFT JOIN wf_group ON wf_group.wfGroup_id = wf_task.wfGroup_id 
                LEFT JOIN `user` ON `user`.user_id = wf_task.wfTask_claimedBy 
                LEFT JOIN `profile` ON `profile`.profile_id = `user`.profile_id
                WHERE wfTask_remark IS NOT NULL AND wf_task.wfTask_claimedBy IS NOT NULL 
                ORDER BY wfTask_id";
            } else if ($title == 'dt_track_monitoring') {
                $sql = "SELECT 
                    wf_transaction.wfTrans_no AS wfTrans_no,
                    wf_transaction.wfTrans_regNo AS wfTrans_regNo,
                    wf_flow.wfFlow_id AS wfFlow_id,
                    wf_flow.wfFlow_desc AS wfFlow_desc,
                    wf_task_type.wfTaskType_name AS wfTaskType_name,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    `profile`.profile_name AS profile_name,
                    wf_transaction.wfTrans_timeCreated AS wfTrans_timeCreated,
                    wf_transaction.wfTrans_dateDue AS wfTrans_dateDue,
                    wf_task_type.uType_id AS uType_ids,
                    wf_task.*
                FROM wf_transaction 
                LEFT JOIN wf_task ON wf_task.wfTrans_id = wf_transaction.wfTrans_id AND wf_task.wfTask_partition = 1 
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id
                LEFT JOIN wf_flow ON wf_flow.wfFlow_id = wf_task_type.wfFlow_id 
                LEFT JOIN ref_status ON ref_status.status_id = wf_transaction.wfTrans_status
                LEFT JOIN `profile` ON `profile`.user_id = wf_transaction.wfTrans_processOfficer AND `profile`.profile_status = 1
                WHERE wf_transaction.wfTrans_status NOT IN (2,8)";
            } else if ($title == 'vw_user_types') {
                $sql = "SELECT 
                    user_type.user_id AS user_id,
                    group_concat(ref_utype.uType_desc ORDER BY ref_utype.uType_id ASC SEPARATOR ', ') AS role_list 
                FROM user_type 
                LEFT JOIN ref_utype ON ref_utype.uType_id = user_type.uType_id 
                GROUP BY user_type.user_id";
            } else if ($title == 'dt_list_to_delegate') {
                $sql = "SELECT 
                    wf_task_type.wfTaskType_name AS wfTaskType_name,
                    ref_utype.uType_desc AS uType_desc,
                    wf_task.*
                FROM wf_task
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id
                LEFT JOIN ref_utype ON ref_utype.uType_id = wf_task_type.uType_id
                WHERE wf_task.wfTask_partition = 1 AND wfTask_timeClaimed IS NOT NULL AND wf_task_type.uType_id IN (2,3)";
            } else if ($title == 'vw_count_user') {
                $sql = "SELECT user_status, COUNT(*) AS total FROM `user` GROUP BY user_status";
            } else if ($title == 'vw_aotd_lab') {
                $sql = "SELECT 
                    aotd_lab.*,
                    CONCAT(t_head_unit.title_desc,' ',p_head_unit.profile_name,' ',p_head_unit.profile_lastname) AS name_head_unit,
                    CONCAT(t_quality_manager.title_desc,' ',p_quality_manager.profile_name,' ',p_quality_manager.profile_lastname) AS name_quality_manager,
                    CONCAT(t_technical_manager.title_desc,' ',p_technical_manager.profile_name,' ',p_technical_manager.profile_lastname) AS name_technical_manager,
                    CONCAT(t_technical_manager2.title_desc,' ',p_technical_manager2.profile_name,' ',p_technical_manager2.profile_lastname) AS name_technical_manager2,
                    CONCAT(t_research_officer.title_desc,' ',p_research_officer.profile_name,' ',p_research_officer.profile_lastname) AS name_research_officer,
                    CONCAT(t_supervisor.title_desc,' ',p_supervisor.profile_name,' ',p_supervisor.profile_lastname) AS name_supervisor
                FROM aotd_lab 
                LEFT JOIN `profile` p_head_unit ON p_head_unit.user_id = aotd_lab.lab_head_unit AND p_head_unit.profile_status = 1
                LEFT JOIN ref_title t_head_unit ON t_head_unit.title_id = p_head_unit.title_id
                LEFT JOIN `profile` p_quality_manager ON p_quality_manager.user_id = aotd_lab.lab_quality_manager AND p_quality_manager.profile_status = 1
                LEFT JOIN ref_title t_quality_manager ON t_quality_manager.title_id = p_quality_manager.title_id
                LEFT JOIN `profile` p_technical_manager ON p_technical_manager.user_id = aotd_lab.lab_technical_manager AND p_technical_manager.profile_status = 1
                LEFT JOIN ref_title t_technical_manager ON t_technical_manager.title_id = p_technical_manager.title_id
                LEFT JOIN `profile` p_technical_manager2 ON p_technical_manager2.user_id = aotd_lab.lab_technical_manager2 AND p_technical_manager2.profile_status = 1
                LEFT JOIN ref_title t_technical_manager2 ON t_technical_manager2.title_id = p_technical_manager2.title_id
                LEFT JOIN `profile` p_research_officer ON p_research_officer.user_id = aotd_lab.lab_research_officer AND p_research_officer.profile_status = 1
                LEFT JOIN ref_title t_research_officer ON t_research_officer.title_id = p_research_officer.title_id
                LEFT JOIN `profile` p_supervisor ON p_supervisor.user_id = aotd_lab.lab_supervisor AND p_supervisor.profile_status = 1
                LEFT JOIN ref_title t_supervisor ON t_supervisor.title_id = p_supervisor.title_id";
            } else if ($title == 'dt_ats_test') {
                $sql = "SELECT 
                    ats_test.*,
                    ats_fields.total_field AS total_field,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color
                FROM ats_test 
                LEFT JOIN (
                            SELECT atsTest_id, COUNT(*) AS total_field 
                            FROM ats_field GROUP BY atsTest_id
                    ) ats_fields ON ats_fields.atsTest_id = ats_test.atsTest_id
                LEFT JOIN ref_status ON ref_status.status_id = ats_test.atsTest_status";
            } else if ($title == 'vw_ats_test') {
                $sql = "SELECT 
                    ats_test.*,
                    ref_status.status_desc AS status_desc
                FROM ats_test 
                LEFT JOIN ref_status ON ref_status.status_id = ats_test.atsTest_status";
            } else if ($title == 'dt_ats_field') {
                $sql = "SELECT 
                    ats_field.*,
                    formulas.formula_list AS formula_list
                FROM ats_field 
                LEFT JOIN (
                    SELECT 
                            ats_field_formula.atsField_id AS atsField_id,
                            GROUP_CONCAT(ats_formula.atsFormula_name ORDER BY ats_formula.atsFormula_name ASC SEPARATOR ', ') AS formula_list
                    FROM ats_field_formula
                    LEFT JOIN ats_formula ON ats_formula.atsFormula_id = ats_field_formula.atsFormula_id
                    GROUP BY atsField_id
                ) formulas ON formulas.atsField_id = ats_field.atsField_id";
            } else if ($title == 'dt_ats_formula') {
                $sql = "SELECT 
                    ats_formula.*,
                    ats_field_formula.atsFf_id AS atsFf_id,
                    ats_field_formula.atsFf_notes AS atsFf_notes
                FROM ats_formula 
                LEFT JOIN ats_field_formula ON ats_field_formula.atsFormula_id = ats_formula.atsFormula_id AND ats_field_formula.atsField_id = [atsField_id]";
            } else if ($title == 'vw_count_client_group') {
                $sql = "SELECT clientType_id, COUNT(*) AS total FROM aotd_client_group GROUP BY clientType_id";
            } else if ($title == 'vw_count_client_info') {
                $sql = "SELECT 
                    clientType_id, COUNT(*) AS total 
                FROM aotd_client_info
                LEFT JOIN aotd_client_group ON aotd_client_group.clientGrp_id = aotd_client_info.clientGrp_id
                GROUP BY clientType_id";
            } else if ($title == 'vw_client_info') {
                $sql = "SELECT 
                    aotd_client_info.*,
                    aotd_client_group.clientGrp_name AS clientGrp_name,
                    aotd_client_group.clientType_id AS clientType_id
                FROM aotd_client_info
                LEFT JOIN aotd_client_group ON aotd_client_group.clientGrp_id = aotd_client_info.clientGrp_id";
            } else if ($title == 'vw_count_atsCert_info') {
                $sql = "SELECT 
                    atsCert_status, COUNT(*) AS total
                FROM ats_sample_log
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = ats_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])
                GROUP BY atsCert_status";
            } else if ($title == 'dt_ats_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    GROUP_CONCAT(CONCAT('|', ats_sample_info.atsLab_barCode, '|')) AS list_barCode,
                    ats_sample_log.*
                FROM ats_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ats_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ats_sample_log.atsCert_status
                LEFT JOIN ats_sample_info ON ats_sample_info.atsCert_id = ats_sample_log.atsCert_id
                GROUP BY atsCert_id";
            } else if ($title == 'dt_ats_cert_login') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTask_createdBy AS wfTask_createdBy,
                    ats_sample_log.*
                FROM ats_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ats_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ats_sample_log.atsCert_status
                LEFT JOIN wf_task ON wf_task.wfTrans_id = ats_sample_log.wfTrans_id AND wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = 1 AND wf_task.wfTask_status = 2
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = ats_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])";
            } else if ($title == 'vw_ats_cert') {
                $sql = "SELECT 
                    DATE_FORMAT(CURDATE(), '%d/%M/%Y') AS timeprint,
                    DATE_FORMAT(atsCert_timeReceived, '%d/%M/%Y') AS timeReceived,
                    DATE_FORMAT(atsCert_timeReported, '%d/%M/%Y') AS timeReported,
                    DATE_FORMAT(atsCert_timeReported, '%d/%M/%Y') AS timeReported2,
                    aotd_client_info.client_organisation AS client_organisation,
                    aotd_client_info.client_address AS client_address,
                    aotd_client_info.client_postcode AS client_postcode,
                    aotd_client_info.client_city AS client_city,
                    aotd_client_info.client_state AS client_state,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_phoneNo AS client_phoneNo,
                    aotd_client_info.client_faxNo AS client_faxNo,
                    ref_status.status_desc AS status_desc,
                    IF (ats_sample_log.atsCert_accredited = 1, 'Yes', 'No') AS atsCert_accrediteds,
                    IF (ats_sample_log.atsCert_equipment = 1, 'Available', 'Not Available') AS atsCert_equipments,
                    IF (ats_sample_log.atsCert_chemical = 1, 'Available', 'Not Available') AS atsCert_chemicals,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS profile_fullname,
                    ats_type.atsType_desc AS atsType_desc,
                    ats_condition.atsCondition_desc AS atsCondition_desc,
                    ats_sample_log.*
                FROM ats_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ats_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ats_sample_log.atsCert_status
                LEFT JOIN `profile` on `profile`.user_id = ats_sample_log.atsCert_analyst AND `profile`.profile_status = 1
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id
                LEFT JOIN ats_type ON ats_type.atsType_id = ats_sample_log.atsType_id
                LEFT JOIN ats_condition ON ats_condition.atsCondition_id = ats_sample_log.atsCondition_id";
            } else if ($title == 'dt_ats_cert_test') {
                $sql = "SELECT
                    ats_cert_test.atsCertTest_id AS atsCertTest_id,
                    ats_cert_test.atsCert_id AS atsCert_id,
                    1 AS atsTest_ujian,
                    IFNULL(ats_cert_test.atsCertTest_overrid, 0) AS atsTest_overrids,
                    ats_sample_log.atsCert_totalSample AS atsCert_totalSample,
                    IFNULL(ats_cert_test.atsCertTest_overrid, atsCert_totalSample)*atsTest_cost AS atsCertTest_cost,
                    ats_test.*
                FROM ats_cert_test 
                LEFT JOIN ats_test ON ats_test.atsTest_id = ats_cert_test.atsTest_id
                LEFT JOIN ats_sample_log ON ats_sample_log.atsCert_id = ats_cert_test.atsCert_id";
            } else if ($title == 'dt_ats_lab_result') {
                $sql = "SELECT 
                    ats_cert_test.*,
                    ats_result.atsField_name AS atsField_name,
                    ats_test.atsTest_name AS atsTest_name,
                    ats_result.atsRes_res AS atsRes_res
                FROM ats_cert_test
                LEFT JOIN (
                        SELECT 
                            ats_res.*,
                            ats_field.atsField_name AS atsField_name,
                            ats_field.atsTest_id AS atsTest_id
                        FROM ats_res
                        LEFT JOIN ats_field ON ats_field.atsField_id = ats_res.atsField_id 
                        WHERE ats_res.atsLab_id = [atsLab_id]
                    ) ats_result ON ats_result.atsTest_id = ats_cert_test.atsTest_id
                LEFT JOIN ats_test ON ats_test.atsTest_id = ats_cert_test.atsTest_id
                WHERE ats_cert_test.atsCert_id = [atsCert_id]";
            } else if ($title == 'vw_opt_component_wb') {
                $sql = "SELECT 
                    ats_res.atsField_id AS atsField_id, ats_field.atsField_name
                FROM ats_res
                LEFT JOIN ats_sample_info ON ats_sample_info.atsLab_id = ats_res.atsLab_id 
                LEFT JOIN ats_field ON ats_field.atsField_id = ats_res.atsField_id
                WHERE ats_sample_info.atsCert_id = [atsCert_id] AND ats_field.atsTest_id = [atsTest_id] 
                GROUP BY atsField_id
                UNION 
                SELECT 
                    ats_field.atsField_id AS atsField_id, ats_field.atsField_name
                FROM ats_field 
                WHERE atsTest_id = [atsTest_id]";
            } else if ($title == 'vw_test_name') {
                $sql = "SELECT
                        atsTest_id, atsTest_name
                FROM ats_test
                WHERE atsTest_status IN ('1','41') AND (atsTest_sub IS NULL OR atsTest_sub IN ('0','1'))
                ORDER BY atsTest_name";
            } else if ($title == 'vw_phy_test_name') {
                $sql = "SELECT
                        phyTest_id, phyTest_name
                FROM phy_test
                WHERE phyTest_status IN ('1','41')
                ORDER BY phyTest_name";
            } else if ($title == 'vw_eff_group') {
                $sql = "SELECT
                        effCat_id, effCat_name
                FROM eff_cat
                WHERE effCat_status IN ('1','41')
                ORDER BY effCat_name";
            } else if ($title == 'dt_ats_res_wb') {
                $sql = "SELECT 
                    ats_sample_info.*,
                    [atsField_id] AS atsField_id,
                    ats_res.atsRes_id AS atsRes_id,
                    ats_res.atsRes_cycle AS atsRes_cycle,
                    ats_res.atsRes_res AS atsRes_res,
                    '' AS a0,
                    '' AS a1,
                    '' AS a2,
                    '' AS a3,
                    '' AS a4,
                    '' AS a5,
                    '' AS a6,
                    '' AS a7,
                    '' AS a8,
                    '' AS a9
                FROM ats_sample_info
                LEFT JOIN ats_res ON ats_res.atsLab_id = ats_sample_info.atsLab_id AND ats_res.atsField_id = [atsField_id]
                WHERE atsCert_id = [atsCert_id] AND (atsRes_cycle = [atsRes_cycle] OR atsRes_cycle IS NULL)";
            } else if ($title == 'vw_ats_max_cycle') {
                $sql = "SELECT 
                    atsCert_id, 
                    MAX(atsRes_cycle) AS max_cycle 
                FROM ats_res 
                LEFT JOIN ats_sample_info ON ats_sample_info.atsLab_id = ats_res.atsLab_id
                WHERE atsCert_id = [atsCert_id] AND atsField_id = [atsField_id]
                GROUP BY atsCert_id";
            } else if ($title == 'dt_ats_raw') {
                $sql = "SELECT 
                    ats_raw.*
                FROM ats_raw 
                LEFT JOIN ats_sample_info ON ats_sample_info.atsLab_id = ats_raw.atsLab_id
                WHERE ats_sample_info.atsCert_id = [atsCert_id] AND ats_raw.atsField_id = [atsField_id]";
            } else if ($title == 'dt_ats_incoming') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    ats_sample_log.*
                FROM wf_task 
                LEFT JOIN ats_sample_log ON ats_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ats_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_ats_outgoing') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    ats_sample_log.*
                FROM wf_task 
                LEFT JOIN ats_sample_log ON ats_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ats_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 2 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_ats_list_test') {
                $sql = "SELECT 
                    ats_test.atsTest_name AS atsTest_name,
                    ats_field.atsField_name AS atsField_name,
                    ats_formula.atsFormula_name AS atsFormula_name,
                    ats_formula.atsFormula_img AS atsFormula_img,
                    IFNULL(list_done.total, 0) AS total,
                    list_lab.total_lab AS total_lab,
                    ats_field.atsField_id AS atsField_id,
                    ats_cert_test.atsCert_id AS atsCert_id,
                    ats_cert_test.atsTest_id AS atsTest_id,
                    ats_cert_field.atsCertField_id AS atsCertField_id
                FROM ats_cert_test 
                LEFT JOIN ats_test ON ats_test.atsTest_id = ats_cert_test.atsTest_id
                LEFT JOIN ats_field ON ats_field.atsTest_id = ats_cert_test.atsTest_id 
                LEFT JOIN ats_cert_field ON ats_cert_field.atsCert_id = ats_cert_test.atsCert_id AND ats_cert_field.atsField_id = ats_field.atsField_id
                LEFT JOIN ats_formula ON ats_formula.atsFormula_id = ats_cert_field.atsFormula_id
                LEFT JOIN (
                    SELECT ats_sample_info.atsCert_id AS atsCert_id, ats_res.atsField_id AS atsField_id, COUNT(*) AS total
                    FROM ats_res 
                    INNER JOIN 
                    (
                        SELECT
                            atsLab_id, atsField_id, MAX(atsRes_cycle) AS max_cycle
                        FROM ats_res 
                        GROUP BY  atsLab_id, atsField_id
                        ORDER BY max_cycle DESC
                    ) res ON res.atsLab_id = ats_res.atsLab_id AND res.atsField_id = ats_res.atsField_id AND res.max_cycle = ats_res.atsRes_cycle
                    LEFT JOIN ats_sample_info ON ats_sample_info.atsLab_id = ats_res.atsLab_id 
                    WHERE ats_res.atsRes_res IS NOT NULL
                    GROUP BY atsCert_id, atsField_id
                ) list_done ON list_done.atsCert_id = ats_cert_test.atsCert_id AND list_done.atsField_id = ats_field.atsField_id 
                LEFT JOIN (
                    SELECT atsCert_id, COUNT(*) AS total_lab FROM ats_sample_info GROUP BY atsCert_id
                ) list_lab ON list_lab.atsCert_id = ats_cert_test.atsCert_id
                WHERE ats_cert_test.atsCert_id = [atsCert_id]";
            } else if ($title == 'vw_count_task') {
                $sql = "SELECT wfTask_partition, COUNT(*) AS total FROM wf_task WHERE wfTaskType_id = [wfTaskType_id] GROUP BY wfTask_partition";
            } else if ($title == 'vw_ats_raw') {
                $sql = "SELECT 
                    ats_raw.atsRaw_id,
                    ats_raw.atsRaw_value,
                    ats_formula_vars.*,
                    ats_units.atsUnits_unit
                FROM ats_raw
                LEFT JOIN ats_formula_vars ON ats_formula_vars.atsVar_id = ats_raw.atsVar_id 
                LEFT JOIN ats_units ON ats_units.atsUnits_id = ats_formula_vars.atsUnits_id
                WHERE ats_raw.atsField_id = [atsField_id] AND ats_raw.atsLab_id = [atsLab_id]";
            } else if ($title == 'vw_count_bdtCert_info') {
                $sql = "SELECT 
                    bdtRep_status, COUNT(*) AS total
                FROM bdt_sample_log
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = bdt_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])
                GROUP BY bdtRep_status";
            } else if ($title == 'dt_bdt_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    bdt_sample_log.*
                FROM bdt_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = bdt_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = bdt_sample_log.bdtRep_status";
            } else if ($title == 'dt_bdt_cert_login') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTask_createdBy AS wfTask_createdBy,
                    bdt_sample_log.*
                FROM bdt_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = bdt_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = bdt_sample_log.bdtRep_status
                LEFT JOIN wf_task ON wf_task.wfTrans_id = bdt_sample_log.wfTrans_id AND wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = 11 AND wf_task.wfTask_status = 2
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = bdt_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])";
            } else if ($title == 'dt_bdt_incoming') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    bdt_sample_log.*
                FROM wf_task 
                LEFT JOIN bdt_sample_log ON bdt_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = bdt_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_bdt_outgoing') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    bdt_sample_log.*
                FROM wf_task 
                LEFT JOIN bdt_sample_log ON bdt_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = bdt_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 2 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'vw_bdt_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_organisation AS client_organisation,
                    aotd_client_info.client_pic AS client_pic,
                    ref_status.status_desc AS status_desc,
                    IF (bdt_sample_log.bdtRep_msds = 1, 'Available', 'Not Available') AS bdtRep_msdss,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS profile_fullname,
                    bdt_sample_log.*
                FROM bdt_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = bdt_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = bdt_sample_log.bdtRep_status
                LEFT JOIN `profile` on `profile`.user_id = bdt_sample_log.bdtRep_analyst AND `profile`.profile_status = 1
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id";
            } else if ($title == 'dt_bdt_biod') {
                $sql = "SELECT 
                    bdtBiod_day,
                    SUM(IF (bdtBiod_bottle = 2, bdtBiod_biod, NULL)) AS bdtBiod_ref,
                    SUM(IF (bdtBiod_bottle = 3, bdtBiod_biod, NULL)) AS bdtBiod_sample,
                    SUM(IF (bdtBiod_bottle = 4, bdtBiod_biod, NULL)) AS bdtBiod_tox,
                    MIN(bdtBiod_status) AS bdtBiod_statusMin
                FROM bdt_biod
                WHERE bdtLab_code = '[bdtLab_code]' 
                GROUP BY bdtBiod_day";
            } else if ($title == 'dt_bdt_workbook') {
                $sql = "SELECT 
                    bdtRes_day,
                    SUM(IF (bdtRes_bottle = 1, bdtRes_flask1, NULL)) AS bdtRes_flask1_1,
                    SUM(IF (bdtRes_bottle = 1, bdtRes_flask2, NULL)) AS bdtRes_flask2_1,
                    SUM(IF (bdtRes_bottle = 1, bdtRes_mean, NULL)) AS bdtRes_mean_1,
                    SUM(IF (bdtRes_bottle = 2, bdtRes_flask1, NULL)) AS bdtRes_flask1_2,
                    SUM(IF (bdtRes_bottle = 2, bdtRes_flask2, NULL)) AS bdtRes_flask2_2,
                    SUM(IF (bdtRes_bottle = 2, bdtRes_mean, NULL)) AS bdtRes_mean_2,
                    SUM(IF (bdtRes_bottle = 3, bdtRes_flask1, NULL)) AS bdtRes_flask1_3,
                    SUM(IF (bdtRes_bottle = 3, bdtRes_flask2, NULL)) AS bdtRes_flask2_3,
                    SUM(IF (bdtRes_bottle = 3, bdtRes_mean, NULL)) AS bdtRes_mean_3,
                    SUM(IF (bdtRes_bottle = 4, bdtRes_flask1, NULL)) AS bdtRes_flask1_4,
                    SUM(IF (bdtRes_bottle = 4, bdtRes_flask2, NULL)) AS bdtRes_flask2_4,
                    SUM(IF (bdtRes_bottle = 4, bdtRes_mean, NULL)) AS bdtRes_mean_4
                FROM bdt_test_res
                WHERE bdtLab_code = '[bdtLab_code]' AND bdtTest_id = [bdtTest_id] AND bdtRes_cycle = [bdtRes_cycle]
                GROUP BY bdtRes_day";
            } else if ($title == 'vw_count_ectCert_info') {
                $sql = "SELECT 
                    ectRep_status, COUNT(*) AS total
                FROM ect_sample_log
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = ect_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id]) 
                GROUP BY ectRep_status";
            } else if ($title == 'dt_ect_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    ect_sample_log.*
                FROM ect_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ect_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ect_sample_log.ectRep_status";
            } else if ($title == 'dt_ect_cert_login') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTask_createdBy AS wfTask_createdBy,
                    ect_sample_log.*
                FROM ect_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ect_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ect_sample_log.ectRep_status
                LEFT JOIN wf_task ON wf_task.wfTrans_id = ect_sample_log.wfTrans_id AND wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = 21 AND wf_task.wfTask_status = 2
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = ect_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])";
            } else if ($title == 'dt_ect_incoming') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    ect_sample_log.*
                FROM wf_task 
                LEFT JOIN ect_sample_log ON ect_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ect_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_ect_outgoing') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    ect_sample_log.*
                FROM wf_task 
                LEFT JOIN ect_sample_log ON ect_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ect_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 2 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'vw_ect_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_organisation AS client_organisation,
                    aotd_client_info.client_pic AS client_pic,
                    ref_status.status_desc AS status_desc,
                    IF (ect_sample_log.ectRep_msds = 1, 'Available', 'Not Available') AS ectRep_msdss,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS profile_fullname,
                    ect_sample_log.*
                FROM ect_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = ect_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = ect_sample_log.ectRep_status
                LEFT JOIN `profile` on `profile`.user_id = ect_sample_log.ectRep_analyst AND `profile`.profile_status = 1
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id";
            } else if ($title == 'dt_phy_test') {
                $sql = "SELECT 
                    phy_test.*,
                    phy_fields.field_list AS field_list,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color
                FROM phy_test 
                LEFT JOIN (
                        SELECT phyTest_id, GROUP_CONCAT(phyField_name separator ', ') AS field_list 
                        FROM phy_field GROUP BY phyTest_id
                    ) phy_fields ON phy_fields.phyTest_id = phy_test.phyTest_id
                LEFT JOIN ref_status ON ref_status.status_id = phy_test.phyTest_status";
            } else if ($title == 'vw_phy_test') {
                $sql = "SELECT 
                    phy_test.*,
                    ref_status.status_desc AS status_desc
                FROM phy_test 
                LEFT JOIN ref_status ON ref_status.status_id = phy_test.phyTest_status";
            } else if ($title == 'dt_phy_field') {
                $sql = "SELECT 
                    phy_field.*,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color
                FROM phy_field 
                LEFT JOIN ref_status ON ref_status.status_id = phy_field.phyField_status";
            } else if ($title == 'vw_count_phyCert_info') {
                $sql = "SELECT 
                    phyRep_status, COUNT(*) AS total
                FROM phy_sample_log
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = phy_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])
                GROUP BY phyRep_status";
            } else if ($title == 'dt_phy_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    phy_sample_log.*
                FROM phy_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = phy_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = phy_sample_log.phyRep_status";
            } else if ($title == 'dt_phy_cert_login') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTask_createdBy AS wfTask_createdBy,
                    phy_sample_log.*
                FROM phy_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = phy_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = phy_sample_log.phyRep_status
                LEFT JOIN wf_task ON wf_task.wfTrans_id = phy_sample_log.wfTrans_id AND wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = 31 AND wf_task.wfTask_status = 2
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = phy_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])";
            } else if ($title == 'dt_phy_incoming') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    phy_sample_log.*
                FROM wf_task 
                LEFT JOIN phy_sample_log ON phy_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = phy_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_phy_outgoing') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    phy_sample_log.*
                FROM wf_task 
                LEFT JOIN phy_sample_log ON phy_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = phy_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 2 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'vw_phy_cert') {
                $sql = "SELECT
                    DATE_FORMAT(phyRep_timeReceived, '%D %M %Y') AS timeReceived,
                    DATE_FORMAT(phyRep_timeStarted, '%D %M %Y') AS timeStarted,
                    DATE_FORMAT(phyRep_timeCompleted, '%D %M %Y') AS timeCompleted,
                    aotd_client_info.client_organisation AS client_organisation,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_address AS client_address,
                    aotd_client_info.client_postcode AS client_postcode,
                    aotd_client_info.client_city AS client_city,
                    aotd_client_info.client_state AS client_state,
                    aotd_client_info.client_phoneNo AS client_phoneNo,
                    aotd_client_info.client_faxNo AS client_faxNo,
                    phy_test.phyTest_name AS phyTest_name,
                    phy_test.phyTest_cost AS phyTest_cost,
                    ref_status.status_desc AS status_desc,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS profile_fullname,
                    phy_sample_log.*
                FROM phy_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = phy_sample_log.client_id
                LEFT JOIN phy_test ON phy_test.phyTest_id = phy_sample_log.phyTest_id
                LEFT JOIN ref_status ON ref_status.status_id = phy_sample_log.phyRep_status
                LEFT JOIN `profile` on `profile`.user_id = phy_sample_log.phyRep_analyst AND `profile`.profile_status = 1
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id";
            } else if ($title == 'dt_phy_test_res') {
                $sql = "SELECT 
                    phy_test_res.*,
                    phy_field.phyField_name AS phyField_name,
                    phy_field.phyField_status AS phyField_status
                FROM phy_test_res 
                LEFT JOIN phy_field ON phy_field.phyField_id = phy_test_res.phyField_id ";
            } else if ($title == 'dt_phy_report') {
                $sql = "SELECT
                    phy_sample_info.*,
                    phy_test_res.phyRes_res AS phyRes_res,
                    phy_test_res.phyField_id AS phyField_id,
                    phy_field.phyField_name AS phyField_name,
                    phy_field.phyField_status AS phyField_status
                FROM phy_sample_info
                LEFT JOIN phy_test_res ON phy_test_res.phyLab_code = phy_sample_info.phyLab_code
                LEFT JOIN phy_field ON phy_field.phyField_id = phy_test_res.phyField_id";
            } else if ($title == 'dt_eff_test') {
                $sql = "SELECT 
                    eff_test.*,
                    eff_cat.effCat_name AS effCat_name,
                    eff_fields.field_list AS field_list,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color
                FROM eff_test 
                LEFT JOIN eff_cat ON eff_cat.effCat_id = eff_test.effCat_id
                LEFT JOIN (
                        SELECT effTest_id, GROUP_CONCAT(effField_name separator ', ') AS field_list 
                        FROM eff_field GROUP BY effTest_id
                    ) eff_fields ON eff_fields.effTest_id = eff_test.effTest_id
                LEFT JOIN ref_status ON ref_status.status_id = eff_test.effTest_status";
            } else if ($title == 'vw_eff_test') {
                $sql = "SELECT 
                    eff_test.*,
                    eff_cat.effCat_name AS effCat_name,
                    ref_status.status_desc AS status_desc
                FROM eff_test 
                LEFT JOIN eff_cat ON eff_cat.effCat_id = eff_test.effCat_id
                LEFT JOIN ref_status ON ref_status.status_id = eff_test.effTest_status";
            } else if ($title == 'dt_eff_field') {
                $sql = "SELECT 
                    eff_field.*,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color
                FROM eff_field 
                LEFT JOIN ref_status ON ref_status.status_id = eff_field.effField_status";
            } else if ($title == 'vw_count_effCert_info') {
                $sql = "SELECT 
                    effRep_status, COUNT(*) AS total
                FROM eff_sample_log
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = eff_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])
                GROUP BY effRep_status";
            } else if ($title == 'dt_eff_cert') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    eff_sample_log.*
                FROM eff_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = eff_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = eff_sample_log.effRep_status";
            } else if ($title == 'dt_eff_cert_login') {
                $sql = "SELECT 
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTask_createdBy AS wfTask_createdBy,
                    eff_sample_log.*
                FROM eff_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = eff_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = eff_sample_log.effRep_status
                LEFT JOIN wf_task ON wf_task.wfTrans_id = eff_sample_log.wfTrans_id AND wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = 41 AND wf_task.wfTask_status = 2
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = eff_sample_log.wfTrans_id
                WHERE wf_transaction.wfTrans_id IS NULL OR wf_transaction.wfTrans_status <> 2 OR (wf_transaction.wfTrans_status = 2 AND wf_transaction.wfTrans_createdBy = [user_id])";
            } else if ($title == 'dt_eff_incoming') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    eff_sample_log.*
                FROM wf_task 
                LEFT JOIN eff_sample_log ON eff_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = eff_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 1 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'dt_eff_outgoing') {
                $sql = "SELECT 
                    wf_task.wfTask_id AS wfTask_id,
                    wf_task.wfTaskType_id AS wfTaskType_id,
                    wf_task.wfTask_timeCreated AS wfTask_timeCreated,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_organisation AS client_organisation,
                    ref_status.status_desc AS status_desc,
                    ref_status.status_color AS status_color,
                    eff_sample_log.*
                FROM wf_task 
                LEFT JOIN eff_sample_log ON eff_sample_log.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = eff_sample_log.client_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wf_task.wfTask_partition = 2 AND wf_task.wfTaskType_id = [wfTaskType_id]";
            } else if ($title == 'vw_eff_cert') {
                $sql = "SELECT 
                    DATE_FORMAT(effRep_timeReceived, '%D %M %Y') AS timeReceived,
                    DATE_FORMAT(effRep_timeStarted, '%D %M %Y') AS timeStarted,
                    DATE_FORMAT(effRep_timeCompleted, '%D %M %Y') AS timeCompleted,
                    aotd_client_info.client_organisation AS client_organisation,
                    aotd_client_info.client_pic AS client_pic,
                    aotd_client_info.client_address AS client_address,
                    aotd_client_info.client_postcode AS client_postcode,
                    aotd_client_info.client_city AS client_city,
                    aotd_client_info.client_state AS client_state,
                    aotd_client_info.client_phoneNo AS client_phoneNo,
                    aotd_client_info.client_faxNo AS client_faxNo,
                    eff_test.effTest_name AS effTest_name,
                    eff_test.effTest_cost AS effTest_cost,
                    ref_status.status_desc AS status_desc,
                    CONCAT(ref_title.title_desc,' ',`profile`.profile_name,' ',`profile`.profile_lastname) AS profile_fullname,
                    eff_sample_log.*
                FROM eff_sample_log
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = eff_sample_log.client_id
                LEFT JOIN eff_test ON eff_test.effTest_id = eff_sample_log.effTest_id
                LEFT JOIN ref_status ON ref_status.status_id = eff_sample_log.effRep_status
                LEFT JOIN `profile` on `profile`.user_id = eff_sample_log.effRep_analyst AND `profile`.profile_status = 1
                LEFT JOIN ref_title ON ref_title.title_id = `profile`.title_id";
            } else if ($title == 'dt_eff_test_res') {
                $sql = "SELECT 
                    eff_test_res.*,
                    eff_field.effField_name AS effField_name,
                    eff_field.effField_status AS effField_status
                FROM eff_test_res 
                LEFT JOIN eff_field ON eff_field.effField_id = eff_test_res.effField_id ";
            } else if ($title == 'dt_document') {
                $sql = "SELECT 
                    document.*,
                    document_name.documentName_desc AS documentName_desc
                FROM document
                LEFT JOIN document_name ON document_name.documentName_id = document.documentName_id
                WHERE document_status = 1";
            } else if ($title == 'vw_count_inventory_type') {
                $sql = "SELECT inventory_type_status, COUNT(*) AS total FROM aotd_inventory_type GROUP BY inventory_type_status";
            } else if ($title == 'dt_inventory_type') {
                $sql = "SELECT     
                    aotd_inventory_type.*,                  
                    ref_status.*
                FROM aotd_inventory_type
                LEFT JOIN ref_status ON ref_status.status_id = aotd_inventory_type.inventory_type_status";
            } else if ($title == 'vw_count_inventory') {
                $sql = "SELECT inventory_status, COUNT(*) AS total FROM aotd_inventory GROUP BY inventory_status";
            } else if ($title == 'dt_inventory') {
                $sql = "SELECT     
                    aotd_inventory.*,     
                    aotd_inventory_type.inventory_type AS inventory_type,
                    ref_status.*
                FROM aotd_inventory
                LEFT JOIN aotd_inventory_type ON aotd_inventory_type.inventory_type_id = aotd_inventory.inventory_type_id
                LEFT JOIN ref_status ON ref_status.status_id = aotd_inventory.inventory_status";
            } else if ($title == 'vw_count_inventory_transaction') {
                $sql = "SELECT transaction_type, COUNT(*) AS total FROM aotd_inventory_transaction GROUP BY transaction_type";
            } else if ($title == 'dt_inventory_transaction') {
                $sql = "SELECT     
                    aotd_inventory_transaction.*,     
                    aotd_inventory_type.inventory_type AS inventory_type,
                    aotd_inventory.item_name AS item_name
                FROM aotd_inventory_transaction
                LEFT JOIN aotd_inventory ON aotd_inventory.inventory_id = aotd_inventory_transaction.inventory_id
                LEFT JOIN aotd_inventory_type ON aotd_inventory_type.inventory_type_id = aotd_inventory.inventory_type_id";
            } else if ($title == 'dt_email_checkpoint') {
                $sql = "SELECT 
                    wf_task.wfTask_id,
                    wfTask_claimedBy,
                    wf_transaction.wfTrans_no,
                    wf_flow.wfFlow_desc,
                    wf_task_type.wfTaskType_id,
                    wf_task_type.wfTaskType_name,
                    wf_task_type.wfGroup_id,
                    ref_status.status_desc
                FROM wf_task 
                LEFT JOIN wf_transaction ON wf_transaction.wfTrans_id = wf_task.wfTrans_id
                LEFT JOIN wf_flow ON wf_flow.wfFlow_id = wf_transaction.wfFlow_id
                LEFT JOIN wf_task_type ON wf_task_type.wfTaskType_id = wf_task.wfTaskType_id
                LEFT JOIN ref_status ON ref_status.status_id = wf_task.wfTask_status
                WHERE wfTask_partition = 1 AND wf_flow.wfFlow_id <= 5 AND wf_task_type.uType_id IS NOT NULL";
            } else if ($title == 'vw_lab_data') {
                $sql = "SELECT [lab_code]_sample_log.*, aotd_client_info.client_organisation 
                FROM [lab_code]_sample_log 
                LEFT JOIN aotd_client_info ON aotd_client_info.client_id = [lab_code]_sample_log.client_id
                WHERE [ref_name] = '[ref_value]'";
            } else
                throw new Exception($this->get_exception('0098', __FUNCTION__, __LINE__, 'Sql not exist : ' . $title));
            return $sql;
        } catch (Exception $e) {
            error_log(date("Y/m/d h:i:sa") . " [" . __FILE__ . ":" . __LINE__ . "] - " . $e->getMessage() . "\r\n", 3, '../logs/error/error_' . date("Ymd") . '.log');
            if ($e->getCode() == 30) {
                $errCode = 32;
            } else {
                $errCode = $e->getCode();
            }
            throw new Exception($this->get_exception('0099', __FUNCTION__, __LINE__, $e->getMessage()), $errCode);
        }
    }

}

?>
