<?php

namespace Mahdiware;

/**
 * Class for managing sessions
 */
class Session {

    // Session data array
    private $sessionData = array();

    // Session ID
    private $sessionID;

    // Session directory
    private $sessionDir;

    // Session timeout (in seconds)
    private $sessionTimeout = 1800; // 30 minutes

    // Constructor
    public function __construct() {
        // Set session directory
        $this->sessionDir = writable . '/sessions';
        if (!is_dir($this->sessionDir)) {
            mkdir($this->sessionDir);
        }
        // Start session
        $this->start();
    }

    // Start session
    private function start() {
        // Get session ID from request cookies or generate a new one
        if (isset($_COOKIE['session_id'])) {
            $this->sessionID = $_COOKIE['session_id'];
        } else {
            $this->sessionID = $this->generateSessionID();
            setcookie('session_id', $this->sessionID, 0, '/');
        }
        // Check if session file exists
        $sessionFile = $this->sessionDir . '/' . $this->sessionID;
        if (file_exists($sessionFile)) {
            // Load session data from file
            $data = file_get_contents($sessionFile);
            $this->sessionData = unserialize($data);
        } else {
            // Create new session
            $this->sessionData = array();
            $this->sessionData['session_start_time'] = time();
        }
        // Check if session has timed out
        if (time() - $this->sessionData['session_start_time'] > $this->sessionTimeout) {
            // Destroy session and start a new one
            $this->destroy();
            $this->sessionID = $this->generateSessionID();
            setcookie('session_id', $this->sessionID, 0, '/');
            $this->start();
        }
    }

    // Generate a new session ID
    private function generateSessionID() {
        return bin2hex(random_bytes(16));
    }

    // Destroy session
    public function destroy() {
        $sessionFile = $this->sessionDir . '/' . $this->sessionID;
        if (file_exists($sessionFile)) {
            unlink($sessionFile);
        }
        $this->sessionData = array();
        $this->sessionID = null;
        setcookie('session_id', '', time() - 3600, '/');
    }

    // Set session variable
    public function set($key, $value) {
        $this->sessionData[$key] = $value;
        $this->save();
    }

    // Get session variable
    public function get($key) {
        return isset($this->sessionData[$key]) ? $this->sessionData[$key] : null;
    }

    // Remove session variable
    public function unset($key) {
        unset($this->sessionData[$key]);
        $this->save();
    }

    // Save session data to file
    private function save() {
        $sessionFile = $this->sessionDir . '/' . $this->sessionID;
        $data = serialize($this->sessionData);
        file_put_contents($sessionFile, $data);
    }

}