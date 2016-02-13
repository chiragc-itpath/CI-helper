<?php

/*
 * here all are Models data are mapped together to accomplish view's data
 * for example.
 * Profile  |----> manter 
 *          |
 *          |----> trainee
 *          |
 *          |----> Admin
 * so we get the data form Those Models and passed it to approperiacte helper 
 * via controoler's method and will get Obect for view
 * EX. (output)
 *      $profile->trainee's property
 *      $profile->manter's property
 *      $profile->admin's property
 */

function loadProfileBasedOnUserType() {
    $CI = & get_instance();
    $CI->load->model('Member');
    $member = array_slice($CI->Member->getFullMember(), 0, 1);
    $CI->data = array('ProfileData' => array_shift($member), 'formObject' => formConfig());
    unset($CI);
}

function formConfig() {
    $formArrayObj = array(
        'Defualt' => array(
            'field_type' => 'text',
            'id_reff' => 'name',
            'placeholder_reff' => 'name',
            'label_reff' => 'name',
            'beforeHtml' => '<div class="col-sm-10">',
            'afterHtml' => '</div>',
            'groupBeforeHtml' => '<div class="form-group">',
            'groupAfterHtml' => '</div>',
            'extra' => array('class' => 'form-control'),
            'function_Prefix' => 'form_',
            'IsLabel' => true,
            'label_extra' => array('class' => 'col-sm-2 control-label')
        ),
        array(
            'name' => 'FirstName',
            'type' => 'text'
        ),
        array(
            'name' => 'LastName',
            'type' => 'text'
        ),
        array(
            'name' => 'Email',
            'type' => 'text'
        ),
        array(
            'label' => 'Gender',
            'name' => 'Sex',
            'type' => 'dropdown',
            'options' => array('Male'=>'Male','FeMale'=>'Female')
        ),
        array(
            'name'=> 'Address',
            'type'=> 'textarea'
        ),
        array(
            'name'=> 'HomePhone',
            'type'=> 'text'
        ),
        array(
            'name'=> 'CellPhone',
            'type'=> 'text'
        ),
        array(
            'name'=> 'WorkPhone',
            'type'=> 'text'
        ),
        array(
            'label' => 'BirthDate',
            'name'=> 'Birthdate',
            'type'=> 'text'
        ),
        array(
            'name'=> 'Doctor',
            'type'=> 'text'
        ),
        array(
            'name'=> 'Organization',
            'type'=> 'text'
        ),
        array(
            'name'=> 'Avatar',
            'type'=> 'upload'
        ),
        
    );
    return $formArrayObj;
}

function setFormValidationRules(){
     $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    $this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|max_length[20]');
    $this->form_validation->set_rules('LastName', 'LastName', 'trim|required|max_length[20]');
    $this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('Address', 'Address', 'trim|max_length[50]');
    $this->form_validation->set_rules('HomePhone', 'HomePhone', 'trim|required|numeric|max_length[15]');
    $this->form_validation->set_rules('CellPhone', 'CellPhone', 'trim|numeric|max_length[15]');
    $this->form_validation->set_rules('WorkPhone', 'WorkPhone', 'trim|numeric|max_length[15]');
    $this->form_validation->set_rules('BirthDate', 'BirthDate', 'trim|regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');
    $this->form_validation->set_rules('Doctor', 'Doctor', 'trim|max_length[20]');
    $this->form_validation->set_rules('Organization', 'Organization', 'trim|max_length[20]');
}
?>