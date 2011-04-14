<?php

class configuration_class
{

    protected $setting_group;

    public function editSettings()
    {

        global $mybb, $db;

        $query = $db->query('

            SELECT * FROM '. TABLE_PREFIX . 'settings
            WHERE name LIKE \'SN_' . $this->setting_group . '_%\'

        ');

        $form = new Form("index.php?module=spamninja-configuration&amp;task=save&amp;tabaction=".$this->setting_group, "post", "change");

        $form_container = new FormContainer('Settings');

        while($result=$db->fetch_array($query))
        {

            $elementname = 'sn_setting[' . $result['name'] . ']';

            $settingtype = explode(' ', $result['optionscode']);

            $settingtype = $settingtype[0];

            switch($settingtype)
            {
                case 'yesno':
                    $settingcode = $form->generate_yes_no_radio($elementname, $result['value'], true, array('id' => $elementname.'_yes', 'class' => $elementname), array('id' => $elementname.'_no', 'class' => $elementname));
                    break;
                case 'onoff':
                    $settingcode = $form->generate_on_off_radio($elementname, $setting['value'], true, array('id' => $element_id.'_on', 'class' => $element_id), array('id' => $element_id.'_off', 'class' => $element_id));
                    break;
                case 'select':
                    $options = substr($result['optionscode'], 7);

                    $options = eval(htmlspecialchars_decode($options));
                    
                    $settingcode = $form->generate_select_box($elementname, $options, $setting['value'], array('id' => $element_id));
                    break;
                default:
                    $settingcode = $form->generate_text_box($elementname, $result['value'], array('id' => $elementname));
                    break;
            }

            $form_container->output_row(htmlspecialchars_uni($result['title']), $result['description'], $settingcode, '', array(), array('id' => 'row_'.$result['name']));

        }

        $form_container->end();

        $buttons[] = $form->generate_submit_button('Save');

        $form->output_submit_wrapper($buttons);
        
        $form->end();
    }

    public function saveSettings($settings)
    {
        global $db;
        
        foreach($settings['sn_setting'] as $k => $v)
        {
            $query = 'UPDATE '. TABLE_PREFIX .'settings SET value = \'' . $v . '\' WHERE name = \'' . $k . '\';';
            $db->query($query);
        }

        rebuild_settings();

        flash_message('Settings updated', 'success');
        admin_redirect("index.php?module=spamninja-configuration&tabaction=".$this->setting_group);
    }

}

?>
