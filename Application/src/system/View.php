<?php
namespace Mahdiware;

class View {
    private $Scripts = array();

    private $Styles = array();
    

    protected $layout;

    protected $sections = [];

    protected $currentSection;

    protected $sectionStack = [];
    
       
    function setScript($Script) {
        array_push($this->Scripts, $Script);
    }
    function setStyle($Style) {
        array_push($this->Styles, $Style);
    }
    
    function getScript() {
        return $this->Scripts;
    }
    function getStyle() {
        return $this->Styles;
    }
    
    public function extend(string $layout)
    {
        $this->layout = $layout;
    }
    
    public function section(string $name)
    {
        $this->currentSection = $name;
        $this->sectionStack[] = $name;
        ob_start();
    }
	
	public function getextend(){
		return $this->layout;
	}
	
    public function endSection()
    {
        $contents = ob_get_clean();
        if ($this->sectionStack === []) {
            throw new RuntimeException('View themes, no current section.');
        }
        $section = array_pop($this->sectionStack);
        if (! array_key_exists($section, $this->sections)) {
            $this->sections[$section] = [];
        }
        $this->sections[$section][] = $contents;
    }

    public function renderSection(string $sectionName)
    {
        if (! isset($this->sections[$sectionName])) {
            echo '';
            return;
        }
        foreach ($this->sections[$sectionName] as $key => $contents) {
            echo $contents;
            unset($this->sections[$sectionName][$key]);
        }
    }
}