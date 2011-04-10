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

        $form = new Form("index.php?module=config-settings&amp;action=change", "post", "change");

        $form_container = new FormContainer('Settings');

        

        while($result=$db->fetch_array($query))
        {

            $elementname = 'setting[' . $result['name'] . ']';

            echo $result['optionscode'] . ' | ' . $result['value'] . '<br />';

            switch($result['optionscode'])
            {
                case 'yesno':
                    $setting_code = 'foo';
                    //$setting_code = $form->generate_yes_no_radio($result['name'], $result['value'], true, array('id' => $elementname.'_yes', 'class' => $elementname), array('id' => $elementname.'_no', 'class' => $elementname));
                    break;
                default:
                    $settingcode = $form->generate_text_box($result['name'], $result['value'], array('id' => $elementname));
                    break;
            }

            $form_container->output_row(htmlspecialchars_uni($result['title']), $result['description'], $settingcode, '', array(), array('id' => 'row_'.$result['name']));

        }

        $form_container->end();

        $buttons[] = $form->generate_submit_button('Save');

        $form->output_submit_wrapper($buttons);
        
        $form->end();
    }

    public function saveSettings()
    {
        
    }

}

?>
