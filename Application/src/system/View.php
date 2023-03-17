<?php
namespace Mahdiware;

 class View {

    protected static $Scripts = array();
    protected static $Styles = array();
    protected static $layout;
    protected static $sections = [];
    protected static $currentSection;
    protected static $sectionStack = [];
    
       
    public static function setScript($Script) {
        array_push(static::$Scripts, $Script);
    }
    public static function setStyle($Style) {
        array_push(static::$Styles, $Style);
    }
    
    public static function getScript() {
        return static::$Scripts;
    }
    public static function getStyle() {
        return static::$Styles;
    }
    
    public static function extend(string $layout)
    {
        static::$layout = $layout;
    }
    
    public static function section(string $name)
    {
        static::$currentSection = $name;
        static::$sectionStack[] = $name;
        ob_start();
    }
	
	public static function getextend(){
		return static::$layout;
	}
	
    public static function endSection()
    {
        $contents = ob_get_clean();
        if (static::$sectionStack === []) {
            throw new RuntimeException('View themes, no current section.');
        }
        $section = array_pop(static::$sectionStack);
        if (! array_key_exists($section, static::$sections)) {
            static::$sections[$section] = [];
        }
        static::$sections[$section][] = $contents;
    }

    public static function renderSection(string $sectionName)
    {
        if (! isset(static::$sections[$sectionName])) {
            echo '';
            return;
        }
        foreach (static::$sections[$sectionName] as $key => $contents) {
            echo $contents;
            unset(static::$sections[$sectionName][$key]);
        }
    }
}