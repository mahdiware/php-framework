<?php

namespace Mahdiware;

/**
 * Class for managing sessions
 */
class Session {

    // Session data array
    protected static $sessionData = array();

    // Session ID
    protected static $sessionID;

    // Session directory
    protected static $sessionDir;

    // Session timeout (in seconds)
    protected static $sessionTimeout = 1800; // 30 minutes

    // Constructor
    public function __construct() {
        // Set session directory
        static::$sessionDir = writable . '/sessions';
        if (!is_dir(static::$sessionDir)) {
            mkdir(static::$sessionDir);
        }
        // Start session
        static::start();
    }

    // Start session
    private function start() {
        // Get session ID from request cookies or generate a new one
        if (isset($_COOKIE['session_id'])) {
            static::$sessionID = $_COOKIE['session_id'];
        } else {
            static::$sessionID = static::generateSessionID();
            setcookie('session_id', static::$sessionID, 0, '/');
        }
        // Check if session file exists
        $sessionFile = static::$sessionDir . '/' . static::$sessionID;
        if (file_exists($sessionFile)) {
            // Load session data from file
            $data = file_get_contents($sessionFile);
            static::$sessionData = unserialize($data);
        } else {
            // Create new session
            static::$sessionData = array();
            static::$sessionData['session_start_time'] = time();
        }
        // Check if session has timed out
        if (time() - static::$sessionData['session_start_time'] > static::$sessionTimeout) {
            // Destroy session and start a new one
            static::destroy();
            static::$sessionID = static::generateSessionID();
            setcookie('session_id', static::$sessionID, 0, '/');
            static::start();
        }
    }

    // Generate a new session ID
    private function generateSessionID() {
        return bin2hex(random_bytes(16));
    }

    // Destroy session
    public static function destroy() {
        $sessionFile = static::$sessionDir . '/' . static::$sessionID;
        if (file_exists($sessionFile)) {
            unlink($sessionFile);
        }
        static::$sessionData = array();
        static::$sessionID = null;
        setcookie('session_id', '', time() - 3600, '/');
    }

    // Set session variable
    public static function set($key, $value) {
        static::$sessionData[$key] = $value;
        static::save();
    }

    // Get session variable
    public static function get($key) {
        return isset(static::$sessionData[$key]) ? static::$sessionData[$key] : null;
    }

    // Remove session variable
    public static function unsetKey($key) {
        unset(static::$sessionData[$key]);
        static::save();
    }

    // Save session data to file
    private static function save() {
        $sessionFile = static::$sessionDir . '/' . static::$sessionID;
        $data = serialize(static::$sessionData);
        
        file_put_contents($sessionFile, $data);
    }

}
