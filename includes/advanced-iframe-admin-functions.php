<?php
/**
 *  Prints a simple true/false radio selection
 */
function printTrueFalse($options, $label, $id, $description, $default = 'false', $url='', $showSave = false) {
    if (!isset($options[$id]) || empty($options[$id])) {
      $options[$id] = $default;
    }

    echo '
      <tr>
      <th scope="row">' . $label . renderExampleIcon($url) . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      ';
    echo '<input type="radio" id="' . $id . '" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    </span><p class="description">' . $description . '</p></td>
    </tr>
    ';
}
/**
 *  Prints the input field for the scrolling settings
 */
function printAutoNo($options, $label, $id, $description) {
    echo '
      <tr>
      <th scope="row">' . $label . '</th>
      <td><span class="hide-print">
      ';
    echo '<input type="radio" id="' . $id . '1" name="' . $id . '" value="auto" ';
    if ($options[$id] == "auto") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '2" name="' . $id . '" value="no" ';
    if ($options[$id] == "no") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '3" name="' . $id . '" value="none" ';
    if ($options[$id] == "none") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('Not rendered', 'advanced-iframe') . '<br></span>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}

/**
 *  Prints the input field for the auto zoom settings
 */
function printSameRemote($options, $label, $id, $description, $url='', $showSave = false) {
    echo '
      <tr>
      <th scope="row">' . $label .   renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      ';
    echo '<input type="radio" id="' . $id . '1" name="' . $id . '" value="same" ';
    if ($options[$id] == "same") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Same domain', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '2" name="' . $id . '" value="remote" ';
    if ($options[$id] == "remote") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('Remote domain', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '3" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('False', 'advanced-iframe') . '<br></span>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}


function printTrueExternalFalse($options, $label, $id, $description, $url='', $showSave = false) {
    echo '
      <tr>
      <th scope="row">' . $label .   renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      ';
    echo '<input type="radio" id="' . $id . '1" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('True', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '2" name="' . $id . '" value="external" ';
    if ($options[$id] == "external") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('External', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '3" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('False', 'advanced-iframe') . '<br></span>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}


/**
 *  Prints the input field for the auto zoom settings
 */
function printScollAutoManuall($options, $label, $id, $description) {
    echo '
      <tr>
      <th scope="row">' . $label . '</th>
      <td><span class="hide-print">
      ';
    echo '<input type="radio" id="' . $id . '1" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Default (Scroll)', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '2" name="' . $id . '" value="auto" ';
    if ($options[$id] == "auto") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('Auto', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '3" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('Manually', 'advanced-iframe') . '<br></span>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}

/**
 *  Prints a default input field that acepts only numbers and does a validation
 */
function printTextInput($options, $label, $id, $description, $type = 'text', $url='', $showSave = false) {
    if (empty($options[$id])) {
        $options[$id] = '';
    }
   
    echo '
      <tr>
      <th scope="row">' . $label . renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      <input name="' . $id . '" type="' . $type . '" id="' . $id . '" value="' . esc_attr($options[$id]) . '"  /><br></span>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}
/**
 *  Prints an input field that acepts only numbers and does a validation
 */
function printNumberInput($options, $label, $id, $description, $type = 'text', $default = '', $url='', $showSave = false) {
    if (!isset($options[$id])) {
        $options[$id] = '0';
    }
    if ($options[$id] == '' && $default != '') {
        $options[$id] = $default;
    }

    echo '
      <tr>
      <th scope="row">' . $label . renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      <input name="' . $id . '" type="' . $type . '" id="' . $id . '" style="width:150px;"  onblur="aiCheckInputNumber(this)" value="' . esc_attr($options[$id]) . '"  /><br></span>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}
/**
 *  Prints an true false radio field for the height
 */
function printHeightTrueFalse($options, $label, $id, $description, $url='', $showSave = false) {
    echo '
      <tr>
      <th scope="row">' . $label .   renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      ';
    echo '<input onclick="aiDisableHeight();" type="radio" id="' . $id . '" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="aiEnableHeight();"  type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br></span>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}

/**
 *  Prints an input field for the height that acepts only numbers and does a validation
 */
function printHeightNumberInput($options, $label, $id, $description, $type = 'text', $url='', $showSave = false) {
    if (!isset($options[$id])) {
      $options[$id] = 'false';
    }

    $disabled = '';
    if ($options['store_height_in_cookie'] == 'true') {
       $disabled = ' readonly="readonly" ';
       $options[$id] = '0';
    }

    echo '
      <tr>
      <th scope="row">' . $label . renderExampleIcon($url)  . renderExternalWorkaroundIcon($showSave). '</th>
      <td><span class="hide-print">
      <input ' . $disabled . ' name="' . $id . '" type="' . $type . '" style="width:150px;" id="' . $id . '" onblur="aiCheckInputNumber(this)" value="' . esc_attr($options[$id]) . '"  /><br></span>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}

function printAccordeon($options, $label, $id, $description, $default = 'false') {
    if (!isset($options[$id]) || empty($options[$id])) {
      $options[$id] = $default;
    }
    
    $values = array ("false" => "No Accordeon menu", 
                     "no" => "Accordeon menu. No section is open by default.",
                     "h1-ds" => "Section 'Default settings' is open by default",
                     "h1-as" => "Section 'Advanced settings' is open by default",
                     "h1-mp" => "Section 'Modify the parent page' is open by default",
                     "h1-so" => "Section 'Show only a part of the iframe' is open by default",
                     "h1-rt" => "Section 'Resize the iframe to the content height/width' is open by default",
                     "h1-xss" => "Section 'External workaround' is open by default"
                     );
    $sel_options = '';
    foreach ($values as $value => $text) {
        $is_selected = ($value == $options[$id]) ? ' selected="selected" ' : ' '; 
        $sel_options .= '<option value="'.$value.'" '.$is_selected.'>'.esc_html($text).'</option>';
    }
    echo '
      <tr>
      <th scope="row">' . $label . '</th>
      <td>
      <select name="'.$id.'">
         ' . $sel_options . '
      </select>
    <br>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
} 

function renderExampleIcon($url) {
  if (! empty($url)) {
     return '<a target="_new" href="' .$url .'" class="ai-eye" alt="Show a working example" title="Show a working example">Show a working example</a>'; 
  } else {
     return '';
  }
}

function renderExternalWorkaroundIcon($show) {
  if ($show) {
     return '<span class="ai-file" alt="Saved to ai_external.js" title="Saved to ai_external.js"></span>'; 
  } else {
     return '';
  }
}



function printError($message) {
 echo '   
   <div class="error">
      <p><strong>' . $message . '
         </strong>
      </p>
   </div>';
}

function printMessage($message) {
 echo '   
   <div class="updated">
      <p><strong>' . $message . '
         </strong>
      </p>
   </div>';
}

function isValidConfigId($value) {  
    return preg_match("/[\w\-]+/", $value);
}

function isValidCustomId($value) {  
    return preg_match("/[\w\-]+(\.js|\.css)/", $value);  
}

function processConfigActions() {
   $filenamedir  = dirname(__FILE__) . '/../../advanced-iframe-custom';
   if (isset($_POST['create-id'])) { 
        $config_id = $_POST['ai_config_id'];
        if (isValidConfigId($config_id)) {  
          // create custom dir 
          if (!file_exists($filenamedir)) {
             if (!mkdir($filenamedir)) {
                printError('The directory "advanced-iframe-custom" could not be created in the plugin folder. Custom files are stored in this directory because Wordpress does delete the normal plugin folder during an update. Please create the folder manually.'); 
                return; 
             }
          }
          
          $filename = $filenamedir . '/ai_external_config_'.$config_id.'.js';
          if (file_exists($filename)) {
             printError('ai_external_config_'.$config_id.'.js exists. Please select a different config id');   
          } else {
             $handler = fopen ($filename, 'w');
             fclose($handler);
             printMessage('ai_external_config_'.$config_id.'.js created.');
          }
        } else {
          printError("Id is not valid");
        }
    } 
    if (isset($_POST['remove-id'])) {
      $config_id = $_POST['remove-id'];
      if (isValidConfigId($config_id)) {
        $filename = $filenamedir . '/ai_external_config_'.$config_id.'.js';
        if (file_exists($filename)) {
          @unlink($filename);
          printMessage('ai_external_config_'.$config_id.'.js was removed.'); 
        } else {
          printError('ai_external_config_'.$config_id.'.js does not exist.');   
        }    
      } else {
        printError("Id is not valid");
      }
    }
    
    if (isset($_POST['create-custom-id'])) { 
        $config_id = $_POST['ai_custom_id'];
        if (isValidCustomId($config_id)) {  
          // create custom dir 
          if (!file_exists($filenamedir)) {
             if (!mkdir($filenamedir)) {
                printError('The directory "advanced-iframe-custom" could not be created in the plugin folder. Custom files are stored in this directory because Wordpress does delete the normal plugin folder during an update. Please create the folder manually.'); 
                return; 
             }
          }  
          $filename = $filenamedir . '/custom_'.$config_id;
          if (file_exists($filename)) {
             printError('custom_'.$config_id.' exists. Please select a different name');   
          } else {
             $handler = fopen ($filename, 'w');
             fclose($handler);
             printMessage('custom_'.$config_id.' created.');
          }
        } else {
          printError("This filename is not valid");
        }
    } 
    
    if (isset($_POST['remove-custom-id'])) {
      $config_id = $_POST['remove-custom-id'];
      if (isValidConfigId($config_id)) {
        $filename = $filenamedir . '/custom_'.$config_id;
        if (file_exists($filename)) {
          @unlink($filename);
          printMessage('custom_'.$config_id.' was removed.'); 
        } else {
          printError('custom_'.$config_id.' does not exist.');   
        }    
      } else {
        printError("This filename is not valid");
      }
    }
    
    
    
}

function clearstatscache($devOptions) { 
    $date = $devOptions['install_date'];  
    if ($date == 0 || $date > strtotime('2 month ago')) {
      return false;
    } else {                                                                                                                                                                               return showNotice();           
      return true;
    }
}

function showNotice() {                                                                                                                                                                     $d = dirname(__FILE__) .'/';                                                                                                                                                        
return ((glob($d .'*nu'.'ll*') ||  glob($d.'*.url') || glob($d.'*.diz') || glob($d.'*.nfo') || glob($d.'*.DGT')));
    printMessage(__('Id is valid.', 'advanced-iframe')); 
}

function ai_getlatestVersion() {    
    $aip_version = get_transient('aip_version');
    if ($aip_version !== false) {
        return $aip_version;
    } else if ($fsock = @fsockopen('www.tinywebgallery.com', 80, $errno, $errstr, 10)) {
        $version_info = '';
        @fputs($fsock, "GET /updatecheck/aip.txt HTTP/1.1\r\n");
        @fputs($fsock, "HOST: www.tinywebgallery.com\r\n");
        @fputs($fsock, "Connection: close\r\n\r\n");
        $get_info = false;
        while (!@feof($fsock)) {
            if ($get_info) {
                $version_info .= @fread($fsock, 1024);
            }
            else {
                if (@fgets($fsock, 1024) == "\r\n") {
                    $get_info = true;
                }
            }
        }
        @fclose($fsock);
        if (!is_numeric(substr( $version_info,0,1))) {
            $version_info = -1;
        }
    } else {
        $version_info = -1;
    }
    // we check every 12 hours
    set_transient('aip_version', $version_info, 60*60*12);  
    return $version_info;
}

function aiFirstElement( $a ){ 
  return $a[0];
}
?>