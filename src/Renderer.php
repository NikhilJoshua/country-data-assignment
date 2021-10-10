<?php

namespace NJ;

class Renderer {
    /**
     * @var RenderType
     */
    private $renderType;

    public function __construct(RenderType $renderType){
        $this->renderType = $renderType;
    }

    public function render(){
        $this->renderType->render();
    }
}

interface RenderType {
    public function render();
}

class ListRender implements RenderType {

    private $json_data;
    private $renderList;

    public function __construct($json_data){
        $this->json_data = $json_data;
        $this->data = json_decode($json_data, true);
    }
    public function render()
    {
        foreach($this->data as $sno => $country){
            /*echo '<pre>';
            print_r( $country);*/
            echo '<ul>';
            $this->addElements($country, $this->renderList);
            echo '</ul>';
            echo '<hr>';

        }
    }

    public function addElements($arr, $renderList=''){
            //echo $key.'<br>';
        foreach ($arr as $key => $value){
            if(is_array($value)){
                echo '<li>'. $key . '</li>';
                echo '<ul>';
                $this->addElements($value);
                echo '</ul>';
            }
            else {
                echo '<li>'. $key . '</li><ul>';
                echo '<li>' . $value . '</li></ul>';
            }
        }
    }
}

class GridRender implements RenderType {

    private $json_data;

    public function __construct($json_data){
        $this->json_data = $json_data;
        $this->data = json_decode($json_data, true);
    }

    public function render()
    {
        echo '<table border="1">';
        $this->renderHeading();

        $this->renderBody();

        echo '</table>';
    }
    public function renderHeading(){
        echo '<thead>';
        foreach($this->data as $sno => $country){
            foreach($country as $key => $value) {
                echo '<th>'.$key.'</th>';
            }
            break;
        }
        echo '</thead>';
    }

    private function renderBody()
    {

        foreach($this->data as $sno => $country){
            echo '<tr>';
            foreach($country as $key => $value) {
                if(is_array($value)){
                    echo '<td>';
                    print_r($value);
                    echo '</td>';
                    continue;
                }
                echo '<td>'.$value.'</td>';
            }
            echo '</tr>';
        }

    }
}