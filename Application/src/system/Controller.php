<?php
namespace Mahdiware;
use Application\Config\Os;

    abstract class Controller {
        var $layout;
        var $activity;
        var $params;
        var $View;
        
        public function __construct($activity) {
            $this->activity = $activity;
            $this->params['activity'] = $activity;
            $this->View = new View();
        }

        public function Views() {
            return $this->View;
        }
		
		public function extend($str){
			$this->View->extend($str);
		}
		
		public function section($content){
			$this->View->section($content);
		}
		
		public function renderSection($content){
			$this->View->renderSection($content);
		}
		
		public function endSection(){
			$this->View->endSection();
		}
				
        public function getScript() {
            $content = "";
            foreach ($this->View->getScript() as $jsScript) {
                $content .= "<script src='{$jsScript}'></script>\n\r";
            }
            return $content;
        }
        
        public function getStyle() {
            $content = "";
            foreach ($this->View->getStyle() as $cssStyle) {
                $content .= "<link href='{$cssStyle}' rel='stylesheet'>\r\n";
            }
            return $content;
        }

        function view($view, $getData = []) {
            $params = $this->params;
            $activity = $this->activity;
            
            foreach($getData as $name => $data)
            {
            	if(isset($name)){
            		${$name} = $data;
            	}
            }
            include  Views . DIRECTORY_SEPARATOR . $view . ".php";
            include Views . DIRECTORY_SEPARATOR . $this->Views()->getextend() . ".php";
        }
    }