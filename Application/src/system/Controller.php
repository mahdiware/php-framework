<?php
namespace Mahdiware;
use Application\Config\Os;

    abstract class Controller{
        var $layout;
        var $View;
		
		public function extend($str){
			View::extend($str);
		}
		
		public function section($content){
			View::section($content);
		}
		
		public function renderSection($content){
			View::renderSection($content);
		}
		
		public function endSection(){
			View::endSection();
		}
				
        public function getScript() {
            $content = "";
            foreach (View::getScript() as $jsScript) {
                $content .= "<script src='{$jsScript}'></script>\n\r";
            }
            return $content;
        }
        
        public function getStyle() {
            $content = "";
            foreach (View::getStyle() as $cssStyle) {
                $content .= "<link href='{$cssStyle}' rel='stylesheet'>\r\n";
            }
            return $content;
        }

        function view($view, $getData = []) {
            
            foreach($getData as $name => $data)
            {
            	if(isset($name)){
            		${$name} = $data;
            	}
            }
            include  Views . DIRECTORY_SEPARATOR . $view . ".php";
            include Views . DIRECTORY_SEPARATOR . View::getextend() . ".php";
        }
    }