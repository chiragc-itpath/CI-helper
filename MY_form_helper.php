<?php
if(!function_exists('load_form')):
    function load_form($formObject,$dataObject){
        $defualt_field_type = 'text';
        $defualt_id_reff = 'name';
        $defualt_placeholder_reff = 'name';
        $defualt_label_reff = 'name';
        $defualt_value = '';
        $defualt_beforeHtml = '';
        $defualt_afterHtml = '';
        $defualt_groupBeforeHtml = '';
        $defualt_groupAfterHtml = '';
        $defualt_extra = array('class'=> 'form-control');
        $field_function_Prefix = 'form_';
        $defualt_selectOption = array();
        $defualt_IsLabel = true;
        $defualt_label_extra = array();
        $_html = '';
        if (_issetAndNotNull('Defualt', $formObject)):
            $_customFormValue = $formObject['Defualt']; //custom form value for defualt
            $defualt_field_type = _issetAndNotNull('field_type', $_customFormValue) ? $_customFormValue['field_type']: $defualt_field_type;
            $defualt_id_reff = _issetAndNotNull('id_reff', $_customFormValue) ? $_customFormValue['id_reff']: $defualt_id_reff;
            $defualt_placeholder_reff = _issetAndNotNull('placeholder_reff', $_customFormValue) ? $_customFormValue['placeholder_reff']: $defualt_placeholder_reff;
            $defualt_label_reff = _issetAndNotNull('label_reff', $_customFormValue) ? $_customFormValue['label_reff']: $defualt_label_reff;
            $defualt_value = _issetAndNotNull('value', $_customFormValue) ? $_customFormValue['value'] : $defualt_value;
            $defualt_beforeHtml = _issetAndNotNull('beforeHtml', $_customFormValue) ? $_customFormValue['beforeHtml'] : $defualt_beforeHtml;
            $defualt_afterHtml = _issetAndNotNull('afterHtml', $_customFormValue) ? $_customFormValue['afterHtml'] : $defualt_afterHtml;
            $defualt_groupBeforeHtml = _issetAndNotNull('groupBeforeHtml', $_customFormValue) ? $_customFormValue['groupBeforeHtml'] : $defualt_groupBeforeHtml;
            $defualt_groupAfterHtml = _issetAndNotNull('groupAfterHtml', $_customFormValue) ? $_customFormValue['groupAfterHtml'] : $defualt_groupAfterHtml;
            $defualt_extra = _issetAndNotNull('extra', $_customFormValue) ? $_customFormValue['extra'] : $defualt_extra;
            $field_function_Prefix = _issetAndNotNull('function_Prefix', $_customFormValue) ? $_customFormValue['function_Prefix'] : $defualt_function_Prefix;
            $defualt_selectOption = _issetAndNotNull('selectOption', $_customFormValue) ? $_customFormValue['selectOption'] : $defualt_selectOption;
            $defualt_IsLabel = _issetAndNotNull('IsLabel', $_customFormValue) ? $_customFormValue['IsLabel'] : $defualt_IsLabel;
            $defualt_label_extra = _issetAndNotNull('label_extra', $_customFormValue) ? $_customFormValue['label_extra'] : $defualt_label_extra;
            unset($formObject['Defualt']);
        endif;
        
        foreach ($formObject as $fields){
            if(empty($fields)){
                continue;
            }
            if(!isset($fields['name'])&& $fields['name'] == '' || empty($fields)){
                //Skip this field
                continue;
            }
            if(!empty($dataObject)){
                $fields['value'] = $dataObject->$fields['name'];
            }
            
            $_name = _issetAndNotNull('name', $fields) ? $fields['name'] : 'BUG';
            $_id = _issetAndNotNull('id', $fields) ? $fields['id'] : $fields[$defualt_id_reff];
            $_value = _issetAndNotNull('value', $fields) ? $fields['value']: $defualt_value;    
            $_field_type = _issetAndNotNull('type', $fields) ? $fields['type'] : $defualt_field_type;
            $_placeholder = _issetAndNotNull('placeholder', $fields) ? $fields['placeholder'] : $fields[$defualt_placeholder_reff]; 
            $_selectOption = _issetAndNotNull('options', $fields) ? $fields['options'] : $defualt_selectOption;
            $_extra = _issetAndNotNull('extra', $fields) ? $fields['extra'] : $defualt_extra;
            $_fieldGroupBeforeHtml = _issetAndNotNull('groupBeforeHtml', $fields) ? $fields['groupBeforeHtml'] : $defualt_groupBeforeHtml;
            $_fieldGroupAfterHtml = _issetAndNotNull('groupAfterHtml', $fields) ? $fields['groupAfterHtml'] : $defualt_groupAfterHtml;
            $_fieldBeforeHtml = _issetAndNotNull('beforeHtml', $fields) ? $fields['beforeHtml'] : $defualt_beforeHtml;
            $_fieldAfterHtml = _issetAndNotNull('afterHtml', $fields) ? $fields['afterHtml'] : $defualt_afterHtml;
            $IS_Label = _issetAndNotNull('is_label', $fields) ? $fields['is_label'] : $defualt_IsLabel;
            $label_text = _issetAndNotNull('label', $fields) ? $fields['label'] : $fields[$defualt_label_reff];
            $label_extra = _issetAndNotNull('label_extra', $fields) ? $fields['label_extra'] : $defualt_label_extra;
            
            $fieldFunction = $field_function_Prefix .$_field_type;
            
            $_html .= $_fieldGroupBeforeHtml;
            if($IS_Label){
                $_html .= form_label($label_text, $_id, $label_extra);
            }
            $_html .= $_fieldBeforeHtml;
            if(function_exists($fieldFunction)){
                switch($_field_type){
                    case 'input':
                    case 'text':
                    case 'number':
                    case 'password':
                    case 'upload':
                    case 'textarea':
                    case 'date':
                        $_data = array('type'=>$_field_type,'name'=>$_name, 'id'=>$_id);
                        $_html .= $fieldFunction($_data,$_value,$_extra);
                        break;
                    case 'multiselect':
                        $_selected = array(); //value
                        $_html .= $fieldFunction($_name,$_selectOption,$_selected,$_extra);    
                        break;
                    case 'dropdown':
                        $_selected = array(); //value
                        $_html .= $fieldFunction($_name,$_selectOption,$_selected,$_extra);
                        break;
                    case 'checkbox':
                        $_checked = false;
                        $_html .= $fieldFunction($_name,$_value,$_checked,$_extra);
                        break;
                    case 'radio':
                        $_checked = false;
                        $_html .= $fieldFunction($_name,$_value,$_checked,$_extra);
                        break;
                    default :
                        $_data = array('type'=>$_field_type,'name'=>$_name);
                        $_html .= $fieldFunction($_data,$_value,$_extra);
                }
                
            }
            $_html .= $_fieldAfterHtml;
            $_html .= $_fieldGroupAfterHtml;
        }
        return $_html;
    }
endif;

if(!function_exists('_issetAndNotNull')):
    function _issetAndNotNull($string, $arrayObj){
      if(isset($arrayObj[$string]) && $arrayObj[$string] != ''){
          return true;
      }
      return false;
    }
endif;

if ( ! function_exists('form_text'))
{
	/**
	 * Text Input Field
	 *
	 * @param	mixed
	 * @param	string
	 * @param	mixed
	 * @return	string
	 */
	function form_text($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'type' => 'text',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
		);

		return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
	}
}
?>