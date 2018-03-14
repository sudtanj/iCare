<?php
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
use Arrayzy\ArrayImitator as A;

class Form {
    private $form_arrays;
    private $form_title;
    private $form_description;
    private $form_target;
    private $form_type;
    
    public function __construct ( $title, $description, $target, $type="post" ) {
        $this->form_title=$title;
        $this->form_description=$description;
        $this->form_target=$target;
        $this->form_type=$type;
        $this->form_arrays=A::create([]);
    }
    
    public function addForm($form_subtitle,$form_type=""){
        $this->form_arrays->add(A::create([$form_subtitle,$form_type]));
    }
    public function renderTitle(){
        echo '<h1>';
        echo $this->form_title;
        echo '</h1>';
    }
    public function renderDescription(){
        echo '<h2>';
        echo $this->form_description;
        echo '</h2>';
    }
    public function renderCompleteForm(){
        echo '<form action="';
        echo $this->form_target;
        echo '" method="';
        echo $this->form_type;
        echo '">';
        $this->renderForm();
        echo '<br /><button class="button button-block" name="submit" />Submit</button>';
        echo '</form>';
    }
    public function renderForm(){
        for($i =0;$i < sizeof($this->form_arrays);$i++){
            echo '<div class="field-wrap">
            <label>';
            echo $this->form_arrays[$i][0];
            echo '</label>';
            echo '<input type="';
            if(empty($this->form_arrays[$i][1]))
                echo 'textbox';
            else 
                echo $this->form_arrays[$i][1];
            echo '"required autocomplete="off" name="'.preg_replace('/\s+/', '', $this->form_arrays[$i][0]).'" /><br />';
            echo '</div>';
            
        }
    }
}